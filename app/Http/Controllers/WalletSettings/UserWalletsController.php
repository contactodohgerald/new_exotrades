<?php

namespace App\Http\Controllers\WalletSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Generics;
use App\Models\User;
use App\Models\Settings\SiteSetting;
use App\Models\WalletAddress\WalletAddress;
use App\Models\WalletAddress\UserWalletAddress;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class UserWalletsController extends Controller
{
    //
    use Generics;
    public function __construct(User $user, SiteSetting $appSettings, WalletAddress $systemWallet, UserWalletAddress $userWallet){
        $this->user = $user;
        $this->appSettings = $appSettings;
        $this->systemWallet = $systemWallet;
        $this->userWallet = $userWallet;
    }

    public function addUserWalletInterface(){

        $systemWallet = $this->systemWallet->getAllWalletAddress([
            ['admin_only', 'no'],
        ]);

        $view = [
            'systemWallet'=>$systemWallet,
        ];

        return view('backend.create_user_wallet', $view);

    }

    public function addNewUserWallets(Request $request){
        try{
            $user = Auth::user();
            $data = $request->all();

            $request->validate([
                'wallet_addresse_id' => 'required',
                'wallet_address' => 'required',
            ]);

            $returnwalletAddress = $this->userWallet->getSingleUserWalletAddress([
                ['user_unique_id', $user->unique_id],
                ['wallet_addresse_id', $data['wallet_addresse_id']]
            ]);

            if($returnwalletAddress != null){
                $returnwalletAddress->wallet_addresse_id = $data['wallet_addresse_id'];
                $returnwalletAddress->wallet_address = $data['wallet_address'];
                $returnwalletAddress->save();
                Alert::success('Success', 'Your wallet address was successfully updated');
                return redirect()->back();
            }else{
                $walletAddress = new UserWalletAddress();
                $walletAddress->unique_id = $this->createUniqueId('user_wallet_addresses', 'unique_id');
                $walletAddress->user_unique_id = $user->unique_id;
                $walletAddress->wallet_addresse_id = $data['wallet_addresse_id'];
                $walletAddress->wallet_address = $data['wallet_address'];

                if($walletAddress->save()){
                    
                    $user->wallet_address_update = 'yes';
                    $user->save();

                    Alert::success('Success', 'You request was successfully created');
                    return redirect()->back();

                }else {
                    Alert::error('Error', 'An error occured, try again later');
                    return redirect()->back();
                }
            }
        }catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
    }

    public function returnListOfUserWallet(){
        $user = Auth::user();

        $userWallet = $this->userWallet->getAllUserWalletAddress([
            ['user_unique_id', $user->unique_id],
        ]);

        $view = [
            'userWallet'=>$userWallet,
        ];

        return view('backend.view_user_wallets', $view);

    }

    public function returnSingleUserWallet($unique_id = null){

        if($unique_id != null){

            $walletAddress = $this->userWallet->getSingleUserWalletAddress([
                ['unique_id', $unique_id]
            ]);

            $systemWallet = $this->systemWallet->getAllWalletAddress([
                ['admin_only', 'no'],
            ]);

            $view = [
                'walletAddress'=>$walletAddress,
                'systemWallet'=>$systemWallet,
            ];
    
            return view('backend.edit_user_wallet', $view);

        }else{
            Alert::error('Error', 'An error occured, try again later');
            return redirect()->back();
        }
    }

    public function updateUserWallet(Request $request, $unique_id = null) {
        try{

            if($unique_id != null){
                $data = $request->all();

                $request->validate([
                    'wallet_addresse_id' => 'required',
                    'wallet_address' => 'required',
                ]);

                $walletAddress = $this->userWallet->getSingleUserWalletAddress([
                    ['unique_id', $unique_id]
                ]);

                $walletAddress->wallet_addresse_id = $data['wallet_addresse_id'] ? $data['wallet_addresse_id'] : $walletAddress->wallet_addresse_id ;
                $walletAddress->wallet_address = $data['wallet_address'] ? $data['wallet_address'] : $walletAddress->wallet_address;
                $walletAddress->save();

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

    public function deleteUserWallet(Request $request){
        try {    
            $deleteStatus = 0;

            $dataArray = explode('|', $request->deleteWalletId);

            foreach ($dataArray as $each_unique_id) {
                $walletAddress = $this->userWallet->getSpecificUserWalletAddress($each_unique_id);

                if($walletAddress != null){
                    if($walletAddress->delete()){
                        $deleteStatus = 1;
                    }
                }
            }

            if($deleteStatus == 1){
                Alert::success('Success', 'Wallet was deleted successfully');
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

}
