<?php

namespace App\Models\CodeConfirmation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Generics;
use App\Traits\SuccessMessage;
use App\Traits\ErrorMessage;
use App\Models\Settings\SiteSetting;
use App\Mail\AccountActivation; 
use App\Mail\PasswordResetToken; 
use App\Mail\LoginAlert;
use App\Mail\WelcomeMailMessage;
use App\Mail\PasswordResetMail;
use Carbon\Carbon;

class ConfirmationCode extends Model
{
    use HasFactory, SoftDeletes, Generics, SuccessMessage, ErrorMessage;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';
    

    public function getAllConfirmationCode($condition, $id = 'id', $desc = "desc"){
        return ConfirmationCode::where($condition)->orderBy($id, $desc)->get();
    } 

    public function getSingleConfirmationCode($condition){
        return ConfirmationCode::where($condition)->first();
    }

    public function createActivationCode($userObject, $type = "account-activation") {
    
        //check if there is an existing code for current type of action
        $codeDetails  = $this->getSingleConfirmationCode([
            ["user_unique_id", "=", $userObject->unique_id],
            ["status", "=", "un-used"],
            ["type", "=", $type],
        ]);    
    
        //check if the query returned null
        if($codeDetails !== null){
            $codeDetails->status = 'failed';
            $codeDetails->save();
        }
    
        //intiatiate a new unique id
        $uniqueId = $this->createUniqueId('confirmation_codes', 'unique_id');
        //unique_id user_unique_id 	token 	type status
        
        $setting = new SiteSetting();
        $appSettings = $setting->getSettings();
    
        $token = $this->createConfirmationNumbers('confirmation_codes', 'token', $appSettings->verification_token_length);
    
        //call the function that creates the confirmation code
        $dataToSave = $this->returnObject([
            'unique_id' => $uniqueId,
            'user_unique_id' => $userObject->unique_id,
            'token' => $token,
            'type' => $type
        ]);
    
        $this->createConfirmationCode($dataToSave);
    
        return [ 
            'status'=> true, 
            'message'=> $this->returnSuccessMessage('successful_token_creation'),  
            'data'=> $token
        ];

    }

    //create new onfirmation code
    function createConfirmationCode($request){
        $confirmationCode = new ConfirmationCode();
        $confirmationCode->unique_id = $request->unique_id;
        $confirmationCode->user_unique_id = $request->user_unique_id;
        $confirmationCode->token = $request->token;
        $confirmationCode->type = $request->type;
        $confirmationCode->status = 'un-used';
        $confirmationCode->save();
        return $confirmationCode;
    }

    //send the email to the user involved
    function sendActivationMail($token, $userObject){
        $appSettings = new SiteSetting();
        $userObject['settings'] = $appSettings->getSettings();
        $userObject['code'] = $token;
        \Mail::to($userObject)->send(new AccountActivation($userObject));
    }

     //send the email to the user involved
     function sendPwdResetTokenMail($token, $userObject){
        $appSettings = new SiteSetting();
        $userObject['settings'] = $appSettings->getSettings();
        $userObject['code'] = $token;
        \Mail::to($userObject)->send(new PasswordResetToken($userObject));
    }

    //send the login admit mail to user
    function procastLoginMailToUser($userObject, $date_format){
        $appSettings = new SiteSetting();
        $userObject['date_format'] = $date_format;
        $userObject['settings'] = $appSettings->getSettings();
        \Mail::to($userObject)->send(new LoginAlert($userObject));
    }

    //send the email to the user involved
    function sendWelcomeMail($userObject){
        $appSettings = new SiteSetting();
        $userObject['settings'] = $appSettings->getSettings();
        \Mail::to($userObject)->send(new WelcomeMailMessage($userObject));
    }

    function  verifyTokenValidity($token, string $token_type, $userObject):array {
        try{

            //validate the token in the db
            $tokenDetails = $this->getSingleConfirmationCode([
                ["user_unique_id", $userObject->unique_id],
                ["token", $token],
                ["type", $token_type],
            ]);
          
            //send the error message to the view
            if($tokenDetails === null){
                return [
                    'status'=>false,
                    'message'=> $this->returnErrorMessage('invalid_token'),
                    'message_type'=> "invalid_token",
                ];
            }
           
            //add ten minutes to the time for the code that was created
            $currentTime = Carbon::now()->toDateTimeString();
            $expirationTime = Carbon::parse($tokenDetails->created_at)->addMinutes(50)->toDateTimeString();
            //compare the dates
            if ($currentTime > $expirationTime) {
                return [
                    'status'=> false,
                    'message'=> $this->returnErrorMessage('expired_token'), 
                    'message_type'=> "expired_token",
                ];
            }

            //mark token as used token
            $tokenDetails->status = "used";
            $tokenDetails->save();
            //return the true status to the front end
            return [ 
                'status'=> true,
                'message'=> $this->returnSuccessMessage('valid_token'), 
                'message_type'=> "valid_token",
            ];
        }catch(\Exception $e){
            return [
                'status'=> false,
                'message'=> $e->getMessage(),
                'message_type'=> "try_catch",
            ];
        }
    }

    //send the login admit mail to user
    function sendUserPasswordResetMail($userObject, $date_format){
        $appSettings = new SiteSetting();
        $userObject['date_format'] = $date_format;
        $userObject['settings'] = $appSettings->getSettings();
        \Mail::to($userObject)->send(new PasswordResetMail($userObject));
    }
    

}
