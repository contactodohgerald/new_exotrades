<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Accesscode\AdminAccessCode;
use App\Providers\RouteServiceProvider;

class AdminAccessCodeController extends Controller
{
    //
    function __construct(AdminAccessCode $accessCode){
        $this->accessCode = $accessCode;
    }


    public function grantAmdinAccess(Request $request){
        
        $request->validate([
            'access_code' => 'required',
        ]);

        $accessCode = $this->accessCode->getAccessCode();

        if($accessCode != null){

            $hashedPass = strtoupper($request->access_code);

            if($hashedPass === $accessCode->access_code){
                return redirect()->intended(RouteServiceProvider::HOME);
            }else{
                return redirect()->back()->with('error', 'your inputed accesscode is incorrect, please confirm it and try again')->withInput($request->only('access_code'));
            }

        }

    }
}
