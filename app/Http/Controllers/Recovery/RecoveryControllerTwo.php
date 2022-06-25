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

class RecoveryControllerTwo extends Controller
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

    public function verifyAccountID(Request $request){
        try{
            $user = Auth::user();
            $data = $request->all();

            $request->validate([
                'account_id' => 'required',
            ]);

            $recovery = $this->accountRecovery->getSingleAccountRecovery([
                ['account_id', '=', $data['account_id']],
                ['user_unique_id', '=', $user->unique_id],
            ]);

            if($recovery == null){
                Alert::error('Error', 'Account ID provided is inavlid');
                return redirect()->back();
            }

            Alert::success('Success', 'Account ID is valid');
            return redirect()->route('recovery/phase/two', [$recovery->unique_id]);

        }catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function makeServiceChargePayment($unique_id = null){
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
    
            return view('backend.make_service_charge_payment', $view);
        }else{
            Alert::error('Error', 'Inavlid Recovery Code');
            return redirect()->back();
        }
    }

    public function processServiceCharge(Request $request, $unique_id = null){
        if($unique_id != null){
            $user = Auth::user();
            $data = $request->all();

            $request->validate([
                'system_wallet_id' => 'required',
            ]);

            $accountRecovery = $this->accountRecovery->getSingleAccountRecovery([
                ['unique_id', '=', $unique_id]
            ]);

            $cal = ($accountRecovery->recovery_amount * 2) / 100;

            $recoveryTwo = new AccountRecoveryTwo();
            $recoveryTwo->unique_id = $this->createUniqueId('account_recovery_twos');
            $recoveryTwo->user_unique_id = $user->unique_id;
            $recoveryTwo->recovery_id = $accountRecovery->unique_id;
            $recoveryTwo->service_charge = $cal;
            $recoveryTwo->system_wallet_id = $data['system_wallet_id'];
            $recoveryTwo->save();

            $message = 'A recovery request of '.$cal.' was made by '.$user->name.'. Please confirm the request.';
            $this->accountRecovery->sendAdminMail($user, $recoveryTwo, $message);
            $this->accountRecovery->sendAdminMail2($user, $recoveryTwo, $message); 

            Alert::success('Success', 'Upload a proof of your payment below for easy confirmation');
            return redirect()->route('make/service/charge/payment', [$recoveryTwo->unique_id]);
        }else{
            Alert::error('Error', 'An error occured while processing your request');
            return redirect()->back();
        }
    }

    public function processRecoveryPhaseTwo($unique_id = null){
        if($unique_id != null){

            $accountRecovery = $this->accountRecovery->getSingleAccountRecovery([
                ['unique_id', '=', $unique_id]
            ]);

            $user = Auth::user();
            $appSettings = $this->appSettings->getSettings();

            $systemWallet = $this->systemWallet->getAllWalletAddress([
                ['deleted_at', null]
            ]);
    
            $view = [
                'systemWallet'=>$systemWallet,
                'accountRecovery'=>$accountRecovery,
                'user'=>$user,
                'appSettings'=>$appSettings,
            ];
    
            return view('backend.recovery_phase_two', $view);
        }else{
            Alert::error('Error', 'An error occured while processing your request');
            return redirect()->back();
        }
    }

    public function serviceChargeInterface($unique_id = null){
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

    public function uploadServiceChargeProof(Request $request, $unique_id = null){
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

                $accountRecovery->payment_proof = $thumbnailUrl;
                $accountRecovery->save();

                $message = 'Payment proof of '.$thumbnailUrl.' was uploaded by '.$accountRecovery->user->name.'. Please confirm the request.';
                $this->accountRecovery->sendAdminMail2($accountRecovery->users, $accountRecovery, $message); 

                Alert::success('Success', 'We have received your payment proof, and our team of expert we review and begin processing your portifolio retrieval. Note this will take 5-7 working days');
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

    public function viewFundTransfer(){
        $appSettings = $this->appSettings->getSettings();

        $accountRecoveryTwo = $this->accountRecoveryTwo->getAllAccountRecoveryTwoPagination(8, [
            ['status', '=', 'pending'],
            ['type', '=', 'second'],
        ]);

        $accountRecovery = $this->accountRecoveryTwo->getAllAccountRecoveryTwoPagination(12, [
            ['status', '!=', 'pending'],
            ['type', '=', 'second'],
        ]);

        $view = [
            'accountRecovery'=>$accountRecovery,
            'accountRecoveryTwo'=>$accountRecoveryTwo,
            'appSettings'=>$appSettings,
        ];

        return view('backend.recovery_request_history', $view);
    } 

    public function approveFundTransfer(Request $request){
        try{
            $user = Auth::user();
            $deleteStatus = 0;
            
            $dataArray = explode('|', $request->transId);

            $appSettings = $this->appSettings->getSettings();
            
            foreach ($dataArray as $each_unique_id) {
                $accountRecovery = $this->accountRecoveryTwo->getSpecificAccountRecoveryTwo($each_unique_id);
                if($accountRecovery != null){
                    $accountRecovery->status = 'confirmed';
                    $accountRecovery->save();
                    if($appSettings->send_basic_emails != 'no'){
                        //send user confirm mail
                        $this->accountRecoveryTwo->sendRecoveryPhaseTwoMail($accountRecovery->users, $accountRecovery); 
                        $message = 'The fund transfer fee of '.$accountRecovery->service_charge.' was confirmed by '.$user->name;
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

    public function deleteFundTransferRequest(Request $request){
        try{
            $deleteStatus = 0;

            $dataArray = explode('|', $request->deleteTransId);
            
            foreach ($dataArray as $each_unique_id) {
                //delete transaction
                $accountRecovery = $this->accountRecoveryTwo->getSpecificAccountRecoveryTwo($each_unique_id);
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

    public function viewAccessFunds(){
        $appSettings = $this->appSettings->getSettings();

        $accountRecoveryTwo = $this->accountRecoveryTwo->getAllAccountRecoveryTwoPagination(8, [
            ['status', '=', 'pending'],
            ['type', '=', 'third'],
        ]);

        $accountRecovery = $this->accountRecoveryTwo->getAllAccountRecoveryTwoPagination(12, [
            ['status', '!=', 'pending'],
            ['type', '=', 'third'],
        ]);

        $view = [
            'accountRecovery'=>$accountRecovery,
            'accountRecoveryTwo'=>$accountRecoveryTwo,
            'appSettings'=>$appSettings,
        ];

        return view('backend.view_access_funds', $view);
    } 
}
