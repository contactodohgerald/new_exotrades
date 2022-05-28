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

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class SiteWalletsController extends Controller
{
    //
    use Generics;
    public function __construct(User $user, SiteSetting $appSettings, WalletAddress $walletAddress, UserWalletAddress $userWalletAddress){
        $this->user = $user;
        $this->appSettings = $appSettings;
        $this->walletAddress = $walletAddress;
        $this->userWalletAddress = $userWalletAddress;
    }

    public function addSiteWalletInterface(){
        return view('backend.create_site_wallet');
    }

    public function createSystemWallet(Request $request) {
        try{
            $data = $request->all();

            $request->validate([
                'wallet_name' => 'required|between:2,100',
                'wallet_address' => 'required',
                'admin_only' => 'required',
            ]);
            
            $thumbnailUrl = 'default.jpg';
            // addind the image to cloudinary
            if ($request->hasFile('thumbnail')) {

                // Uploading an image file to cloudinary and resizing the image to a resolution specified by the dimension parameters with one line of code
                $thumbnailUrl = Cloudinary::upload($request->file('thumbnail')->getRealPath(), [
                    'folder' => 'exotrades/wallet_address_image',
                    'transformation' => [
                        'width' => 100,
                        'height' => 100
                    ]
                ])->getSecurePath();
            }

            $walletAddress = new WalletAddress();
            $walletAddress->unique_id = $this->createUniqueId('wallet_addresses', 'unique_id');
            $walletAddress->wallet_name = strtoupper($data['wallet_name']);
            $walletAddress->wallet_address = $data['wallet_address'];
            $walletAddress->admin_only = $data['admin_only'] ? $data['admin_only'] : 'no';
            $walletAddress->wallet_image = $thumbnailUrl;
            $walletAddress->current_value = $data['current_value'];

            if($walletAddress->save()){
                Alert::success('Success', 'You request was successfully created');
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

    public function returnListOfSystemWallet(){

        $walletAddress = $this->walletAddress->getAllWalletAddressPagination(10, [
            ['admin_only', 'no']
        ]);

        $view = [
            'walletAddress'=>$walletAddress,
        ];

        return view('backend.view_site_wallets', $view);

    }

    public function returnSingleSystemWallet($unique_id = null){

        if($unique_id != null){

            $walletAddress = $this->walletAddress->getSingleWalletAddress([
                ['unique_id', $unique_id]
            ]);

            $view = [
                'walletAddress'=>$walletAddress,
            ];
    
            return view('backend.edit_site_wallet', $view);

        }else{
            Alert::error('Error', 'An error occured, try again later');
            return redirect()->back();
        }
    }

    public function updateSystemWallet(Request $request, $unique_id = null) {
        try{

            if($unique_id != null){
                $data = $request->all();

                $request->validate([
                    'wallet_name' => 'required|between:2,100',
                    'wallet_address' => 'required',
                    'admin_only' => 'required',
                ]);

                $walletAddress = $this->walletAddress->getSingleWalletAddress([
                    ['unique_id', $unique_id]
                ]);
                
                // addind the image to cloudinary
                if ($request->hasFile('thumbnail')) {

                    // Uploading an image file to cloudinary and resizing the image to a resolution specified by the dimension parameters with one line of code
                    $thumbnailUrl = Cloudinary::upload($request->file('thumbnail')->getRealPath(), [
                        'folder' => 'exotrades/wallet_address_image',
                        'transformation' => [
                            'width' => 100,
                            'height' => 100
                        ]
                    ])->getSecurePath();

                    $walletAddress->wallet_image = $thumbnailUrl;
                }

                $walletAddress->wallet_name = strtoupper($data['wallet_name']) ? strtoupper($data['wallet_name']) : $walletAddress->wallet_name;
                $walletAddress->wallet_address = $data['wallet_address'] ? $data['wallet_address'] : $walletAddress->wallet_address ;
                $walletAddress->admin_only = $data['admin_only'] ? $data['admin_only'] : $walletAddress->admin_only;
                $walletAddress->current_value = $data['current_value'] ? $data['current_value'] : $walletAddress->current_value ;
                $walletAddress->save();

                Alert::success('Success', 'You request was successfully updated');
                return redirect()->to('view-site-wallet-page');
                      
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

    public function deleteSystemWallet(Request $request){
        try {    
            $deleteStatus = 0;

            $dataArray = explode('|', $request->deleteWalletId);

            foreach ($dataArray as $each_unique_id) {
                $walletAddress = $this->walletAddress->getSpecificWalletAddress($each_unique_id);

                $returnwalletAddress = $this->userWalletAddress->getSingleUserWalletAddress([
                    ['wallet_addresse_id', $walletAddress->unique_id]
                ]);

                if($returnwalletAddress != null){
                    $deleteStatus = 2;
                }else{
                    if($walletAddress->delete()){
                        $deleteStatus = 1;
                    }
                }
            }

            if($deleteStatus == 1){
                Alert::success('Success', 'Wallet was deleted successfully');
                return redirect()->back();
            }

            if($deleteStatus == 2){
                Alert::error('Error', 'This wallet cant be deleted, users wallet has been linked to it');
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
