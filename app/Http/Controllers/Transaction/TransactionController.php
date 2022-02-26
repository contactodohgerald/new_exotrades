<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Plans\InvestmentPlan;
use App\Models\Transaction\Transaction;
use App\Models\Settings\SiteSetting;
use App\Models\WalletAddress\WalletAddress;
use App\Traits\Generics;
use RealRashid\SweetAlert\Facades\Alert;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class TransactionController extends Controller
{
    //
    use Generics;
    public function __construct(InvestmentPlan $plan, SiteSetting $appSettings, Transaction $invest, User $user, WalletAddress $systemWallet){
        $this->plan = $plan;
        $this->appSettings = $appSettings;
        $this->invest = $invest;
        $this->user = $user;
        $this->systemWallet = $systemWallet;
    }

    public function investPageInterface(){

        $user = Auth::user();

        $plan = $this->plan->getAllPlans([
            ['deleted_at', null]
        ]);
        
        $systemWallet = $this->systemWallet->getAllWalletAddress([
            ['deleted_at', null]
        ]);

        $appSettings = $this->appSettings->getSettings();

        $view = [
            'plan'=>$plan,
            'systemWallet'=>$systemWallet,
            'setting'=>$appSettings,
        ];
        return view('backend.invest', $view);
    }

    public function createTransactionPaymentInvoice(Request $request){
        try{

            $user = Auth::user();
            $data = $request->all();

            $appSettings = $this->appSettings->getSettings();

            $request->validate([
                'plan_unique_id' => 'required',
                'system_wallet_id' => 'required',
                'amount' => 'required',
            ]);

            $plan = $this->plan->getSinglePlan([
                ['unique_id', $data['plan_unique_id']]
            ]);

            if($plan != null){
                if($plan->max_amount != 'Unlimited'){
                    if($data['amount'] < $plan->min_amount || $data['amount'] > $plan->max_amount){
                        Alert::error('Error', 'The Min Amount for '.$plan->plan_name.' Plan is $'.number_format($plan->min_amount).' and the The Max Amount for '.$plan->plan_name.' Plan is '.number_format($plan->max_amount));
                        return redirect()->back();
                    }
                }
            }

            $wallet = $this->systemWallet->getSingleWalletAddress([
                ['unique_id', $data['system_wallet_id']]
            ]);

            if($wallet != null){
                
                $transaction = new Transaction();
                $transaction->unique_id = $this->createUniqueId('transactions', 'unique_id');
                $transaction->user_unique_id = $user->unique_id;
                $transaction->plan_unique_id = $data['plan_unique_id'];
                $transaction->system_wallet_id = $data['system_wallet_id'];
                $transaction->amount = $data['amount'];

                $transaction->plans;

                if($appSettings->send_basic_emails != 'no'){
                     //send user deposit creation mail
                    $this->invest->sendInvestmentDeposit($user, $transaction, $wallet->wallet_address); 

                    //send admin deposit creatdetailsion mail
                    $this->invest->sendInvestmentDepositToAdmin($user, $transaction);
                }

                $transaction->save();
                Alert::success('Success', 'You request was successfully created');
                return redirect()->route('payment-invoice', [$transaction->unique_id]);

            }else{
                Alert::error('Error', 'An error occured, try again later');
                return redirect()->back();
            }
        }catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
    }

    public function paymentInvoiceInterface($unique_id = null){

        if($unique_id != null){

            $invest = $this->invest->getSingleTransaction([
                ['unique_id', $unique_id]
            ]);

            $view = [
                'invest'=>$invest,
            ];
    
            return view('backend.payment_invoice', $view);

        }else {
            Alert::error('Error', 'An error occured, try again later');
            return redirect()->back();
        }
    }

    public function uploadPaymentProof(Request $request, $unique_id = null){
        try{
            if($unique_id != null){

                $transaction = $this->invest->getSingleTransaction([
                    ['unique_id', $unique_id]
                ]);
            
                $thumbnailUrl = 'default.png';
                // addind the image to cloudinary
                if ($request->hasFile('thumbnail')) {
                    // Uploading an image file to cloudinary and resizing the image to a resolution specified by the dimension parameters with one line of code
                    $thumbnailUrl = Cloudinary::upload($request->file('thumbnail')->getRealPath(), [
                        'folder' => 'exotrades/payment_proof',
                        'transformation' => [
                            'width' => 400,
                            'height' => 400
                        ]
                    ])->getSecurePath();
                }

                $transaction->payment_proof = $thumbnailUrl;
                $transaction->save();

                Alert::success('Success', 'Payment proof was successfully uploaded');
                return redirect()->back(); 
            }else {
                Alert::error('Error', 'An error occured, try again later');
                return redirect()->back();
            }
        }catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
    }

    public function pendingInvestmentHistoryInterface(){

        $user = Auth::user();

        $invest = $this->invest->getAllTransactionPagination(8, [
            ['user_unique_id', $user->unique_id],
            ['received_status', 'pending'],
        ]);

        $appSettings = $this->appSettings->getSettings();

        $view = [
            'invest'=>$invest,
            'setting'=>$appSettings
        ];

        return view('backend.pending_investment', $view);
    }

    public function investmentHistoryInterface(){

        $user = Auth::user();

        $invest = $this->invest->getAllTransactionPagination(8, [
            ['user_unique_id', $user->unique_id],
            ['received_status', 'confirmed'],
        ]);

        $appSettings = $this->appSettings->getSettings();

        $view = [
            'invest'=>$invest,
            'setting'=>$appSettings
        ];

        return view('backend.investment_history', $view);
    }

    public function comfirmInvestmentInterface(){

        $transactions = $this->invest->getAllTransactionPagination(8, [
            ['invest_status', 'pending']
        ]);

        $view = [
            'transactions'=>$transactions
        ];

        return view('backend.confirm_investment', $view);
    }

    public function confirmUserDeposit(Request $request){
        try{
            $deleteStatus = 0;
            
            $dataArray = explode('|', $request->transId);
            
            $appSettings = $this->appSettings->getSettings();
            
            foreach ($dataArray as $each_unique_id) {
                //delete transaction
                $transaction = $this->invest->getSpecificTransaction($each_unique_id);
                if($transaction !== null){
                   
                    $user = $this->user->getSingleUserWithCondition([
                        ['unique_id', $transaction->user_unique_id],
                    ]);

                    if($appSettings->referral_system_access != 'no'){
                        if($user->referred_id != null){

                            $ref_user_1 = $this->user->getSingleUserWithCondition([
                                ['referral_id', $user->referred_id],
                            ]);
        
                            if($ref_user_1 != null){
                                $cal_amount = ($transaction->amount * $appSettings->ref_bonus) / 100;
                                $amount = $user->ref_bonus_balance + $cal_amount;
                                $user->ref_bonus_balance = $amount;
                                $user->save();
                            }
                        }
                    }
                }

                $transaction->plans;

                if($appSettings->send_basic_emails != 'no'){
                    //send user deposit/investment mail
                    $this->invest->sendDepositConfirmationMail($user, $transaction); 

                    //send admin deposit creatdetailsion mail
                    $this->invest->sendInvestmentConfirmationToAdmin($user, $transaction);
                }
                $transaction->received_status = 'confirmed';
                if($transaction->save()){
                    $deleteStatus = 1;
                }

            }

            if($deleteStatus == 1){
                Alert::success('Success', 'Payment was confrimed successfully');
                return redirect()->back();
            }

            Alert::error('Error', 'An error occured, try again later');
            return redirect()->back();
    
        }catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
    }

    public function unconfirmUserDeposit(Request $request){
        try{
            $deleteStatus = 0;

            $dataArray = explode('|', $request->uncomfirmTransId);

            $appSettings = $this->appSettings->getSettings();
            
            foreach ($dataArray as $each_unique_id) {
                //delete transaction
                $transaction = $this->invest->getSpecificTransaction($each_unique_id);
                if($transaction !== null){
                   
                    $user = $this->user->getSingleUserWithCondition([
                        ['unique_id', $transaction->user_unique_id],
                    ]);

                    if($appSettings->referral_system_access != 'no'){
                        if($user->referred_id != null){

                            $ref_user_1 = $this->user->getSingleUserWithCondition([
                                ['referral_id', $user->referred_id],
                            ]);
        
                            if($ref_user_1 != null){
                                $cal_amount = ($transaction->amount * $appSettings->ref_bonus) / 100;
                                $amount = $user->ref_bonus_balance - $cal_amount;
                                $user->ref_bonus_balance = $amount;
                                $user->save();
                            }
                        }
                    }
                }

                $transaction->received_status = 'pending';
                if($transaction->save()){
                    $deleteStatus = 1;
                }

            }

            if($deleteStatus == 1){
                Alert::success('Success', 'Payment was unconfrimed successfully');
                return redirect()->back();
            }

            Alert::error('Error', 'An error occured, try again later');
            return redirect()->back();
            
        }catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }

    }

    public function deleteUserDeposit(Request $request){
        try{
            $deleteStatus = 0;

            $dataArray = explode('|', $request->deleteTransId);
            
            foreach ($dataArray as $each_unique_id) {
                //delete transaction
                $transaction = $this->invest->getSpecificTransaction($each_unique_id);

                if($transaction !== null){
                    if($transaction->delete()){
                        $deleteStatus = 1;
                    }
                }
            }

            if($deleteStatus == 1){
                Alert::success('Success', 'Payment was deleted successfully');
                return redirect()->back();
            }
            
            Alert::error('Error', 'An error occured, try again later');
            return redirect()->back();
            
        }catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
    }

    public function declineUserDeposit(Request $request){
        try{
            $deleteStatus = 0;

            $dataArray = explode('|', $request->uniqueIdToProcess);

            $appSettings = $this->appSettings->getSettings();
            
            foreach ($dataArray as $each_unique_id) {
                //delete transaction
                $transaction = $this->invest->getSpecificTransaction($each_unique_id);
                if($transaction !== null){
                   
                    $user = $this->user->getSingleUserWithCondition([
                        ['unique_id', $transaction->user_unique_id],
                    ]);

                    $transaction->plans;

                    if($appSettings->send_basic_emails != 'no'){
                        //send user deposit/investment mail
                        $this->invest->sendDepositDeclineMail($user, $transaction); 
                    }
                    $transaction->received_status = 'decline';
                    if($transaction->save()){
                        $deleteStatus = 1;
                    }
                }

            }

            if($deleteStatus == 1){
                Alert::success('Success', 'Payment was declined successfully');
                return redirect()->back();
            }
            
            Alert::error('Error', 'An error occured, try again later');
            return redirect()->back();

        }catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
    }

    public function interestAdderInterface(){

        $invest = $this->invest->getAllTransactionPagination(8, [
            ['received_status', 'confirmed']
        ]);

        $view = [
            'invest'=>$invest
        ];

        return view('backend.maual_intrest_adder', $view);
    }

    public function addInterestManually(Request $request){
        try {
            $data = $request->all();

            $appSettings = $this->appSettings->getSettings();

            $transaction = $this->invest->getSingleTransaction([
                ['unique_id', $data['investId']],
                ['received_status', '!=', 'pending']
            ]);

            if($transaction != null){
                $transaction->intrest_growth = $data['intrest'];
                $transaction->day_counter = $data['day_counter'];
                $transaction->no_of_days = $data['day_counter'];
                $transaction->save();

                if($appSettings->send_basic_emails != 'no'){
                    $currentDate = Carbon::now();
                    $dateFormat = $currentDate->format('l jS \\of F Y h:i:s A'); 
                    // send investment mail the user
                    $this->invest->sendInvestmentSummaryMailToUser($transaction->users, $transaction, $dateFormat);
                }

                Alert::success('Success', 'You request was successfully updated');
                return redirect()->back(); 

            }else{
                Alert::error('Error', 'This transaction is yet to be confirmed, endeavor to do so before adding the interest');
                return redirect()->back();
            }

        } catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
    }

    public function adminViewInvestmentMade(){
        $invest = $this->invest->getAllTransactionPagination(8, [
            ['received_status', 'confirmed']
        ]);

        $view = [
            'invest'=>$invest
        ];
      
        return view('backend.admin_investment_history', $view);
    }


}
