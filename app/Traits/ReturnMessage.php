<?php

namespace App\Traits;
use App\Models\Settings\SiteSetting;

trait ReturnMessage {

    //method that return the messages template
    public function returnMessageTemplate($status = true, $message = '', $payload = [], $other = []) {
        $appSettings = SiteSetting::first();

        return response()->json([
            'status' => $status ? 'success' : 'error',
            'message' => $message,
            'payload' => $payload,
            'additional_data' => $other,
            'site_details' => $appSettings,
        ]);
    }    

    //method that return error messages
    public function returnErrorMessage($keyword) {
        $messageArray = [
            'wrong_login_crendential'=>'Wrong login credentials, Please check you email and password',
            'account_blocked'=>'Your account is blocked, please contact support via live chat for further details',
            'email_not_found'=>'This email is not registerd with us, plases proceed to register an account',
            'incorrect_refferral_id'=>'the refferral Id you inputed is incorrect, please confirm it and try again',
            'login_reqiured'=>'Email and Password must be provided ',
            'invalid_token'=>'Invalid Token Supplied',
            'token_reqiured'=>'Token must be provided ',
            'expired_token'=>'Token has expired',
            'user_not_found'=>'User was not found',
            'failed_data_returned'=>'Data failed to return',
            'no_data_returned'=>'No Data was returned',
            'no_user'=>'This user is not registerd with us, please select a valid user',
            'unknown_error'=>'An error occurred, please try again',
            'insufficiant_fund'=>'Insufficiant Fund',
            'not_equal_password'=>'The provided password does not match your current password.',            
        ];
        return $messageArray[$keyword];
    }

    public function returnSuccessMessage($keyword) {
        $messageArray = [
            'successful_token_creation'=>'Code was successfully created',
            'successful_creation'=>'You request was successfully created',
            'successful_updated'=>'You request was successfully updated',
            'successful_deleted'=>'You request was successfully deleted',
            'successful_declined'=>'You request was successfully declined',
            'successful_data_returned'=>'Data was successfully returned',
            'successful_logout'=>'You have successfully logged out and the token was successfully deleted',
            'successful_login'=>'Login was successful',
            'activation_token_sent'=>'Hi, an account activation mail have been sent to your email address. Please provide the code in the mail in the box below',
            'valid_token'=>'Valid Token',
            'account_verified'=>'Your account have been successfully verified, please login to continue',
            'account_registered'=>'Your account was created successfully, please login to continue',
            'user_deleted'=>'Selected User(s) was deleted successfully',
            'user_block'=>'Selected User(s) was blocked successfully',
            'user_unblock'=>'Selected User(s) was unblocked successfully',
            'transaction_confirmed'=>'Payment was confrimed successfully',
            'transaction_unconfirmed'=>'Payment was unconfrimed successfully',
            'fund_sent'=>'You fund transfer was successful',
            'mail_sent'=>'Mail was successfully sent',
            'password_reset'=>'You new password is set, navigate to the login page',           
        ];
        return $messageArray[$keyword];
    }
}