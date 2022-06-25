<?php

namespace App\Models\Recovery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Mail\RecoveryConfirmMail; 
use App\Mail\RecoveryMailAdmin; 
use App\Mail\SendRecoveryMail; 
use App\Models\Settings\SiteSetting; 

class AccountRecovery extends Model
{ 
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_unique_id');
    }

    public function system_wallet(){
        return $this->belongsTo('App\Models\WalletAddress\WalletAddress', 'system_wallet_id');
    } 

    public function getAllAccountRecovery($condition, $id = 'id', $desc = "asc"){
        return AccountRecovery::where($condition)->orderBy($id, $desc)->get();
    }

    public function getAllAccountRecoveryPagination($num, $condition, $id = 'id', $desc = "asc"){
        return AccountRecovery::where($condition)->orderBy($id, $desc)->paginate($num);
    }

    public function getSingleAccountRecovery($condition){
        return AccountRecovery::where($condition)->first();
    }

    public function getSpecificAccountRecoveryal($unique_id){
        return AccountRecovery::find($unique_id);
    }

    //send the invesment email to  admin
    function sendAdminMail($user, $payment, $message){
        $appSettings = new SiteSetting();
        $user['settings'] = $appSettings->getSettings();
        $user['payment'] = $payment;
        $user['message'] = $message;
        \Mail::to($user['settings']->site_email)->send(new RecoveryMailAdmin($user));
    }

    //send the invesment email to  admin
    function sendAdminMail2($user, $payment, $message){
        $appSettings = new SiteSetting();
        $user['settings'] = $appSettings->getSettings();
        $user['payment'] = $payment;
        $user['message'] = $message;
        \Mail::to($user['settings']->site_email_2)->send(new RecoveryMailAdmin($user));
    }

    //send the email to the user involved
    function sendRecoveryConfirmMail($user, $payment){
        $appSettings = new SiteSetting();
        $user['settings'] = $appSettings->getSettings();
        $user['payment'] = $payment;
        \Mail::to($user)->send(new RecoveryConfirmMail($user));
    }
    
    //send the email to the user involved
    function sendRecoveryMail($user, $link){
        $appSettings = new SiteSetting();
        $user['settings'] = $appSettings->getSettings();
        $user['link'] = $link;
        \Mail::to($user)->send(new SendRecoveryMail($user));
    }
}
