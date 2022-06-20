<?php

namespace App\Models\Recovery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Mail\RecoveryPhaseTwoMail; 
use App\Models\Settings\SiteSetting; 

class AccountRecoveryTwo extends Model
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

    public function recovery(){
        return $this->belongsTo('App\Models\Recovery\AccountRecovery', 'recovery_id');
    } 

    public function getAllAccountRecoveryTwo($condition, $id = 'id', $desc = "asc"){
        return AccountRecoveryTwo::where($condition)->orderBy($id, $desc)->get();
    }

    public function getAllAccountRecoveryTwoPagination($num, $condition, $id = 'id', $desc = "asc"){
        return AccountRecoveryTwo::where($condition)->orderBy($id, $desc)->paginate($num);
    }

    public function getSingleAccountRecoveryTwo($condition){
        return AccountRecoveryTwo::where($condition)->first();
    }

    public function getSpecificAccountRecoveryTwo($unique_id){
        return AccountRecoveryTwo::find($unique_id);
    }

    //send the email to the user involved
    function sendRecoveryPhaseTwoMail($user, $payment){
        $appSettings = new SiteSetting();
        $user['settings'] = $appSettings->getSettings();
        $user['payment'] = $payment;
        \Mail::to($user)->send(new RecoveryPhaseTwoMail($user));
    }
}
