<?php

namespace App\Http\Controllers\PasswordReset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings\SiteSetting;
use App\Models\User;
use App\Models\CodeConfirmation\ConfirmationCode;
use App\Traits\Generics;
use App\Traits\SuccessMessage;
use App\Traits\ErrorMessage;
use App\Traits\ReturnTemplate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Carbon\Carbon;
use App\Actions\Fortify\UpdateUserPassword;

class ResetPasswordContoller extends Controller
{
    use Generics, SuccessMessage, ErrorMessage, ReturnTemplate;
    //
    function __construct(SiteSetting $appSettings, User $user, ConfirmationCode $confirmationCode){
        $this->appSettings = $appSettings;
        $this->user = $user;
        $this->confirmationCode = $confirmationCode;
    }

    public function verifyPasswordToken($userId = null){
        
        return view('auth.password_token_verify')->with('userId', $userId);

    }

    public function setNewPassword($userId = null){
        
        return view('auth.reset-password')->with('userId', $userId);

    }

    public function sendUserTokenToMail(Request $request) {
        try{
            $data = $request->all();

            $appSettings = $this->appSettings->getSettings();

            $request->validate([
                'email' => 'required',
            ]);

            $user = $this->user->getSingleUserWithCondition([
                ['email', $data['email']]
            ]);

            if($user != null){
                //send the user an email for activation of account and redirect the user to the page where they will enter code
                $createConfirmationCode = $this->confirmationCode->createActivationCode($user, $type = "password-reset");
                if($createConfirmationCode['status'] === true){

                    if($appSettings->send_basic_emails != 'no'){
                        //send the activation code via email to the user
                        $this->confirmationCode->sendPwdResetTokenMail($createConfirmationCode['data'], $user);
                    }
                    //return the account activation code and email
                    return redirect()->route('verify-password-token', [$user->unique_id])->with('success', 'Check your email, a token was sent to you');
                }
            }else {
                return redirect()->back()->with('error', 'This email is not registerd with us, plases proceed to register an account');
            }
        }catch (Exception $exception) {
            $error = $exception->getMessage();
            return redirect()->back()->with('error', $error);
        }

    }

    public function verifyUserSentToken(Request $request, $userId = null){
        try{
            $data = $request->all();

            $appSettings = $this->appSettings->getSettings();

            $request->validate([
                'token' => 'required',
            ]);

            //get the user object
            $user = $this->user->getSingleUserWithCondition([
                ['unique_id', $userId]
            ]);
            if($user == null){
                return redirect()->back()->with('error', 'This user does not exist');
            }

            //verify the token
            $tokenVerification = $this->confirmationCode->verifyTokenValidity($data['token'], 'password-reset', $user);
            if($tokenVerification['status'] === false){
                return redirect()->back()->with('error', $tokenVerification['message']);
            }

            //activation was successful, activate the user account
            return redirect()->route('set-new-password', [$user->unique_id])->with('success', 'Token was verification was successful');
        }catch (Exception $exception) {
            $error = $exception->getMessage();
            return redirect()->back()->with('error', $error);
        }
    
    }

    public function resetPassword(Request $request, $userId = null){
        try{
            $data = $request->all();

            $appSettings = $this->appSettings->getSettings();

            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            //get the user object
            $user = $this->user->getSingleUserWithCondition([
                ['unique_id', $userId]
            ]);
            if($user == null){
                return redirect()->back()->with('error', 'This user does not exist');
            }

            $user->password = Hash::make($data['password']);

            if($appSettings->send_basic_emails != 'no'){

                $currentDate = Carbon::now();
                $dateFormat = $currentDate->format('l jS \\of F Y h:i:s A'); 

                //send the activation code via email to the user
                $this->confirmationCode->sendUserPasswordResetMail($user, $dateFormat);
            }

            $user->save();
            //activation was successful, activate the user account
            return redirect()->route('login')->with('success', 'Password was successfully reset');

        }catch (Exception $exception) {
            $error = $exception->getMessage();
            return redirect()->back()->with('error', $error);
        }
    
    }

  
}
