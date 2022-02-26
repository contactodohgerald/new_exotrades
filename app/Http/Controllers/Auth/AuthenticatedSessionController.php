<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CodeConfirmation\ConfirmationCode;
use App\Models\Settings\SiteSetting;
use App\Models\User;
use Carbon\Carbon;
use App\Traits\SuccessMessages;

class AuthenticatedSessionController extends Controller{

    use SuccessMessages;

    function __construct(User $user, SiteSetting $appSettings, ConfirmationCode $confirmationCode)
    {
        $this->user = $user;
        $this->appSettings = $appSettings;
        $this->confirmationCode = $confirmationCode;
    }

    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        $appSettings = $this->appSettings->getSettings();

        if($appSettings->account_verification_access != 'no'){
            if($user->email_verified_at === null){//check for unactivated account
                //send the user an email for activation of account and redirect the user to the page where they will enter code
                $createConfirmationCode = $this->confirmationCode->createActivationCode($user, $type = "account-activation");
    
                if($createConfirmationCode['status'] === true){
                    //send the activation code via email to the user
                    $this->confirmationCode->sendActivationMail($createConfirmationCode['data'], $user);
    
                    Auth::logout();
    
                    //redirect the user the account activation page
                    return redirect()->route('account_activation', [$user->unique_id])->with('success', $this->returnSuccessMessage('successful_registration'))->with('email', $user->email);
                }
    
            }
        }

        if($user->status === 'inactive'){
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is blocked, please contact support via live chat for further details');
        }

        if($user->account_type == 'admin' || $user->account_type == 'super_admin' ){

            return redirect()->to('access-code');
        }

        if($appSettings->send_login_alert_mail != 'no'){

            $currentDate = Carbon::now();
            $dateFormat = $currentDate->format('l jS \\of F Y h:i:s A'); 

            //send login notifier to users
            $this->confirmationCode->procastLoginMailToUser($user, $dateFormat);
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
