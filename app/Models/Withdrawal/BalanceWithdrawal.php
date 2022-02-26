<?php

namespace App\Models\Withdrawal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Settings\SiteSetting;
use App\Mail\WithdrawalNotification; 
use App\Mail\AdminWithdrawalNotification; 
use App\Mail\PaymentNotification; 
use App\Mail\DeclineWithdrawal; 
use App\Mail\UserWalletUpdateNotifier; 

class BalanceWithdrawal extends Model
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

    public function getAllBalanceWithdrawal($condition, $id = 'id', $desc = "asc"){
        return BalanceWithdrawal::where($condition)->orderBy($id, $desc)->get();
    }

    public function getAllBalanceWithdrawalPagination($num, $condition, $id = 'id', $desc = "asc"){
        return BalanceWithdrawal::where($condition)->orderBy($id, $desc)->paginate($num);
    }

    public function getSingleBalanceWithdrawal($condition){
        return BalanceWithdrawal::where($condition)->first();
    }

    public function getLastestBalanceWithdrawal($condition){
        return BalanceWithdrawal::where($condition)->latest()->first();
    }

    public function getSpecificBalanceWithdrawal($unique_id){
        return BalanceWithdrawal::find($unique_id);
    }

    function countAllWithdraw($condition){
        $row = BalanceWithdrawal::where($condition)->get();
        $cont = 0;$amt = 0;
        foreach($row as $key => $each_row){
            $amt  += $each_row->amount;
        }
        return $amt;       
    }

    //send the email to the user involved
    function sendWithdrawalNotification($userObject, $transactions, $user_wallet, $wallet_type){
        $appSettings = new SiteSetting(); 
        $userObject['wallet_type'] = $wallet_type;
        $userObject['user_wallet'] = $user_wallet;
        $userObject['transactions'] = $transactions;
        $userObject['settings'] = $appSettings->getSettings();
        \Mail::to($userObject)->send(new WithdrawalNotification($userObject));
    }

    //send the withdrawal email to  admin
    function sendWithdrawalMailToAdmin($userObject, $transactions, $user_wallet, $wallet_type){
        $appSettings = new SiteSetting();
        $userObject['wallet_type'] = $wallet_type;
        $userObject['user_wallet'] = $user_wallet;
        $userObject['transactions'] = $transactions;
        $userObject['settings'] = $appSettings->getSettings();
        \Mail::to($userObject['settings']->site_email)->send(new AdminWithdrawalNotification($userObject));
    }

    //send withdrawal confirmation email to the user
    function sendPaymentNotification($userObject, $transactions, $user_wallet){
        $appSettings = new SiteSetting(); 
        $userObject['user_wallet'] = $user_wallet;
        $userObject['transactions'] = $transactions;
        $userObject['settings'] = $appSettings->getSettings();
        \Mail::to($userObject)->send(new PaymentNotification($userObject));
    }
    
    //send withdrawal confirmation email to the user
    function sendWithdrawalDeclineNotification($userObject, $transactions){
        $appSettings = new SiteSetting(); 
        $userObject['transactions'] = $transactions;
        $userObject['settings'] = $appSettings->getSettings();
        \Mail::to($userObject)->send(new DeclineWithdrawal($userObject));
    }

    //send withdrawal confirmation email to the user
    function sendWalletUpdateMail($userObject, $message){
        $appSettings = new SiteSetting();
        $userObject['settings'] = $appSettings->getSettings();
        $userObject['message'] = $message;
        \Mail::to($userObject)->send(new UserWalletUpdateNotifier($userObject));
    }

}
