<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction\Transaction;
use App\Models\Earnings\Earning;
use App\Models\Withdrawal\BalanceWithdrawal;
use App\Models\RefWithdrawal\RefBalanceWithdraw;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //
    public function __construct(
        User $user, 
        Transaction $invest, 
        BalanceWithdrawal $withdraw, 
        RefBalanceWithdraw $refComission,
        Earning $earning
        ){
        $this->user = $user;
        $this->invest = $invest;
        $this->withdraw = $withdraw;
        $this->refComission = $refComission;
        $this->earning = $earning;
    }

    public function dashboardPage(){

        $user = Auth::user();

        $user_count = $this->user->getUsersWithCondition([
            ['account_type', 'user']
        ]);

        $view = [
            'user'=>$user,
            'invest'=> $this->invest->getLastestTransaction([
                ['user_unique_id', $user->unique_id],
            ]),
            'user_total_invest'=> $this->invest->countAllInvest([
                ['user_unique_id', $user->unique_id],
            ]),
            'earnings'=> $this->earning->getLastestEarning([
                ['user_unique_id', $user->unique_id],
            ]),
            'user_total_earnings'=> $this->earning->countAllEarning([
                ['user_unique_id', $user->unique_id],
            ]),
            'withdraw'=> $this->withdraw->getLastestBalanceWithdrawal([
                ['user_unique_id', $user->unique_id],
            ]),
            'user_total_withdraw'=> $this->withdraw->countAllWithdraw([
                ['user_unique_id', $user->unique_id],
            ]),
            'user_count'=>$user_count,
            'all_invest_amount'=>$this->countInvest('confirmed'),
            'confirm_invest_amount'=>$this->countInvest('confirmed'),
            'pending_withdraw'=>$this->countWithdrawal('pending'),  
            'confirmed_withdraw'=>$this->countWithdrawal('confirmed'),
            'all_withdraw'=> $this->countWithdrawal('confirmed'),
            'interest_amount'=>$this->invest->countAllInterest([
                ['deleted_at', null]
            ]),
            'comfirm_interest_amount'=>$this->invest->countAllInterest([
                ['invest_status', 'confirmed']
            ]),
            'all_ref_comission'=> $this->countRefComission('pending'),
            'confrim_ref_comission'=> $this->countRefComission('confirmed'),
            'unresolve_ref_comission'=> $this->countRefComission('pending'),
        ];

        return view('backend.index', $view);
    }

    public function countWithdrawal($option = ''){

        return $this->withdraw->countAllWithdraw([
            ['deleted_at', null],
            ['status', $option],
        ]);
    }

    public function countInvest($option = ''){

        return $this->invest->countAllInvest([
            ['deleted_at', null],
            ['received_status', $option],
        ]);
    }

    public function countRefComission($option = ''){

        return $this->refComission->countAllRefComission([
            ['deleted_at', null],
            ['status', $option],
        ]);
    }
}

