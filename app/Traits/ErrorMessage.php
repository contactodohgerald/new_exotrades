<?php

namespace App\Traits;

trait ErrorMessage {

    //method that return the messages
    function returnErrorMessage($keyword){
        $messageArray = [
            'wrong_login_crendential'=>'Wrong login credentials, Please check you email and password',
            'account_blocked'=>'Your account is blocked, please contact support via live chat for further details',
            'invalid_token'=>'Invalid Token Supplied',
            'expired_token'=>'Token has expired',
            'user_not_found'=>'User was not found',
            'failed_data_returned'=>'Data failed to return',
            'no_data_returned'=>'No Data was returned',
            'no_user_found'=>'This email is not registerd with us, plases proceed to register an account',
            'no_user'=>'This user is not registerd with us, please select a valid user',
            'unknown_error'=>'An error occurred, please try again',
            'token_reqiured'=>'Token must be provided ',
            'login_reqiured'=>'Email and Password must be provided ',
            'incorrect_refferral_id'=>'the refferral Id you inputed is incorrect, please confirm it and try again',
            'system_wallet_delete'=>'this wallet cant be deleted, users wallet has been linked to it',
            'plan_delete'=>'this plan cant be deleted, invesments has been made with it by users',
            'deposit_not_confirmed'=>'this transaction is yet to be confirmed, endeavor to do so before adding the interest',
            'insufficiant_fund'=>'Insufficiant Fund',
            'min_withdrawal_limit'=>'Amount exceeds the minimium withdrawal limit',
            'withdrawal_limit'=>'Amount exceeds the maximium withdrawal limit',
            'no_balance'=>'The is no avalable balance in this wallet, please invest to have a withdrawalable fund',
            'wallet_set_up'=>'no wallet address is set up',
            'not_equal_password'=>'The provided password does not match your current password.',
        ];
        return $messageArray[$keyword];
    }

}