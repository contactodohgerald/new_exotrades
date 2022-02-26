<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Settings\SiteSetting;
use App\Mail\SuccessfulInvestment; 
use App\Mail\AdminInvestmentNotifier; 
use App\Mail\TransactionConfirmation; 
use App\Mail\TransactionDecline; 
use App\Mail\SummaryMail; 
use App\Mail\ReinvestTransactionNotifier; 
use App\Mail\AdminReinvestmentNotifier; 
use App\Mail\UserPaymentNotifier; 
use App\Mail\AdminConfirmInvestmentNotifier; 

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_unique_id');
    } 

    public function plans(){
        return $this->belongsTo('App\Models\Plans\InvestmentPlan', 'plan_unique_id');
    } 

    public function system_wallet(){
        return $this->belongsTo('App\Models\WalletAddress\WalletAddress', 'system_wallet_id');
    } 

    public function getAllTransaction($condition, $id = 'id', $desc = "asc"){
        return Transaction::where($condition)->orderBy($id, $desc)->get();
    }

    public function getAllTransactionPagination($num, $condition, $id = 'id', $desc = "asc"){
        return Transaction::where($condition)->orderBy($id, $desc)->paginate($num);
    }

    public function getSingleTransaction($condition){
        return Transaction::where($condition)->first();
    }

    public function getLastestTransaction($condition){
        return Transaction::where($condition)->latest()->first();
    }

    public function getSpecificTransaction($unique_id){
        return Transaction::find($unique_id);
    }

    function countAllInvest($condition){
        $row = Transaction::where($condition)->get();
        $cont = 0;$amt = 0;
        foreach($row as $key => $each_row){
            $amt  += $each_row->amount;
        }
        return $amt;       
    }

    function countAllInterest($condition){
        $row = Transaction::where($condition)->get();
        $cont = 0;$amt = 0;
        foreach($row as $key => $each_row){
            $amt  += $each_row->intrest_growth;
        }
        return $amt;       
    }

    //send the email to the user involved
    function sendInvestmentDeposit($userObject, $investment, $address){
        $appSettings = new SiteSetting();
        $userObject['settings'] = $appSettings->getSettings();
        $userObject['investment'] = $investment;
        $userObject['address'] = $address;
        \Mail::to($userObject)->send(new SuccessfulInvestment($userObject));
    }

    //send the invesment email to  admin
    function sendInvestmentDepositToAdmin($userObject, $investment){
        $appSettings = new SiteSetting();
        $userObject['settings'] = $appSettings->getSettings();
        $userObject['investment'] = $investment;
        \Mail::to($userObject['settings']->site_email)->send(new AdminInvestmentNotifier($userObject));
    }

    //send the invesment email to  admin
    function sendInvestmentConfirmationToAdmin($userObject, $investment){
        $appSettings = new SiteSetting();
        $userObject['settings'] = $appSettings->getSettings();
        $userObject['investment'] = $investment;
        \Mail::to($userObject['settings']->site_email_2)->send(new AdminConfirmInvestmentNotifier($userObject));
    }

    //send the email to the user involved
    function sendDepositConfirmationMail($userObject, $investment){
        $appSettings = new SiteSetting();
        $userObject['settings'] = $appSettings->getSettings();
        $userObject['investment'] = $investment;
        \Mail::to($userObject)->send(new TransactionConfirmation($userObject));
    }

    //send the email to the user involved
    function sendDepositDeclineMail($userObject, $investment){
        $appSettings = new SiteSetting();
        $userObject['settings'] = $appSettings->getSettings();
        $userObject['investment'] = $investment;
        \Mail::to($userObject)->send(new TransactionDecline($userObject));
    }

    //send the investment summary mail to the users involved
    function sendInvestmentSummaryMailToUser($userObject, $investment, $date_format){
        $appSettings = new SiteSetting();
        $userObject['settings'] = $appSettings->getSettings();
        $userObject['investment'] = $investment;
        $userObject['date_format'] = $date_format;
        \Mail::to($userObject)->send(new SummaryMail($userObject));
    } 

    //send the email to the user involved
    function sendPlanReinvestmentNotifier($userObject, $investment, $address){
        $appSettings = new SiteSetting();
        $userObject['settings'] = $appSettings->getSettings();
        $userObject['investment'] = $investment;
        $userObject['address'] = $address;
        \Mail::to($userObject)->send(new ReinvestTransactionNotifier($userObject));
    }

    //send reinvesment email to  admin
    function sendReinvestmentMailToAdmin($userObject, $investment){
        $appSettings = new SiteSetting();
        $userObject['settings'] = $appSettings->getSettings();
        $userObject['investment'] = $investment;
        \Mail::to($userObject['settings']->site_email)->send(new AdminReinvestmentNotifier($userObject));
    }

    //send the investment summary mail to the users involved
    function sendUserPaymentMail($userObject, $investment, $date_format, $payment_type, $amount){
        $appSettings = new Setting();
        $userObject['settings'] = $appSettings->getSettings();
        $userObject['investment'] = $investment;
        $userObject['date_format'] = $date_format;
        $userObject['payment_type'] = $payment_type;
        $userObject['amount'] = $amount;
        \Mail::to($userObject)->send(new UserPaymentNotifier($userObject));
    }
    
}
