<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CodeConfirmation\ConfirmationCode;
use App\Models\Settings\SiteSetting;
use App\Models\User;
use App\Traits\SuccessMessages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AccountActivationController extends Controller
{
    //
    use SuccessMessages;

    function __construct(User $user, SiteSetting $appSettings, ConfirmationCode $confirmationCode)
    {
        $this->user = $user;
        $this->appSettings = $appSettings;
        $this->confirmationCode = $confirmationCode;
    }

    public function sendActivationCode($userId, $type){
        $userObject = User::where([
            ['unique_id', '=', $userId]
        ])->first();

        if($userObject === null){
            return Redirect::back()->with('error', 'User was not found');
        }

        //send the user an email for activation of account and redirect the user to the page where they will enter code
        $createConfirmationCode = $this->confirmationCode->createActivationCode($userObject, $type);

        //send the activation code via email to the user
        $this->confirmationCode->sendActivationMail($createConfirmationCode['data'], $userObject);

        return redirect()->route('account_activation', [$userObject->unique_id])->with('success', $this->returnSuccessMessage('successful_registration'));
    }
    
    public function accountActivationPage($userId){
        return view('auth.account_activation', ['user_id'=>$userId]);
    }

    public function verifyAndActivateAccount(Request $request, $typeOfCode, $userId){
        //get the user object
        $userObject = $this->user::where([
            ['unique_id', '=', $userId]
        ])->first();

        $appSettings = $this->appSettings->getSettings();
       
        if($userObject === null){
            return Redirect::back()->with('error', 'User was not found');
        }

        //verify the token
        $tokenVerification = $this->confirmationCode->verifyTokenValidity($request->token, $typeOfCode, $userObject);

        if($tokenVerification['status'] === false){
            return Redirect::back()->with('error', $tokenVerification['message']);
        }

        //activation was successful, activate the user account
        $userObject->email_verified_at = Carbon::now()->toDateTimeString();
        
        if($userObject->save()){

            if($appSettings->send_welcome_message_mail != 'no'){
                //send welcome message to newly registerd user
                $this->confirmationCode->sendWelcomeMail($userObject);
            }
        
            return redirect()->route('login')->with('success', 'Your account have been successfully verified, please login to continue');
        }

        return Redirect::back()->with('error', 'An error occurred, please try again');
    }
}
