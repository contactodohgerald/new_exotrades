<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Generics;
use App\Models\User;
use App\Models\Settings\SiteSetting;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Exception;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class SettingsController extends Controller
{
    //
    use Generics;
    public function __construct(User $user, SiteSetting $appSettings){
        $this->user = $user;
        $this->appSettings = $appSettings;
    }

    public function settingPageInterface(){

        $setting = $this->appSettings->getSettings();

        $view = [
            'setting'=>$setting,
        ];

        return view('backend.settings', $view);
    }

    public function updateSiteAccountSettings(Request $request, $unique_id = null){
        try{
            $data = $request->all();

            $request->validate([
                'site_name' => 'required|between:2,100',
                'site_email' => 'required|string|email',
                'site_domain' => 'required',
                'return_coins_limit' => 'required',
            ]);

            $appSettings = $this->appSettings->getSettings();

            $appSettings->site_name = $data['site_name'] ? $data['site_name'] : $appSettings->site_name;
            $appSettings->site_email = $data['site_email'] ? $data['site_email'] : $appSettings->site_email;
            $appSettings->site_phone = $data['site_phone'] ? $data['site_phone'] : $appSettings->site_phone;
            $appSettings->site_address = $data['site_address'] ? $data['site_address'] : $appSettings->site_address;
            $appSettings->site_domain = $data['site_domain'] ? $data['site_domain'] : $appSettings->site_domain;
            $appSettings->verification_token_length = $data['verification_token_length'] ? $data['verification_token_length'] : $appSettings->verification_token_length;
            $appSettings->withdrawal_penalty = $data['withdrawal_penalty'] ? $data['withdrawal_penalty'] : $appSettings->withdrawal_penalty;
            $appSettings->return_coins_limit = $data['return_coins_limit'] ? $data['return_coins_limit'] : $appSettings->return_coins_limit;
            $appSettings->min_wallet_withdrawal = $data['min_wallet_withdrawal'] ? $data['min_wallet_withdrawal'] : $appSettings->min_wallet_withdrawal;
            $appSettings->max_amount_to_withdraw = $data['max_amount_to_withdraw'] ? $data['max_amount_to_withdraw'] : $appSettings->max_amount_to_withdraw;
            $appSettings->min_amount_to_transfer = $data['min_amount_to_transfer'] ? $data['min_amount_to_transfer'] : $appSettings->min_amount_to_transfer;
            $appSettings->max_amount_to_transfer = $data['max_amount_to_transfer'] ? $data['max_amount_to_transfer'] : $appSettings->max_amount_to_transfer;
            $appSettings->ref_bonus = $data['ref_bonus'] ? $data['ref_bonus'] : $appSettings->ref_bonus;
            $appSettings->purchase_coin_percent = $data['purchase_coin_percent'] ? $data['purchase_coin_percent'] : $appSettings->purchase_coin_percent;
            $appSettings->purchase_coin_duration = $data['purchase_coin_duration'] ? $data['purchase_coin_duration'] : $appSettings->purchase_coin_duration;

            if($appSettings->save()){
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

    public function updateAdvanceSiteSettings(Request $request, $unique_id = null){
        try{
            $data = $request->all();

            $appSettings = $this->appSettings->getSettings();

            $appSettings->capital_withdrawal_access = $data['capital_withdrawal_access'] ? $data['capital_withdrawal_access'] : $appSettings->capital_withdrawal_access;
            $appSettings->automatic_payout_access = $data['automatic_payout_access'] ? $data['automatic_payout_access'] : $appSettings->automatic_payout_access;
            $appSettings->two_factor_access = $data['two_factor_access'] ? $data['two_factor_access'] : $appSettings->two_factor_access;
            $appSettings->account_verification_access = $data['account_verification_access'] ? $data['account_verification_access'] : $appSettings->account_verification_access;
            $appSettings->send_login_alert_mail = $data['send_login_alert_mail'] ? $data['send_login_alert_mail'] : $appSettings->send_login_alert_mail;
            $appSettings->send_welcome_message_mail = $data['send_welcome_message_mail'] ? $data['send_welcome_message_mail'] : $appSettings->send_welcome_message_mail;
            $appSettings->referral_system_access = $data['referral_system_access'] ? $data['referral_system_access'] : $appSettings->referral_system_access;
            $appSettings->send_basic_emails = $data['send_basic_emails'] ? $data['send_basic_emails'] : $appSettings->send_basic_emails;
            $appSettings->automate_money_send = $data['automate_money_send'] ? $data['automate_money_send'] : $appSettings->automate_money_send;

            if($appSettings->save()){
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

    public function updateSiteLogoSettings(Request $request, $unique_id = null){
        try{

            $appSettings = $this->appSettings->getSettings();

            if($appSettings != null){
                // addind the image to cloudinary
                if ($request->hasFile('thumbnail')) {
                    // Uploading an image file to cloudinary and resizing the image to a resolution specified by the dimension parameters with one line of code
                    $thumbnailUrl = Cloudinary::upload($request->file('thumbnail')->getRealPath(), [
                        'folder' => 'exotrades/site_logo',
                        'transformation' => [
                            'width' => 200,
                            'height' => 200
                        ]
                    ])->getSecurePath();
                }
                $appSettings->site_logo_url = $thumbnailUrl;
                $appSettings->save();

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
}
