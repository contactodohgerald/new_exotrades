<?php

namespace App\Http\Controllers\Earning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Transaction\Transaction;
use App\Models\Settings\SiteSetting;
use App\Models\Earnings\Earning;
use App\Traits\Generics;
use RealRashid\SweetAlert\Facades\Alert;

class EarningsController extends Controller
{
    //
    use Generics;
    public function __construct(SiteSetting $appSettings, Transaction $invest, User $user, Earning $earning){
        $this->appSettings = $appSettings;
        $this->invest = $invest;
        $this->user = $user;
        $this->earning = $earning;
    }

    public function earningsPageInterface(){

        $user = Auth::user();

        $appSettings = $this->appSettings->getSettings();
        
        $earnings = $this->earning->getAllEarningPagination(8, [
            ['user_unique_id', $user->unique_id],
            ['status', 'pending'],
        ]);

        $view = [
            'earnings'=>$earnings,
            'appSettings'=>$appSettings,
        ];
        return view('backend.view_earnings', $view);
    }

    public function earningsHistoryPage(){

        $user = Auth::user();
        
        $earnings = $this->earning->getAllEarningPagination(8, [
            ['user_unique_id', $user->unique_id],
            ['status', '!=', 'pending'],
        ]);

        $view = [
            'earnings'=>$earnings,
        ];
        return view('backend.earning_history', $view);
    }

    public function processPayout(Request $request){
        try{

            $data = $request->all();

            $appSettings = $this->appSettings->getSettings();

            $earning = $this->earning->getSingleEarning([
                ['unique_id', $data['transId']]
            ]);

            if($earning != null){

                $initial_amount = 0;
                if($earning->earning_type != 'interest_payout'){
                    $initial_amount = ($earning->amount * $appSettings->min_amount_to_transfer) / 100;
                }

                $new_amount = $earning->amount - $initial_amount;

                $earning->users->main_balance = $earning->users->main_balance + $new_amount;
                $earning->users->save();

                $earning->status = 'confirmed';
                $earning->options = 'payout';

                $earning->save();
                Alert::success('Success', 'You request was successful');
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

    public function processReinvest(Request $request){
        try{

            $data = $request->all();

            $appSettings = $this->appSettings->getSettings();

            $earning = $this->earning->getSingleEarning([
                ['unique_id', $data['reinvestId']]
            ]);

            if($earning != null){
                if($earning->earning_type != 'interest_payout'){
                    $earning->transactions->amount = $earning->transactions->amount + $earning->amount;
                    $earning->transactions->day_counter = 0;
                    $earning->transactions->no_of_days = 0;
                    $earning->transactions->invest_status = 'pending';
                    $earning->transactions->save();

                    $earning->status = 'confirmed';
                    $earning->options = 'reinvest';
                    $earning->save();

                    Alert::success('Success', 'You request was successful');
                    return redirect()->back();
                }else{
                    $earning->transactions->day_counter = 0;
                    $earning->transactions->no_of_days = 0;
                    $earning->transactions->intrest_growth = 0;
                    $earning->transactions->invest_status = 'pending';
                    $earning->transactions->save();

                    $earning->status = 'confirmed';
                    $earning->options = 'reinvest';
                    $earning->save();

                    Alert::success('Success', 'You request was successful');
                    return redirect()->back();
                }
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

    public function deleteUserReinvest(Request $request){
        try{
            $deleteStatus = 0;

            $dataArray = explode('|', $request->deleteTransId);
            
            foreach ($dataArray as $each_unique_id) {
                //delete transaction
                $earning = $this->earning->getSpecificEarning($each_unique_id);

                if($earning !== null){
                    if($earning->delete()){
                        $deleteStatus = 1;
                    }
                }
            }

            if($deleteStatus == 1){
                Alert::success('Success', 'Payment was deleted successfully');
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
