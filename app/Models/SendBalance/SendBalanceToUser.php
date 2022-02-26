<?php

namespace App\Models\SendBalance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Settings\SiteSetting;
use App\Mail\FundTransferSent; 
use App\Mail\FundTransferRecieve; 

class SendBalanceToUser extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function send_user(){
        return $this->belongsTo('App\Models\User', 'user_unique_id');
    }

    public function recieve_user(){
        return $this->belongsTo('App\Models\User', 'recieve_user_unique_id');
    }

    public function getAllSendBalanceToUser($condition, $id = 'id', $desc = "asc"){
        return SendBalanceToUser::where($condition)->orderBy($id, $desc)->get();
    }

    public function getAllSendBalanceToUserPagination($num, $condition, $id = 'id', $desc = "asc"){
        return SendBalanceToUser::where($condition)->orderBy($id, $desc)->paginate($num);
    }

    public function getSingleSendBalanceToUser($condition){
        return SendBalanceToUser::where($condition)->first();
    }

    public function getSpecificSendBalanceToUser($unique_id){
        return SendBalanceToUser::find($unique_id);
    }

    //send withdrawal confirmation email to the user
    function sendFundTransferSentMail($userObject, $transactions, $reciever){
        $appSettings = new SiteSetting();
        $userObject['transactions'] = $transactions;
        $userObject['reciever'] = $reciever;
        $userObject['settings'] = $appSettings->getSettings();
        \Mail::to($userObject)->send(new FundTransferSent($userObject));
    }
    
    //send withdrawal confirmation email to the user
    function sendFundTransferRecieveMail($userObject, $transactions, $sender){
        $appSettings = new SiteSetting();
        $userObject['transactions'] = $transactions;
        $userObject['sender'] = $sender;
        $userObject['settings'] = $appSettings->getSettings();
        \Mail::to($userObject)->send(new FundTransferRecieve($userObject));
    }


}
