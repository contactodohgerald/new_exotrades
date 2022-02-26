<?php

namespace App\Traits;

trait SuccessMessage {
    //method that return the messages
    function returnSuccessMessage($keyword){
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
            'transaction_deleted'=>'Selected Transaction(s) was deleted successfully',
            'withdrawal_deleted'=>'Selected Withdrawal(s) was deleted successfully',
            'user_deleted'=>'Selected User(s) was deleted successfully',
            'user_block'=>'Selected User(s) was blocked successfully',
            'user_unblock'=>'Selected User(s) was unblocked successfully',
            'transaction_confirmed'=>'Payment was confrimed successfully',
            'transaction_unconfirmed'=>'Payment was unconfrimed successfully',
            'withdrawal_placed'=>'Your Withdrawal invoice was created successfully, please wait patiaintly for admin approval',
            'fund_sent'=>'You fund transfer was successful',
            'mail_sent'=>'Mail was successfully sent',
            'password_reset'=>'You new password is set, navigate to the login page',
        ];
        return $messageArray[$keyword];
    }
}