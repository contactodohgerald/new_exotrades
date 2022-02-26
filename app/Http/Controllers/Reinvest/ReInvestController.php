<?php

namespace App\Http\Controllers\Reinvest;

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

class ReInvestController extends Controller
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
    
    public function reinvestInvestInterface(){

        $user = Auth::user();

        $invest = $this->invest->getAllTransactionPagination(8, [
            ['user_unique_id', $user->unique_id]
        ]);

        $view = [
            'invest'=>$invest
        ];

        return view('backend.re_invest', $view);
    }

    public function planUpgradeInterface($unique_id = null){

        if($unique_id != null){

            $invest = $this->invest->getSingleTransaction([
                ['unique_id', $unique_id]
            ]);

            $systemWallet = $this->systemWallet->getAllWalletAddress([
                ['deleted_at', null],
            ]);
           
            $view = [
                'invest'=>$invest,
                'systemWallet'=>$systemWallet,
            ];
         
            return view('backend.plan_upgrade_handler', $view);
        }else{
            Alert::error('Error', 'An error occured, try again later');
            return redirect()->back();
        }

     
    } 

    public function getAllPendingInvestmentWithdrawal(){
        $user = Auth::user();

        $pendingInvests = $this->invest->getAllTransactionPagination(8, [
            ['user_unique_id', $user->unique_id],
            ['upgrade_status', 'yes'],
        ]);

        $view = [
            'pendingInvests'=>$pendingInvests
        ];
        return view('backend.pending_upgrade_investment', $view);
    }  
    
    public function getAllConfirmInvestmentWithdrawal(){
        $user = Auth::user();

        $invest = $this->invest->getAllTransactionPagination(8, [
            ['user_unique_id', $user->unique_id],
            ['received_status', 'confirmed'],
        ]);

        $view = [
            'invest'=>$invest
        ];

        return view('backend.investment_history', $view);
    }

    public function upgradePlanPament(Request $request, $unique_id = null){
        try{

            $user = Auth::user();
            $data = $request->all();

            $appSettings = $this->appSettings->getSettings();

            $request->validate([
                'amount' => 'required',
                'system_wallet_id' => 'required',
            ]);

            $transaction = $this->invest->getSingleTransaction([
                ['unique_id', $unique_id]
            ]);

            if($transaction != null){

                $new_amount = $transaction->amount + $data['amount'];

                $plan = $this->plan->getAllPlans([
                    ['deleted_at', null]
                ]);

                $plan_id = $this->returnsCurrentInvestmentPlan($new_amount, $plan);

                $transaction->user_unique_id = $user->unique_id;
                $transaction->plan_unique_id = $plan_id ? $plan_id : $transaction->plan_unique_id;
                $transaction->system_wallet_id = $data['system_wallet_id'];
                $transaction->amount = $new_amount;
                $transaction->amount_upgrade = $transaction->amount_upgrade + $data['amount'];
                $transaction->invest_status = 'pending';
                $transaction->received_status = 'pending';
                $transaction->upgrade_status = 'yes';

                $transaction->plans;

                if($appSettings->send_basic_emails != 'no'){
                   //send user deposit creation mail
                    $this->invest->sendPlanReinvestmentNotifier($user, $transaction, $transaction->system_wallet); 

                    //send reinvestment mail to admin
                    $this->invest->sendReinvestmentMailToAdmin($user, $transaction); 
                }

                $transaction->save();
                Alert::success('Success', 'You request was successfully created');
                return redirect()->route('payment-invoice', [$transaction->unique_id]);

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

    function returnsCurrentInvestmentPlan($amount, $plan){
        if(count($plan) > 0){
            foreach($plan as $each_plan){
                if($amount <= $each_plan->max_amount){
                    return $each_plan->unique_id;
                }
            }
        }
    }

    public function confirmUpgradedInvestmentInterface(){

        $transactions = $this->invest->getAllTransactionPagination(8, [
            ['invest_status', 'pending'],
            ['upgrade_status', 'yes'],
        ]);

        $view = [
            'transactions'=>$transactions
        ];

        return view('backend.confirm_upgraded_invest', $view);
    } 
    
    public function upgradedInvestmentInterface(){

        $invest = $this->invest->getAllTransactionPagination(8, [
            ['invest_status', 'confirmed'],
            ['upgrade_status', 'yes'],
        ]);

        $view = [
            'invest'=>$invest,
        ];

        return view('backend.admin_investment_history', $view);
    }

    public function deleteUserInvestment(Request $request, $unique_id = null){

        try {

            $withdrawId = $request->withdrawId;

            $invest = $this->investWithdrawalOrder->getSingleIInvestWithdrawalOrder([
                ['unique_id', $withdrawId]
            ]);

            if($invest != null){

                $invest->delete();

                return redirect()->back()->with('success', 'Investment was successfully deleted ');

            }else{
                # code...
                return redirect()->back()->with('errors', 'There was an error, please try again later');
            }

        } catch (Exception $exception) {
            $error = $exception->getMessage();
            return redirect()->back()->with('errors', $error);
        }

    }

}
