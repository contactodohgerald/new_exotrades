<?php

namespace App\Http\Controllers\CryptoPurchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Settings\SiteSetting;
use App\Traits\Generics;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CryptoPurchase\CryptoPurchase; 
use App\Models\Coins\CoinsToPurchase;
use App\Models\WalletAddress\WalletAddress;
use App\Traits\RequestHandler;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CryptoPurchaseController extends Controller
{
    //
    use Generics, RequestHandler;

    public function __construct(SiteSetting $setting, CryptoPurchase $cryptoPurchase, User $user, CoinsToPurchase $coinsToPurchase, WalletAddress $systemWallet){
        $this->setting = $setting;
        $this->cryptoPurchase = $cryptoPurchase;
        $this->user = $user;
        $this->coinsToPurchase = $coinsToPurchase;
        $this->systemWallet = $systemWallet;
    }

    public function cryptoPurchaseInterface(){

        $user = Auth::user();
        
        $setting = $this->setting->getSettings();
        
        $coinsToPurchase = $this->coinsToPurchase->getAllCoinsToPurchase([
            ['deleted_at', null]
        ]);

        $view = [
            'user'=>$user,
            'setting'=>$setting,
            'coinsToPurchase'=>$coinsToPurchase,
        ];

        return view('backend.crypto_purchase', $view);
    } 

    public function processCryptoPurchaseInterface($unique_id = null){
        if($unique_id != null){

            $user = Auth::user();

            $coinsToPurchase = $this->coinsToPurchase->getSingleCoinsToPurchase([
                ['unique_id', $unique_id],
            ]);
    
            $setting = $this->setting->getSettings();
    
            $view = [
                'user'=>$user,
                'setting'=>$setting,
                'coinsToPurchase'=>$coinsToPurchase,
            ];
    
            return view('backend.process_crypto_purchase', $view);
        }else{
            Alert::error('Error', 'An error occured, try again later');
            return redirect()->back();
        }
    } 

    public function processPurchase(Request $request, $unique_id = null){
        try {
            if($unique_id != null){

                $user = Auth::user();

                $request->validate([
                    'amount' => 'required',
                ]);

                $appSettings = $this->setting->getSettings(); 
                
                $wallet = $this->systemWallet->getSingleWalletAddress([
                    ['wallet_name', 'USDT'],
                ]);

                $cryptoPurchase = new CryptoPurchase();
                $cryptoPurchase->unique_id = $this->createUniqueId('crypto_purchases', 'unique_id');
                $cryptoPurchase->user_unique_id = $user->unique_id; 
                $cryptoPurchase->system_wallet_id = $wallet->unique_id; 
                $cryptoPurchase->coin_unique_id = $unique_id; 
                $cryptoPurchase->amount_to_buy = $request->amount;
                $cryptoPurchase->amount_to_pay = $request->amount;

                if($appSettings->send_basic_emails != 'no'){
                    //send user deposit creation mail
                    $this->cryptoPurchase->sendInvestmentDeposit($user, $cryptoPurchase); 
    
                    //send admin deposit detail mail
                    $this->cryptoPurchase->sendInvestmentDepositToAdmin($user, $cryptoPurchase);
                }
   
                $cryptoPurchase->save();
                Alert::success('Success', 'You purchase was syccessfully created, please proceed by making a deposit to the provided wallet address');
                return redirect()->route('comfirm-purchase', [$cryptoPurchase->unique_id]);
            
            }else{
                Alert::error('Error', 'An error occured, try again later');
                return redirect()->back();
            }
           
        } catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
    }

    public function comfirmCryptoPurchaseInterface($unique_id = null){

        if($unique_id != null){

            $cryptoPurchase = $this->cryptoPurchase->getSingleCryptoPurchase([
                ['unique_id', $unique_id]
            ]);

            $view = [
                'cryptoPurchase'=>$cryptoPurchase,
            ];
    
            return view('backend.confirm_crypto_purchase', $view);

        }else {
            Alert::error('Error', 'An error occured, try again later');
            return redirect()->back();
        }

    } 

    public function uploadPaymentProof(Request $request, $unique_id = null){
        try{
            if($unique_id != null){

                $cryptoPurchase = $this->cryptoPurchase->getSingleCryptoPurchase([
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

                $cryptoPurchase->payment_proof = $thumbnailUrl;
                $cryptoPurchase->save();

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
 
    public function cryptoPurchaseHistoryInterface(){

        $user = Auth::user();

        $cryptoPurchase = $this->cryptoPurchase->getAllCryptoPurchasePaginate([
            ['user_unique_id', $user->unique_id]
        ], 8);

        $view = [
            'cryptoPurchase'=>$cryptoPurchase
        ];

        return view('backend.crypto_purchase_history', $view);
    } 

    public function adminComfirmCryptoPurchaseInterface(){

        $cryptoPurchase = $this->cryptoPurchase->getAllCryptoPurchasePaginate([
            ['settled_status', 'no'],
        ], 8);

        $view = [
            'cryptoPurchase'=>$cryptoPurchase
        ];

        return view('backend.confirm_purchase', $view);
    }

    public function confirmUserDeposit(Request $request){
        try{
            $deleteStatus = 0;
            
            $dataArray = explode('|', $request->transId);
            
            $appSettings = $this->setting->getSettings();
            
            foreach ($dataArray as $each_unique_id) {
                //get transaction
                $cryptoPurchase = $this->cryptoPurchase->getSpecificCryptoPurchase($each_unique_id);
                if($cryptoPurchase !== null){
                   
                    $user = $this->user->getSingleUserWithCondition([
                        ['unique_id', $cryptoPurchase->user_unique_id],
                    ]); 

                    $cryptoPurchase->received_status = 'confirmed';
                    $cryptoPurchase->status = 'processing';

                    if($appSettings->send_basic_emails != 'no'){
                        //send user deposit/investment mail
                        $this->cryptoPurchase->sendDepositConfirmationMail($user, $cryptoPurchase);
                    }

                    if($cryptoPurchase->save()){
                        $deleteStatus = 1;
                    }

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
            
            foreach ($dataArray as $each_unique_id) {
                //get transaction
                $cryptoPurchase = $this->cryptoPurchase->getSpecificCryptoPurchase($each_unique_id);
                if($cryptoPurchase !== null){

                    $cryptoPurchase->received_status = 'pending';
                    $cryptoPurchase->status = 'pending';

                    if($cryptoPurchase->save()){
                        $deleteStatus = 1;
                    }
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

    public function declineUserDeposit(Request $request){
        try{
            $deleteStatus = 0;

            $dataArray = explode('|', $request->uniqueIdToProcess);

            $appSettings = $this->setting->getSettings();
            
            foreach ($dataArray as $each_unique_id) {
                //get transaction
                $cryptoPurchase = $this->cryptoPurchase->getSpecificCryptoPurchase($each_unique_id);
                if($cryptoPurchase !== null){
                   
                    $user = $this->user->getSingleUserWithCondition([
                        ['unique_id', $cryptoPurchase->user_unique_id],
                    ]);

                    if($appSettings->send_basic_emails != 'no'){
                        //send user deposit/investment mail
                        $this->cryptoPurchase->sendDepositDeclineMail($user, $cryptoPurchase); 
                    }
                    $cryptoPurchase->received_status = 'decline';
                    if($cryptoPurchase->save()){
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

    public function deleteUserDeposit(Request $request){
        try{
            $deleteStatus = 0;

            $dataArray = explode('|', $request->deleteTransactionId);
    
            foreach ($dataArray as $each_unique_id) {
                //delete transaction
                $cryptoPurchase = $this->cryptoPurchase->getSpecificCryptoPurchase($each_unique_id);

                if($cryptoPurchase !== null){
                    if($cryptoPurchase->delete()){
                        $deleteStatus = 1;
                    }
                }
            }

            if($deleteStatus == 1){
                Alert::success('Success', 'Transaction was successfully deleted');
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

    public function adminViewInvestmentMade(){

        $cryptoPurchase = $this->cryptoPurchase->getAllCryptoPurchasePaginate([
            ['received_status', 'confirmed'],
        ], 8);

        $view = [
            'cryptoPurchase'=>$cryptoPurchase
        ];
       
        return view('backend.admin_purchase_history', $view);
    }

    public function cryptoPurchasePayoutInterface(){

        $appSettings = $this->setting->getSettings(); 

        $cryptoPurchase = $this->cryptoPurchase->getAllCryptoPurchasePaginate([
            ['received_status', 'confirmed'],
            ['day_counter', '=', $appSettings->purchase_coin_duration],
            ['status', 'completed'], 
            ['settled_status', 'no'], 
        ], 8);
    
        $view = [
            'cryptoPurchase'=>$cryptoPurchase
        ];
       
        return view('backend.crypto_purchase_payout', $view);
    }

    public function cryptoPurchasePayoutHistoryInterface(){

        $appSettings = $this->setting->getSettings(); 

        $cryptoPurchase = $this->cryptoPurchase->getAllCryptoPurchasePaginate([
            ['status', 'completed'], 
            ['settled_status', 'yes'], 
        ], 8);
   
        $view = [
            'cryptoPurchase'=>$cryptoPurchase
        ];
       
        return view('backend.admin_crypto_purchase_history', $view);
    }

    public function payoutToUser(Request $request){
        try {

            $transId = $request->transId;

            $cryptoPurchase = $this->cryptoPurchase->getSingleCryptoPurchase([
                ['unique_id', $transId]
            ]);    

            $setting = $this->setting->getSettings();

            if($cryptoPurchase != null){

                $interest = $cryptoPurchase->users->main_balance + $cryptoPurchase->amount_to_pay;
                $cryptoPurchase->users->main_balance  = $interest;
                $cryptoPurchase->users->save();

                $cryptoPurchase->settled_status = 'yes';
                $cryptoPurchase->save();

                Alert::success('Success', 'Payout to this user was processed successfully');
                return redirect()->back();

            }else{
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
