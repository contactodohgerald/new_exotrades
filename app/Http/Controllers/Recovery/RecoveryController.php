<?php

namespace App\Http\Controllers\Recovery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Generics;
use App\Models\Settings\SiteSetting;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Recovery\AccountRecovery;
use App\Models\Recovery\AccountRecoveryTwo;
use App\Models\WalletAddress\WalletAddress;
use App\Models\User;
use Exception;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class RecoveryController extends Controller
{
    //
    use Generics;
    public function __construct(User $user, SiteSetting $appSettings, AccountRecovery $accountRecovery, WalletAddress $systemWallet, AccountRecoveryTwo $accountRecoveryTwo){
        $this->user = $user;
        $this->appSettings = $appSettings;
        $this->accountRecovery = $accountRecovery;
        $this->systemWallet = $systemWallet;
        $this->accountRecoveryTwo = $accountRecoveryTwo;
    }

    public function viewRecoveryRequest(){
        $appSettings = $this->appSettings->getSettings();

        $accountRecovery = $this->accountRecovery->getAllAccountRecoveryPagination(8, [
            ['status', '=', 'pending']
        ]);

        $accountRecoveryConfirm = $this->accountRecovery->getAllAccountRecoveryPagination(12, [
            ['status', '!=', 'pending']
        ]);

        $view = [
            'accountRecoveryConfirm'=>$accountRecoveryConfirm,
            'accountRecovery'=>$accountRecovery,
            'appSettings'=>$appSettings,
        ];

        return view('backend.view_recovery_request', $view);
    }   
    
    public function recoverInterfacePage($reCode = null){
        if($reCode != null){
            $user = Auth::user();
            $appSettings = $this->appSettings->getSettings();

            $systemWallet = $this->systemWallet->getAllWalletAddress([
                ['deleted_at', null]
            ]);

            if($reCode != $user->unique_id){
                Alert::error('Error', 'Recovery Code does not belong to this account');
                return redirect()->to('dashboard');
            }
    
            $view = [
                'reCode'=>$reCode,
                'systemWallet'=>$systemWallet,
                'user'=>$user,
                'appSettings'=>$appSettings,
            ];
    
            return view('backend.account_recovery', $view);
        }else{
            Alert::error('Error', 'Inavlid Recovery Code');
            return redirect()->back();
        }
    }
    
    public function portifolioTransferInterface(){
        $user = Auth::user();
        $appSettings = $this->appSettings->getSettings();

        $systemWallet = $this->systemWallet->getAllWalletAddress([
            ['deleted_at', null]
        ]);

        $view = [
            'systemWallet'=>$systemWallet,
            'user'=>$user,
            'appSettings'=>$appSettings,
        ];

        return view('backend.portifolio_transfer', $view);
    }

    public function processRecoveryRequest(Request $request){
        try{
            $user = Auth::user();
            $data = $request->all();

            $request->validate([
                'email' => 'required',
                'amount' => 'required',
                'system_wallet_id' => 'required',
            ]);

            if($user->email != $data['email']){
                Alert::error('Error', 'The email address you entered does not correspond');
                return redirect()->back();
            }

            $thumbnailUrl = 'default.png';
            // addind the image to cloudinary
            if ($request->hasFile('thumbnail')) {
                // Uploading an image file to cloudinary and resizing the image to a resolution specified by the dimension parameters with one line of code
                $thumbnailUrl = Cloudinary::upload($request->file('thumbnail')->getRealPath(), [
                    'folder' => 'exotrades/recovery_proof',
                    'transformation' => [
                        'width' => 1000,
                        'height' => 500
                    ]
                ])->getSecurePath();
            }

            $recovery = new AccountRecovery();
            $recovery->unique_id = $this->createUniqueId('account_recoveries');
            $recovery->user_unique_id = $user->unique_id;
            $recovery->recovery_amount = $data['amount'];
            $recovery->system_wallet_id = $data['system_wallet_id'];
            $recovery->first_date = $data['first_date'];
            $recovery->last_date = $data['last_date'];
            $recovery->proof = $thumbnailUrl;
            $recovery->account_id = $this->createConfirmationNumbers('account_recoveries', 'account_id', 6);

            $message = 'A recovery request of '.$data['amount'].' was made by '.$user->name.'. Please confirm the request.';

            $this->accountRecovery->sendAdminMail($user, $recovery, $message);

            $recovery->save();
            Alert::success('Success', 'Upload a proof of your payment below for easy confirmation');
            return redirect()->route('make/recovery/payment', [$recovery->unique_id]);

        }catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
    }    

    public function makeRecoveryPayment($unique_id = null){
        if($unique_id != null){

            $accountRecovery = $this->accountRecovery->getSingleAccountRecovery([
                ['unique_id', '=', $unique_id]
            ]);

            $user = Auth::user();
            $appSettings = $this->appSettings->getSettings();
    
            $view = [
                'accountRecovery'=>$accountRecovery,
                'user'=>$user,
                'appSettings'=>$appSettings,
            ];
    
            return view('backend.make_recovery_payment', $view);
        }else{
            Alert::error('Error', 'Inavlid Recovery Code');
            return redirect()->back();
        }
    }

    public function uploadRecoveryProof(Request $request, $unique_id = null){
        try{
            if($unique_id != null){

                $accountRecovery = $this->accountRecovery->getSingleAccountRecovery([
                    ['unique_id', '=', $unique_id]
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

                $accountRecovery->payment_proof = $thumbnailUrl;
                $accountRecovery->save();

                $message = 'Payment proof of '.$thumbnailUrl.' was uploaded by '.$accountRecovery->user->name.'. Please confirm the request.';
                $this->accountRecovery->sendAdminMail2($accountRecovery->users, $accountRecovery, $message); 

                Alert::success('Success', 'We have received your payment proof, and our team of expert we review and begin processing your portifolio retrieval. Note this will take 2-3 working days');
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

    public function approveRecoveryRequest(Request $request){
        try{
            $user = Auth::user();
            $deleteStatus = 0;
            
            $dataArray = explode('|', $request->transId);

            $appSettings = $this->appSettings->getSettings();
            
            foreach ($dataArray as $each_unique_id) {
                $accountRecovery = $this->accountRecovery->getSpecificAccountRecoveryal($each_unique_id);
                if($accountRecovery != null){
                    $accountRecovery->status = 'confirmed';
                    $accountRecovery->portifolio_value = $request->amount;
                    $accountRecovery->comp_days = $request->days;
                    $accountRecovery->rollover = $request->rollover;
                    $accountRecovery->save();
                    if($appSettings->send_basic_emails != 'no'){
                        //send user confirm mail
                        $this->accountRecovery->sendRecoveryConfirmMail($accountRecovery->users, $accountRecovery); 
                        $message = 'The recovery request of '.$accountRecovery->amount.' was confirmed by '.$user->name.'. for the total recovery of'.$accountRecovery->recovery_amount;
                        $this->accountRecovery->sendAdminMail2($accountRecovery->users, $accountRecovery, $message); 
                    }
                    $deleteStatus = 1;
                }
            }

            if($deleteStatus == 1){
                Alert::success('Success', 'Payment was successfully approved');
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

    public function deleteRecoveryRequest(Request $request){
        try{
            $deleteStatus = 0;

            $dataArray = explode('|', $request->deleteTransId);
            
            foreach ($dataArray as $each_unique_id) {
                //delete transaction
                $accountRecovery = $this->accountRecovery->getSpecificAccountRecoveryal($each_unique_id);

                if($accountRecovery !== null){
                    if($accountRecovery->delete()){
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

    public function accessFundsInterface(){
        $user = Auth::user();

        $accountRecovery = $this->accountRecovery->getSingleAccountRecovery([
            ['user_unique_id', '=', $user->unique_id],
            ['status', '=', 'confirmed']
        ]);

        if($accountRecovery != null){
            $recovery = $this->accountRecoveryTwo->getSingleAccountRecoveryTwo([
                ['recovery_id', '=', $accountRecovery->unique_id],
                ['status', '=', 'confirmed']
            ]);

            if($recovery == null){
                Alert::error('Error', 'You have not made any recovery request');
                return redirect()->back();
            }

            $appSettings = $this->appSettings->getSettings();

            $systemWallet = $this->systemWallet->getAllWalletAddress([
                ['deleted_at', null]
            ]);

            $view = [
                'accountRecovery'=>$accountRecovery,
                'systemWallet'=>$systemWallet,
                'appSettings'=>$appSettings,
            ];

            return view('backend.access_funds', $view);
        }else{
            Alert::error('Error', 'An error occured while processing request');
            return redirect()->back();
        }
    }

    public function processFundsTransfer(Request $request, $unique_id = null){
        if($unique_id != null){
            $user = Auth::user();
            $data = $request->all();

            $request->validate([
                'amount' => 'required',
                'system_wallet_id' => 'required',
            ]);

            $recovery = new AccountRecoveryTwo();
            $recovery->unique_id = $this->createUniqueId('account_recovery_twos');
            $recovery->user_unique_id = $user->unique_id;
            $recovery->recovery_id = $unique_id;
            $recovery->trader_fee = $data['amount'];
            $recovery->service_charge = 0;
            $recovery->system_wallet_id = $data['system_wallet_id'];
            $recovery->type = 'third';
            $recovery->save();

            $message = 'A recovery request of '.$data['amount'].' was made by '.$user->name.'. Please confirm the request.';
            $this->accountRecovery->sendAdminMail($user, $recovery, $message);

            Alert::success('Success', 'Upload a proof of your payment below for easy confirmation');
            return redirect()->route('funds/access/payment', [$recovery->unique_id]);

        }else{
            Alert::error('Error', 'An error occured, try again later');
            return redirect()->back();
        }
    } 
    
    public function paymentInvoiceinterface($unique_id = null){
        if($unique_id != null){     
            $accountRecovery = $this->accountRecoveryTwo->getSingleAccountRecoveryTwo([
                ['unique_id', '=', $unique_id]
            ]);

            $user = Auth::user();
            $appSettings = $this->appSettings->getSettings();
    
            $view = [
                'accountRecovery'=>$accountRecovery,
                'user'=>$user,
                'appSettings'=>$appSettings,
            ];
    
            return view('backend.trader_fee_payment', $view);
        }else{
            Alert::error('Error', 'Inavlid Recovery Code');
            return redirect()->back();
        }
    }

    public function uploadTraderFeeProof(Request $request, $unique_id = null){
        try{
            if($unique_id != null){

                $accountRecovery = $this->accountRecoveryTwo->getSingleAccountRecoveryTwo([
                    ['unique_id', '=', $unique_id]
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

                $accountRecovery->proof = $thumbnailUrl;
                $accountRecovery->save();

                $message = 'Payment proof of '.$thumbnailUrl.' was uploaded by '.$accountRecovery->user->name.'. Please confirm the request.';
                $this->accountRecovery->sendAdminMail2($accountRecovery->users, $accountRecovery, $message); 

                Alert::success('Success', 'We have received your payment proof, and our team of expert we review and begin processing your portifolio retrieval. Note this will take 14-21 working days');
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

    public function sendRecoveryLink(Request $request){
        $request->validate([
            'link' => 'required',
        ]);

        $user = $this->user->getSingleUserWithCondition([
            ['unique_id', '=', $request->link],
        ]);

        if($user == null){
            Alert::error('Error', 'An error occured while processing this request');
            return redirect()->back();
        }

        $link = env('APP_URL').'/user/account/recovery/'.$user->unique_id;

        $this->accountRecovery->sendRecoveryMail($user, $link);

        Alert::success('Success', 'Mail was sucessfully sent to user');
        return redirect()->back();
    }    
}
