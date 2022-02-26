<?php

namespace App\Http\Controllers\Referral;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\RefWithdrawal\RefBalanceWithdraw;
use App\Models\WalletAddress\UserWalletAddress;
use App\Traits\Generics;
use App\Models\Settings\SiteSetting;
use RealRashid\SweetAlert\Facades\Alert;

class ReferralController extends Controller
{
    //
    use Generics;
    public function __construct(User $user, RefBalanceWithdraw $refComission, SiteSetting $appSettings, UserWalletAddress $userWallet){
        $this->user = $user;
        $this->refComission = $refComission;
        $this->appSettings = $appSettings;
        $this->userWallet = $userWallet;
    }


    public function referralInterface(){

        $user = Auth::user();

        $appSettings = $this->appSettings->getSettings();

        $downline = $this->user->getUsersWithConditionPaginate(8, [
            ['referred_id', $user->referral_id],
        ]);

        $view = [
            'user'=>$user,
            'downline'=>$downline,
            'setting'=>$appSettings,
        ];

        return view('backend.my_referrals', $view);
    }

    public function withdrawComission(){
        $user = Auth::user();

        $refComission = $this->refComission->getAllRefBalanceWithdrawalPagination(8, [
            ['user_unique_id', $user->unique_id]
        ]);

        $userWallet = $this->userWallet->getAllUserWalletAddress([
            ['user_unique_id', $user->unique_id],
        ]);

        $view = [
            'user'=>$user,
            'refComission'=>$refComission,
            'userWallet'=>$userWallet,
        ];

        return view('backend.ref_comission_withdraw', $view);
    }

    public function createComissionWithdrawInvoice(Request $request){
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

            if($user->ref_bonus_balance == 0){
                Alert::error('Error', 'Insufficient fund');
                return redirect()->back();
            }

            if($data['amount'] >= $user->ref_bonus_balance){
                Alert::error('Error', 'Insufficient fund');
                return redirect()->back();
            }

            $user->ref_bonus_balance = $user->ref_bonus_balance - $data['amount'];
            $user->save(); 

            $withdrawal = new RefBalanceWithdraw();
            $withdrawal->unique_id = $this->createUniqueId('ref_balance_withdraws', 'unique_id');
            $withdrawal->user_unique_id = $user->unique_id;
            $withdrawal->user_wallet_unique_id = $data['user_wallet_unique_id'];
            $withdrawal->amount = $data['amount'];

            if($appSettings->send_basic_emails != 'no'){

                 $this->withdrawal->sendReferralWithdrawalMailToUser($user, $withdrawal); 

                 $this->withdrawal->sendWithdrawalMailToAdmin($user, $withdrawal);
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

    public function reComisiionPayoutInterface(){

        $refComission = $this->refComission->getAllRefBalanceWithdrawalPagination(8, [
            ['status', 'pending'],
            ['remove_status', 'no'],
        ]);

        $view = [
            'refComission'=>$refComission,
        ];

        return view('backend.re_comisiion_payout', $view);

    }

    public function comissionPayoutProcessor($unique_id = null){

        if($unique_id != null){
            $withdraw = $this->refComission->getSingleRefBalanceWithdrawal([
                ['unique_id', $unique_id],
            ]);
    
            $view = [
                'withdraw'=>$withdraw,
            ];

            return view('backend.comission_payout_processor', $view);
        }
       
    }

    public function comfirmRefComissionPayment(Request $request, $unique_id = null){
        try{
            $deleteStatus = 0;

            $dataArray = explode('|', $request->uniqueIdToProcess);

            $appSettings = $this->appSettings->getSettings();
            
            foreach ($dataArray as $each_unique_id) {
                //delete withdrawal
                $withdrawal = $this->refComission->getSpecificRefBalanceWithdrawal($each_unique_id);

                $withdrawal->status = 'confirmed';
                $withdrawal->remove_status = 'yes';

                $withdrawal->user_wallet->system_wallet;

                if($appSettings->send_basic_emails != 'no'){
                    //send user withdrawal confrimation notification
                    $this->refComission->sendComfirmationMailForReferralWithdrawalMailToUser($withdrawal->users, $withdrawal); 
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

    public function comissionPaymentHistoryInterface(){

        $withdraw = $this->refComission->getAllRefBalanceWithdrawalPagination(8, [
            ['status', 'confirmed'],
            ['remove_status', 'yes'],
        ]);

        $view = [
            'withdraw'=>$withdraw,
        ];

        return view('backend.comission_payment_history', $view);
    }
}
