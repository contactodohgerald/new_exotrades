<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CodeConfirmation\ConfirmationCode;
use App\Models\Settings\SiteSetting;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use App\Traits\Generics; 
use App\Traits\SuccessMessages;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    use Generics, SuccessMessages;

    public function __construct(User $user, SiteSetting $appSettings, ConfirmationCode $ConfirmationCode){
        $this->user = $user;
        $this->appSettings = $appSettings;
        $this->ConfirmationCode = $ConfirmationCode;
        
    }
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request){

        $data = $request->all();
     
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
      
        if($data['referral_code'] != ''){
            $users = $this->user->getSingleUserRefferalCode([
                ['referral_id', $data['referral_code']]
            ]);

            if($users == null){
                return redirect()->back()->with('info', 'the refferral code you inputrd is incorrect, please confirm it and try it again')->withInput($request->only('email'));
            }
        }
        
        $user = User::create([
            'unique_id' =>  $this->createUniqueId('users', 'unique_id'),
            'name' => $data['name'],
            'email' => $data['email'],
            'referral_id' =>  $this->createUniqueId('users', 'referral_id'),
            'referred_id_1' => $data['referral_code'] ? $data['referral_code'] : null,
            'referred_id_2' => $this->getRefferal($data['referral_code']),
            'account_number' => $this->createConfirmationNumbers('users', 'account_number', 6),
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($user));

        $appSettings = $this->appSettings->getSettings();

        if($appSettings->account_verification_access != 'no'){
            //send the user an email for activation of account and redirect the user to the page where they will enter code
            $createConfirmationCode = $this->ConfirmationCode->createActivationCode($user, $type = "account-activation");

            if($createConfirmationCode['status'] === true){
                //send the activation code via email to the user
                $this->ConfirmationCode->sendActivationMail($createConfirmationCode['data'], $user);

                //log the user out
                Auth::logout();
                
                //redirect the user the account activation page
                return redirect()->route('account_activation', [$user->unique_id])->with('success', $this->returnSuccessMessage('successful_registration'))->with('email', $user->email);
            }else{
                throw new \Exception($createConfirmationCode['error']);
            }
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function getRefferal($ref_id){
        $value = null;
        $users = $this->user->getSingleUserWithCondition([
            ['referral_id', $ref_id]
        ]);

        if($users != null){
            $fist_downline = $this->user->getSingleUserWithCondition([
                ['referred_id_1', $users->referred_id_1]
            ]);

            $value = $fist_downline->referred_id_1;

        }

        return $value;

    }
}
