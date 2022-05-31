<?php

namespace App\Http\Controllers\EmergencyWithdraw;

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
use App\Models\WalletAddress\UserWalletAddress;
use App\Models\RefWithdrawal\RefBalanceWithdraw;
use App\Traits\Generics;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

class EmergencyCashoutController extends Controller
{
    //
    use Generics;
    public function __construct(InvestmentPlan $plan, SiteSetting $appSettings, Transaction $invest, User $user, WalletAddress $systemWallet, UserWalletAddress $userWallet, RefBalanceWithdraw $refComission){
        $this->plan = $plan;
        $this->appSettings = $appSettings;
        $this->invest = $invest;
        $this->user = $user;
        $this->systemWallet = $systemWallet;
        $this->userWallet = $userWallet;
        $this->refComission = $refComission;
    }

    public function withdrawInvestInterface(){

        $user = Auth::user();

        $invest = $this->invest->getAllTransactionPagination(8, [
            ['user_unique_id', $user->unique_id]
        ]);

        $appSettings = $this->appSettings->getSettings();

        $view = [
            'invest'=>$invest,
            'appSettings'=>$appSettings,
        ];

        return view('backend.investment_cashout', $view);
    }

    public function investWithdrawInterface($unique_id = null){

        if($unique_id != null){

            $user = Auth::user();

            $invest = $this->invest->getSingleTransaction([
                ['unique_id', $unique_id]
            ]);

            $appSettings = $this->appSettings->getSettings();

            $userWallet = $this->userWallet->getAllUserWalletAddress([
                ['user_unique_id', $user->unique_id],
            ]);
           
            $view = [
                'invest'=>$invest,
                'appSettings'=>$appSettings,
                'userWallet'=>$userWallet,
            ];
         
            return view('backend.investment_withdraw', $view);
        }else{
            Alert::error('Error', 'An error occured, try again later');
            return redirect()->back();
        }
    }

    public function placeWithdrawalInvest(Request $request, $uniqueId = null){
        try {
            $data = $request->all();
            $user = Auth::user();

            $request->validate([
                'amount' => 'required',
                'user_wallet_unique_id' => 'required',
            ]);

            $invest = $this->invest->getSingleTransaction([
                ['unique_id', $uniqueId]
            ]);

            if($data['amount'] > $invest->amount){
                Alert::error('Error', 'The Amount for shouldn\'t be higher than $'.number_format($invest->amount));
                return redirect()->back();
            }

            $invest->amount = $invest->amount - $data['amount'];
            $invest->save();
           
            $appSettings = $this->appSettings->getSettings();
            $cal_amount = $data['amount'] * ($appSettings->withdrawal_penalty/100);
            $amount = $data['amount'] - $cal_amount;

            $withdrawal = new RefBalanceWithdraw();
            $withdrawal->unique_id = $this->createUniqueId('ref_balance_withdraws', 'unique_id');
            $withdrawal->user_unique_id = $user->unique_id;
            $withdrawal->user_wallet_unique_id = $data['user_wallet_unique_id'];
            $withdrawal->amount = $amount;
            $withdrawal->withdraw_type = 'emergency_withdrawal'; 
            
            if($appSettings->send_basic_emails != 'no'){

                //send user withdrawal notification mail
                $this->refComission->sendUnfinishedInvestmentWithdrawalMailToUser($user, $invest); 

                //send user withdrawal notification mail
                $this->refComission->sendReinvestmentMailToAdmin($user, $invest);
            }

            if($withdrawal->save()){
                Alert::success('Success', 'Your withdrawal was placed successfully, please wait patiaintly for admin\'s approval');
                return redirect()->back();
            }else {
                Alert::error('Error', 'An error occured, try again later');
                return redirect()->back();
            }
        } catch (Exception $exception) {
            $error = $exception->getMessage();
            return redirect()->back()->with('errors', $error);
        }
    }

    public function pendingEmergencyWithdrawalHistory(){

        $user = Auth::user();

        $withdraw = $this->refComission->getAllRefBalanceWithdrawalPagination(8, [
            ['user_unique_id', $user->unique_id],
            ['withdraw_type', 'emergency_withdrawal'],
            ['status', 'pending'],
        ]);

        $appSettings = $this->appSettings->getSettings();

        $view = [
            'withdraw'=>$withdraw,
            'appSettings'=>$appSettings,
        ];

        return view('backend.view_emergency_withdrawal', $view);
    }

    public function emergencyWithdrawalHistory(){

        $user = Auth::user();

        $withdraw = $this->refComission->getAllRefBalanceWithdrawalPagination(8, [
            ['user_unique_id', $user->unique_id],
            ['withdraw_type', 'emergency_withdrawal'],
            ['status', 'confirmed'],
        ]);

        $appSettings = $this->appSettings->getSettings();

        $view = [
            'withdraw'=>$withdraw,
            'appSettings'=>$appSettings,
        ];

        return view('backend.emergency_withdrawal_history', $view);
    }

    public function comfrimUpgradedInvestmentByAdmin(){

        $user = Auth::user();

        $withdraw = $this->refComission->getAllRefBalanceWithdrawalPagination(8, [
            ['status', 'pending'],
            ['remove_status', 'no'],
            ['withdraw_type', 'emergency_withdrawal'],
        ]);

        $view = [
            'withdraw'=>$withdraw
        ];

        return view('backend.confirm_upgraded_investment', $view);
    }

    public function upgradePayoutProcessor($unique_id = null){
        if($unique_id != null){

            $withdraw = $this->refComission->getSingleRefBalanceWithdrawal([
                ['unique_id', $unique_id]
            ]);
    
            $view = [
                'withdraw'=>$withdraw,
            ];

            return view('backend.upgrade_payout_processor', $view);
        }else{
            Alert::error('Error', 'An error occured, try again later');
            return redirect()->back();
        }
        
    }

    public function comfrimUpgradedInvestmentHistory(){

        $user = Auth::user();

        $withdraw = $this->refComission->getAllRefBalanceWithdrawalPagination(8, [
            ['status', 'confirmed'],
            ['remove_status', 'yes'],
            ['withdraw_type', 'emergency_withdrawal'],
        ]);

        $view = [
            'withdraw'=>$withdraw
        ];

        return view('backend.comission_payment_history', $view);
    }

    public function deleteEmergencyWithdrawal(Request $request){
        try{
            $deleteStatus = 0;

            $dataArray = explode('|', $request->deleteWithdrawId);
            
            foreach ($dataArray as $each_unique_id) {
                //delete transaction
                $transaction = $this->refComission->getSpecificRefBalanceWithdrawal($each_unique_id);

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

}
