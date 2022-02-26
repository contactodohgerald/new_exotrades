<?php

namespace App\Http\Controllers\Withdrawals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Settings\SiteSetting;
use App\Models\Withdrawal\BalanceWithdrawal;
use App\Models\WalletAddress\UserWalletAddress;
use App\Models\Withdraw;
use App\Traits\Generics;
use RealRashid\SweetAlert\Facades\Alert;

class MainBalanceWithdrawal extends Controller
{
    //
    use Generics;
    public function __construct(SiteSetting $appSettings, UserWalletAddress $userWallet, BalanceWithdrawal $withdraw, User $user){
        $this->appSettings = $appSettings;
        $this->userWallet = $userWallet;
        $this->withdraw = $withdraw;
        $this->user = $user;
    }

    public function withdrawalFundInterface(){
        $user = Auth::user();

        $setting = $this->appSettings->getSettings();

        $userWallet = $this->userWallet->getAllUserWalletAddress([
            ['user_unique_id', $user->unique_id],
        ]);

        $view = [
            'user'=>$user,
            'setting'=>$setting,
            'userWallet'=>$userWallet,
        ];
        return view('backend.withdraw_funds', $view);
    }

    public function createWithdrawalInvoice(Request $request){
        try{
            $user = Auth::user();
            $data = $request->all();

            $appSettings = $this->appSettings->getSettings();

            $validator = Validator::make($data, [
                'user_wallet_unique_id' => 'required',
                'amount' => 'required',
            ]);
            if($validator->fails()){
                Alert::error('Error', $validator->messages());
                return redirect()->back();                    
            }

            $wallet = $this->userWallet->getSingleUserWalletAddress([
                ['unique_id', $data['user_wallet_unique_id']]
            ]);
            if($wallet == null){
                Alert::error('Error', 'No wallet address is set up');
                return redirect()->back();
            }

            if($user->main_balance == 0){
                Alert::error('Error', 'Insufficient fund, invest to have a withdrawalable fund');
                return redirect()->back();
            } 
                  
            if($appSettings->min_wallet_withdrawal <= $user->main_balance){
                Alert::error('Error', 'Insufficient fund, invest to have a withdrawalable fund');
                return redirect()->back();
            }

            if($data['amount'] >= $appSettings->max_amount_to_withdraw){
                Alert::error('Error', 'Amount exceeds the minimium withdrawal limit');
                return redirect()->back();
            }

            $user->main_balance = $user->main_balance - $data['amount'];
            $user->save(); 

            $withdrawal = new BalanceWithdrawal();
            $withdrawal->unique_id = $this->createUniqueId('balance_withdrawals', 'unique_id');
            $withdrawal->user_unique_id = $user->unique_id;
            $withdrawal->user_wallet_unique_id = $data['user_wallet_unique_id'];
            $withdrawal->amount = $data['amount'];

            if($appSettings->send_basic_emails != 'no'){
                 //send user withdrawal notification mail
                 $this->withdrawal->sendWithdrawalNotification($user, $withdrawal, $withdrawal->user_wallet->wallet_address, $withdrawal->user_wallet->system_wallet->wallet_name); 

                 //send admin withdrawal notification mail
                 $this->withdrawal->sendWithdrawalMailToAdmin($user, $withdrawal, $withdrawal->user_wallet->wallet_address, $withdrawal->user_wallet->system_wallet->wallet_name); 
            }

            if($withdrawal->save()){
                Alert::success('Success', 'Your withdrawal was placed successfully, please wait patiaintly for admin\'s approval');
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

    public function withdrawalHistoryInterface(){

        $user = Auth::user();

        $withdraw = $this->withdraw->getAllBalanceWithdrawalPagination(8, [
            ['user_unique_id', $user->unique_id],
        ]);

        $view = [
            'withdraw'=>$withdraw,
        ];

        return view('backend.withdrawal_history', $view);
    }

    public function payoutInterface(){

        $withdraw = $this->withdraw->getAllBalanceWithdrawalPagination(8, [
            ['status', 'pending'],
            ['remove_status', 'no'],
        ]);

        $view = [
            'withdraw'=>$withdraw,
        ];

        return view('backend.payouts', $view);
    }

    public function payoutProcessor($unique_id = null){

        if($unique_id != null){

            $withdraw = $this->withdraw->getSingleBalanceWithdrawal([
                ['unique_id', $unique_id],
            ]);
    
            $view = [
                'withdraw'=>$withdraw,
            ];

            return view('backend.payout_processor', $view);
        }
       
    }

    public function comfirmPayment(Request $request){
        try{
            $deleteStatus = 0;

            $dataArray = explode('|', $request->uniqueIdToProcess);

            $appSettings = $this->appSettings->getSettings();
            
            foreach ($dataArray as $each_unique_id) {
                
                $withdrawal = $this->withdraw->getSpecificBalanceWithdrawal($each_unique_id);

                $withdrawal->status = 'confirmed';
                $withdrawal->remove_status = 'yes';

                $withdrawal->user_wallet->system_wallet;

                if($appSettings->send_basic_emails != 'no'){
                    //send user withdrawal confrimation notification
                    $this->withdraw->sendPaymentNotification($withdrawal->users, $withdrawal, $withdrawal->user_wallet); 
                }
                if($withdrawal->save()){
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

    public function paymentHistoryInterface(){

        $withdraw = $this->withdraw->getAllBalanceWithdrawalPagination(8, [
            ['status', 'confirmed'],
            ['remove_status', 'yes'],
        ]);

        $view = [
            'withdraw'=>$withdraw,
        ];

        return view('backend.payment_history', $view);
    }

    public function sendMailForWalletUpdate(Request $request, $unique_id = null){
        try {
                    
            if($unique_id != null){
                
                $data = $request->all();

                $appSettings = $this->appSettings->getSettings();

                $withdrawal = $this->withdraw->getSingleBalanceWithdrawal([
                    ['unique_id', $unique_id],
                ]);

                if($appSettings->send_basic_emails != 'no'){
                    //send user wallet update mail 
                     $this->withdraw->sendWalletUpdateMail($withdrawal->users, $data['message']);
                } 

                Alert::success('Success', 'Mail was successfully sent');
                return redirect()->back();
               
            }else {
                Alert::error('Error', 'An error occured, try again later');
                return redirect()->back();    
            }

        } catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
    }

}
