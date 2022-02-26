<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Settings\SiteSetting;
use App\Models\User;
use App\Models\CryptoPurchase\CryptoPurchase;
use Carbon\Carbon;

class CryptoPurchaseInterestAdder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crypto_purchase_interest:adder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that gets all the purchase crypto purchase request of various users and adds their respective interests';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(User $user, SiteSetting $appSettings, CryptoPurchase $cryptoPurchase)
    {
        parent::__construct();
        $this->user = $user;
        $this->appSettings = $appSettings;
        $this->cryptoPurchase = $cryptoPurchase;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->addNumberOfDaysToCryptoPurchase();
    }

    public function addNumberOfDaysToCryptoPurchase(){

         //get all the users that are eligible for interest addittion 
         $user = $this->user->getUsersWithCondition([
            ['account_type', 'user'],
            ['status', 'active'],
        ]);

        $appSettings = $this->appSettings->getSettings();

        if(count($user) > 0){
            foreach($user as $each_user){

                $cryptoPurchase = $this->cryptoPurchase->getAllCryptoPurchase([
                    ['user_unique_id', $each_user->unique_id],
                    ['status', 'processing'],
                ]);
                
                if(count($cryptoPurchase) > 0){
                    foreach($cryptoPurchase as $each_invest){
                        //get the current date and time
                        $currentDate = Carbon::now();
                        $dateFormat = $currentDate->format('l jS \\of F Y h:i:s A');
                        if($each_invest->day_counter != $appSettings->purchase_coin_duration){
                            //get the investment amount
                            $cal_amount = ($each_invest->amount_to_buy * $appSettings->purchase_coin_percent) / 100;
                            //add the daily interest to the amount
                            $each_invest->intrest_growth = $each_invest->intrest_growth + $cal_amount;
                            $each_invest->amount_to_pay = $each_invest->amount_to_pay + $cal_amount;
                            // add 1 to the day counter column
                            $each_invest->day_counter = $each_invest->day_counter + 1;
                            // add 1 to the number od days column
                            $each_invest->no_of_days = $each_invest->no_of_days + 1;
                            $each_invest->save();
                            if($appSettings->send_basic_emails != 'no'){ 
                                // send investment mail the user
                                $this->cryptoPurchase->sendPurchaseSummaryMailToUser($each_user, $each_invest, $dateFormat);
                            }
                        }else{
                            if($appSettings->automatic_payout_access == 'yes'){
                                $each_user->main_balance = $each_user->main_balance + $each_invest->amount_to_pay;
                                if($each_user->save()){
                                    if($appSettings->send_basic_emails != 'no'){ 
                                        // send investment mail the user
                                        $this->cryptoPurchase->sendCryptoPurchasePaymentMail($each_user, $each_invest, $dateFormat);
                                    }
                                    $each_invest->status = 'completed';
                                    $each_invest->received_status = 'confirmed';
                                    $each_invest->settled_status = 'yes';
                                    $each_invest->save();
                                }
                            }else{
                                $each_invest->status = 'completed';
                                $each_invest->received_status = 'confirmed';
                                $each_invest->save();
                            }
                        }
                    }
                }
            }
        }
    }
}
