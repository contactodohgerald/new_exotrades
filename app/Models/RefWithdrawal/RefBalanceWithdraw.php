<?php

namespace App\Models\RefWithdrawal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Settings\SiteSetting;
use App\Mail\ReferralComissionWithdrawal; 
use App\Mail\AdminReferralComissionWithdrawal; 
use App\Mail\ComfirmReferralComissionWithdrawal; 

use App\Mail\UnfinishedInvestmentWithdrawalNotifier;  
use App\Mail\AdminReinvestmentNotifier;   
use App\Mail\ComfirmUnfinishedInvestmentWithdrawal; 
use Illuminate\Support\Facades\Mail;

class RefBalanceWithdraw extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_unique_id');
    }

    public function user_wallet(){
        return $this->belongsTo('App\Models\WalletAddress\UserWalletAddress', 'user_wallet_unique_id');
    }

    public function getAllRefBalanceWithdrawal($condition, $id = 'id', $desc = "asc"){
        return RefBalanceWithdraw::where($condition)->orderBy($id, $desc)->get();
    }

    public function getAllRefBalanceWithdrawalPagination($num, $condition, $id = 'id', $desc = "asc"){
        return RefBalanceWithdraw::where($condition)->orderBy($id, $desc)->paginate($num);
    }

    public function getSingleRefBalanceWithdrawal($condition){
        return RefBalanceWithdraw::where($condition)->first();
    }

    public function getSpecificRefBalanceWithdrawal($unique_id){
        return RefBalanceWithdraw::find($unique_id);
    }

    function countAllRefComission($condition){
        $row = RefBalanceWithdraw::where($condition)->get();
        $cont = 0;$amt = 0;
        foreach($row as $key => $each_row){
            $amt  += $each_row->amount;
        }
        return $amt;       
    }

    //send the referral withdrawal email to  user
    function sendReferralWithdrawalMailToUser($userObject, $ref_comission){
        $appSettings = new SiteSetting();
        $userObject['ref_comission'] = $ref_comission;
        $userObject['settings'] = $appSettings->getSettings();
        \Mail::to($userObject['settings']->site_email)->send(new ReferralComissionWithdrawal($userObject));
    }

    //send the withdrawal email to  admin
    function sendWithdrawalMailToAdmin($userObject, $ref_comission){
        $appSettings = new SiteSetting();
        $userObject['ref_comission'] = $ref_comission;
        $userObject['settings'] = $appSettings->getSettings();
        \Mail::to($userObject['settings']->site_email)->send(new AdminReferralComissionWithdrawal($userObject));
    }

    //send the referral withdrawal email to  user
    function sendComfirmationMailForReferralWithdrawalMailToUser($userObject, $ref_comission){
        $appSettings = new SiteSetting();
        $userObject['ref_comission'] = $ref_comission;
        $userObject['settings'] = $appSettings->getSettings();
        \Mail::to($userObject['settings']->site_email)->send(new ComfirmReferralComissionWithdrawal($userObject));
    }

    //send the email to the user involved
    function sendUnfinishedInvestmentWithdrawalMailToUser($userObject, $transactions){
        $appSettings = new SiteSetting();
        $userObject['transactions'] = $transactions;
        $userObject['settings'] = $appSettings->getSettings();
        Mail::to($userObject)->send(new UnfinishedInvestmentWithdrawalNotifier($userObject));
    }

    //send the withdrawal email to  admin
    function sendReinvestmentMailToAdmin($userObject, $transactions){
        $appSettings = new SiteSetting();
        $userObject['transactions'] = $transactions;
        $userObject['settings'] = $appSettings->getSettings();
        Mail::to($userObject['settings']->site_email)->send(new AdminReinvestmentNotifier($userObject));
    }

    //send withdrawal confirmation email to the user
    function sendReinvestmentPaymentmailToUser($userObject, $transactions){
        $appSettings = new SiteSetting();
        $userObject['transactions'] = $transactions;
        $userObject['settings'] = $appSettings->getSettings();
        Mail::to($userObject)->send(new ComfirmUnfinishedInvestmentWithdrawal($userObject));
    }


}
