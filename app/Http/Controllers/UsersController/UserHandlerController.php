<?php

namespace App\Http\Controllers\UsersController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction\Transaction;
use App\Models\WalletAddress\UserWalletAddress;
use App\Models\WalletAddress\WalletAddress;
use App\Models\Withdrawal\BalanceWithdrawal;
use App\Models\RefWithdrawal\RefBalanceWithdraw;
use App\Models\Country\CountryList;
use App\Models\Settings\SiteSetting;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rules;
use App\Traits\Generics;
use Carbon\Carbon;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class UserHandlerController extends Controller
{
    use Generics;
    //
    public function __construct(
        CountryList $countryList, 
        User $user, 
        Transaction $invest, 
        BalanceWithdrawal $withdraw, 
        RefBalanceWithdraw $refComission,
        UserWalletAddress $userWallet,
        SiteSetting $appSettings,
        WalletAddress $systemWallet
        ){
        $this->countryList = $countryList;
        $this->user = $user;
        $this->invest = $invest;
        $this->withdraw = $withdraw;
        $this->refComission = $refComission;
        $this->userWallet = $userWallet;
        $this->appSettings = $appSettings;
        $this->systemWallet = $systemWallet;
    }

    public function profilePage(){

        $user = Auth::user();

        $userWallet = $this->userWallet->getAllUserWalletAddress([
            ['user_unique_id', $user->unique_id],
        ]);

        $view = [
            'user'=>$user,
            'userWallet'=>$userWallet,
        ];

        return view('backend.profile', $view);
    }

    public function editProfilePage(){

        $user = Auth::user();

        $country = $this->countryList->getAllCountryList();

        $view = [
            'user'=>$user,
            'country'=>$country,
        ];

        return view('backend.edit_profile', $view);
    }

    public function updateProfilePage(Request $request, $unique_id = null){
        try{
            $data = $request->all();

            $request->validate([
                'name' => 'required',
            ]);

            if($unique_id != null){
                $user = $this->user->getSingleUserWithCondition([
                    ['unique_id', $unique_id]
                ]);
            }else{
                $user = Auth::user();
            }

            if($user != null){

                $user->name = $data['name'] ? $data['name'] : $user->name;
                $user->country = $data['country'] ? $data['country'] : $user->country;
                $user->phone = $data['phone'] ? $data['phone'] : $user->phone;
                $user->gender = $data['gender'] ? $data['gender'] : $user->gender;
                $user->address = $data['address'] ? $data['address'] : $user->address;
                $user->save();

                Alert::success('Success', 'Basic Account Details was updated successfully');
                return redirect()->back(); 
            }else {

                Alert::error('Error', 'An error occured, try again later');
                return redirect()->back();
            }
        }catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
      
    }

    public function updateUserPassword(Request $request, $userId = null){
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
                Alert::error('Error', 'This user does not exist');
                return redirect()->back();
            }

            if(! Hash::check($data['current_password'], $user->password)){
                Alert::error('Error', 'The provided password does not match your current password');
                return redirect()->back();
            }

            $user->password = Hash::make($data['password']);
            $user->save();
            Alert::success('Success', 'You request was successfully updated');
            return redirect()->back();
          
        }catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
    }

    public function uploadUserProfileImage(Request $request, $unique_id = null) {
        try{
            $data = $request->all();

            if($unique_id != null){
                $user = $this->user->getSingleUserWithCondition([
                    ['unique_id', $unique_id]
                ]);
            }else{
                $user = Auth::user();
            }

            if($user != null){
                // addind the image to cloudinary
                if ($request->hasFile('thumbnail')) {
                    // Uploading an image file to cloudinary and resizing the image to a resolution specified by the dimension parameters with one line of code
                    $thumbnailUrl = Cloudinary::upload($request->file('thumbnail')->getRealPath(), [
                        'folder' => 'exotrades/user_image',
                        'transformation' => [
                            'width' => 300,
                            'height' => 300
                        ]
                    ])->getSecurePath();
                }
                $user->avatar = $thumbnailUrl;
                $user->save();
                Alert::success('Success', 'You request was successfully updated');
                return redirect()->back(); 
            }else {
                Alert::error('Error', 'An error occured, try again later');
                return redirect()->back();
            }
        }catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }

    }

    public function usersAccountInterface(){

        $users = $this->user->getUsersWithConditionPaginate(8, [
            ['account_type', 'user']
        ]);

        $view = [
            'users'=>$users,
        ];
        return view('backend.users_account', $view);
    }  
    
    function viewUserProfile($unique_id = null){

        if($unique_id != null){
            $user = $this->user->getSingleUserWithCondition([
                ['unique_id', $unique_id]
            ]);

            $userWallet = $this->userWallet->getAllUserWalletAddress([
                ['user_unique_id', $user->unique_id],
            ]);
    
            $view = [
                'user'=>$user,
                'userWallet'=>$userWallet,
            ];

            return view('backend.view_profile', $view);
        }
        
    }  
    
    function editUserAccountInterface($unique_id = null){

        if($unique_id != null){
            $user = $this->user->getUserSingleUser([
                ['unique_id', $unique_id]
            ]);
    
            $country = $this->countryList->getAllCountryList();

            $view = [
                'user'=>$user,
                'country'=>$country,
            ];

            return view('backend.edit_user_account', $view);
        }
        
    }

    public function blockUserAccount(Request $request){
        try{
            $deleteStatus = 0;

            $dataArray = explode('|', $request->userId);

            $appSettings = $this->appSettings->getSettings();
            
            foreach ($dataArray as $each_unique_id) {
                //block user
                $user = $this->user->getSpecificUser($each_unique_id);
                $user->status = 'inactive';

                if($user->save()){
                    $deleteStatus = 1;
                }

            }

            if($deleteStatus == 1){
                Alert::success('Success', 'Selected User(s) was blocked successfully');
                return redirect()->back(); 
            }

            Alert::error('Error', 'An error occured, try again later');
            return redirect()->back();
            
        }catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
    }

    public function unblockUserAccount(Request $request){
        try{
            $deleteStatus = 0;

            $dataArray = explode('|', $request->unBlockUserId);

            $appSettings = $this->appSettings->getSettings();
            
            foreach ($dataArray as $each_unique_id) {
                //block user
                $user = $this->user->getSpecificUser($each_unique_id);
                $user->status = 'active';

                if($user->save()){
                    $deleteStatus = 1;
                }

            }

            if($deleteStatus == 1){
                Alert::success('Success', 'Selected User(s) was unblocked successfully');
                return redirect()->back(); 
            }

            Alert::error('Error', 'An error occured, try again later');
            return redirect()->back();

        }catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
    }

    public function activateUserAccount(Request $request){
        try{
            $deleteStatus = 0;

            $dataArray = explode('|', $request->activateUserId);

            $appSettings = $this->appSettings->getSettings();
            
            foreach ($dataArray as $each_unique_id) {
                //activate user
                $user = $this->user->getSpecificUser($each_unique_id);
                $user->email_verified_at = Carbon::now()->toDateTimeString();

                if($user->save()){
                    $deleteStatus = 1;
                }
            }
            if($deleteStatus == 1){
                Alert::success('Success', 'Your account have been successfully verified, please login to continue');
                return redirect()->back();
            }

            Alert::error('Error', 'An error occured, try again later');
            return redirect()->back();

        }catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
    }

    public function deleteUserAccount(Request $request){
        try{
            $deleteStatus = 0;

            $dataArray = explode('|', $request->deleteUserId);
           
            foreach ($dataArray as $each_unique_id) {
                //delete transaction
                $user = $this->user->getSpecificUser($each_unique_id);

                if($user !== null){
                    if($user->delete()){
                        $deleteStatus = 1;
                    }
                }
            }

            if($deleteStatus == 1){
                Alert::success('Success', 'Selected User(s) was deleted successfully');
                return redirect()->back();
            }

            Alert::error('Error', 'An error occured, try again later');
            return redirect()->back();

        }catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
    }

    public function topUpUserAccount(Request $request, $unique_id = null){
        try {

            if($unique_id != null){

                $request->validate([
                    'amount' => 'required',
                ]);

                $user = $this->user->getSingleUserWithCondition([
                    ['unique_id', $unique_id]
                ]);
    
                $new_amount = $user->main_balance + $request->amount;
                $user->main_balance = $new_amount;
                $user->save();
                Alert::success('Success', 'Amount was succesfully added');
                return redirect()->back();

            }else{
                Alert::error('Error', 'An error occured, try again later');
                return redirect()->back();
            }

        } catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
    }


}
