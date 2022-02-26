<?php

namespace App\Models\CryptoPurchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Mail\CryptoPurchaseMail;  
use App\Mail\AdminCryptoPurchase; 
use App\Mail\ComfirmationCryptoPurchaseNotifier;
use App\Mail\CryptoPurchaseDecline;
use App\Mail\CryptoSummaryMail;
use App\Mail\CryptoPurchasePayment;
use App\Traits\Generics; 
use Illuminate\Support\Facades\Mail;
use App\Models\Settings\SiteSetting;

class CryptoPurchase extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string'; 

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_unique_id');
    } 

    public function coin_details(){
        return $this->belongsTo('App\Models\Coins\CoinsToPurchase', 'coin_unique_id');
    }

    public function system_wallet(){
        return $this->belongsTo('App\Models\WalletAddress\WalletAddress', 'system_wallet_id');
    } 

    public function getAllCryptoPurchase($condition, $id = 'id', $desc = "desc"){
        return CryptoPurchase::where($condition)->orderBy($id, $desc)->get();
    }  
    
    public function getAllCryptoPurchasePaginate($condition, $num, $id = 'id', $desc = "desc"){
        return CryptoPurchase::where($condition)->orderBy($id, $desc)->paginate($num);
    }

    public function getSingleCryptoPurchase($condition){
        return CryptoPurchase::where($condition)->first();
    }

    public function getSpecificCryptoPurchase($unique_id){
        return CryptoPurchase::find($unique_id);
    }

    //send the email to the user involved
    function sendInvestmentDeposit($userObject, $investment){
        $appSettings = new SiteSetting();
        $userObject['settings'] = $appSettings->getSettings();
        $userObject['investment'] = $investment;
        \Mail::to($userObject)->send(new CryptoPurchaseMail($userObject));
    }

     //send the invesment email to  admin
     function sendInvestmentDepositToAdmin($userObject, $investment){
        $appSettings = new SiteSetting();
        $userObject['settings'] = $appSettings->getSettings();
        $userObject['investment'] = $investment;
        \Mail::to($userObject['settings']->site_email)->send(new AdminCryptoPurchase($userObject));
    }

     //send the email to the user involved
     function sendDepositConfirmationMail($userObject, $investment){
        $appSettings = new SiteSetting();
        $userObject['settings'] = $appSettings->getSettings();
        $userObject['investment'] = $investment;
        \Mail::to($userObject)->send(new ComfirmationCryptoPurchaseNotifier($userObject));
    }

    //send the email to the user involved
    function sendDepositDeclineMail($userObject, $investment){
        $appSettings = new SiteSetting();
        $userObject['settings'] = $appSettings->getSettings();
        $userObject['investment'] = $investment;
        \Mail::to($userObject)->send(new CryptoPurchaseDecline($userObject));
    }

     //send the investment summary mail to the users involved
     function sendPurchaseSummaryMailToUser($userObject, $investment, $date_format){
        $appSettings = new SiteSetting();
        $userObject['settings'] = $appSettings->getSettings();
        $userObject['investment'] = $investment;
        $userObject['date_format'] = $date_format;
        \Mail::to($userObject)->send(new CryptoSummaryMail($userObject));
    } 

    //send the investment summary mail to the users involved
    function sendCryptoPurchasePaymentMail($userObject, $investment, $date_format){
        $appSettings = new Setting();
        $userObject['settings'] = $appSettings->getSettings();
        $userObject['investment'] = $investment;
        $userObject['date_format'] = $date_format;
        \Mail::to($userObject)->send(new CryptoPurchasePayment($userObject));
    }
}
