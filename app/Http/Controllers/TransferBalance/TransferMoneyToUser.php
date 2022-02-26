<?php

namespace App\Http\Controllers\TransferBalance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings\SiteSetting;
use App\Models\User;
use App\Models\SendBalance\SendBalanceToUser;
use App\Models\Withdrawal\BalanceWithdrawal;
use App\Traits\Generics;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;



class TransferMoneyToUser extends Controller
{
    use Generics;
    //
    function __construct(SiteSetting $appSettings, SendBalanceToUser $transfer_fund, User $user, BalanceWithdrawal $withdrawal){
        $this->appSettings = $appSettings;
        $this->transfer_fund = $transfer_fund;
        $this->user = $user;
        $this->withdrawal = $withdrawal;
    }

    public function transferFundInterface(){

        $user = Auth::user();
        $appSettings = $this->appSettings->getSettings();

        $view = [
            'user'=>$user,
            'appSettings'=>$appSettings,
        ];

        return view('backend.transfer_fund_page', $view);
    }

    public function transferFundsToUser(Request $request) {
        try{

            $user = Auth::user();
            $data = $request->all();

            $appSettings = $this->appSettings->getSettings();

            $request->validate([
                'account_number' => 'required',
                'amount' => 'required',
            ]);

            $reciever_ = $this->user->getSingleUserWithCondition([
                ['account_number', $data['account_number']],
            ]);
            
            if($reciever_ == null){
                Alert::error('Error', 'Account number not recognized');
                return redirect()->back();
            }

            if($user->main_balance == 0){
                Alert::error('Error', 'Insufficient fund');
                return redirect()->back();
            }

            if($data['amount'] <= $appSettings->min_amount_to_transfer){
                Alert::error('Error', 'Amount is below minimuim transfer limit');
                return redirect()->back();
            }

            if($data['amount'] >= $appSettings->max_amount_to_transfer){
                Alert::error('Error', 'Amount exceeds the maximium transfer limit');
                return redirect()->back();
            }

            $user->main_balance = $user->main_balance - $data['amount'];
            $user->save(); 

            $reciever_->main_balance = $user->main_balance + $data['amount'];
            if($reciever_->save()){
                $transferFund = new SendBalanceToUser();
                $transferFund->unique_id = $this->createUniqueId('send_balance_to_users', 'unique_id');
                $transferFund->user_unique_id = $user->unique_id;
                $transferFund->recieve_user_unique_id = $reciever_->unique_id;
                $transferFund->amount = $data['amount'];
                $transferFund->naration = $data['naration'];
                $transferFund->save();
                if($appSettings->send_basic_emails != 'no'){
                    //send sender notification mail
                    $this->transfer_fund->sendFundTransferSentMail($user, $transferFund, $reciever_); 

                    //send receiver notification mail
                    $this->transfer_fund->sendFundTransferRecieveMail($reciever_, $transferFund, $user); 
                }
                Alert::success('Success', 'You fund transfer was successful');
                return redirect()->back(); 

            }else{
                Alert::error('Error', 'An error occured, try again later');
                return redirect()->back();
            }
        }catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }

    }

    public function getTransferHistoryForSender(){

        $user = Auth::user();

        $transferFund = $this->transfer_fund->getAllSendBalanceToUserPagination(8, [
            ['user_unique_id', $user->unique_id],
        ]);

        $view = [
            'transferFund'=>$transferFund,
        ];

        return view('backend.transfer_fund_history', $view);

    }

    public function getTransferHistoryForReciever(){

        $user = Auth::user();

        $transferFund = $this->transfer_fund->getAllSendBalanceToUserPagination(15, [
            ['recieve_user_unique_id', $user->unique_id],
        ]);

        $view = [
            'transferFund'=>$transferFund,
        ];

        return view('backend.recieve_fund_history', $view);

    }

    public function returnSingleTransferRecord($unique_id = null){

        if($unique_id != null){

            $transferFund = $this->transfer_fund->getSingleSendBalanceToUser([
                ['unique_id', $unique_id]
            ]);

            if($transferFund != null){
                $transferFund->send_user;
                $transferFund->recieve_user;
    
                Controller::$status = true;
                Controller::$success = [
                    'request_type' => 'successful_data_returned', 
                    'message' => $this->returnSuccessMessage('successful_data_returned')
                ];
                Controller::$payload = [
                    'data' => $transferFund
                ];
                return response()
                    ->json(ReturnTemplate::return_values());
            }
        }else{
            Controller::$status = false;
            Controller::$error = [
                'request_type' => 'failed_data_returned', 
                'message' => $this->returnSuccessMessage('failed_data_returned')
            ];
            return response()
                ->json(ReturnTemplate::return_values());
        }
    }

    public function deleteTransferRequest(Request $request){
        try{
            $deleteStatus = 0;

            $dataArray = explode('|', $request->deleteTransactionId);
    
            foreach ($dataArray as $each_unique_id) {
                //delete withdrawal
                $transferFund = $this->transfer_fund->getSpecificSendBalanceToUser($each_unique_id);

                if($transferFund !== null){
                    if($transferFund->delete()){
                        $deleteStatus = 1;
                    }
                }
            }

            if($deleteStatus == 1){
                Alert::success('Success', 'Transaction was successfully deleted');
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
