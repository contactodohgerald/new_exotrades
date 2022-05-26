<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Settings\SiteSetting;
use App\Models\User;
use App\Models\Transaction\Transaction;
use App\Models\Earnings\Earning;
use Carbon\Carbon;
use App\Traits\Generics;

class TransactionInterestAdder extends Command
{
    use Generics;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'automatic_interest:adder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that gets all the invest of various users and adds their respective interests';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(User $user, SiteSetting $appSettings, Transaction $transaction, Earning $earning)
    {
        parent::__construct();
        $this->user = $user;
        $this->appSettings = $appSettings;
        $this->transaction = $transaction;
        $this->earning = $earning;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(){
        $this->automaticallyAddInterestToTransaction();
    }

    public function automaticallyAddInterestToTransaction(){

        //get all the users that are eligible for interest addittion 
        $user = $this->user->getUsersWithCondition([
            ['account_type', 'user'],
            ['status', 'active'],
        ]);

        // get the site settings
        $appSettings = $this->appSettings->getSettings();
        if(count($user) > 0){//perform a check, to be sure the request actully returned users
            //loop through the various users
            foreach($user as $each_user){
                //trying getting transaction that belongs to a particular user 
                $transaction = $this->transaction->getAllTransaction([
                    ['user_unique_id', $each_user->unique_id],
                    ['received_status', 'confirmed'],
                ]);
                if(count($transaction) > 0){//a check to ensure the request returned a value
                    foreach($transaction as $each_transaction){//loop through the transaction returned!
                        //get the current date and time
                        $currentDate = Carbon::now();
                        $dateFormat = $currentDate->format('l jS \\of F Y h:i:s A');
                        //to a check if the transactio date is still less than the number of days for that plan
                        if($each_transaction->day_counter == $each_transaction->plans->intrest_duration){
                            $earning = new Earning();
                            $earning->unique_id = $this->createUniqueId('earnings', 'unique_id');
                            $earning->user_unique_id = $each_user->unique_id;
                            $earning->transaction_id = $each_transaction->unique_id;
                            $earning->amount = $each_transaction->intrest_growth;
                            $earning->earning_type = 'interest_payout';
                            $earning->save();

                            if($appSettings->automatic_payout_access != 'no'){ 
                                $payment_type = 'Interest Payout';
                                if($appSettings->send_basic_emails != 'no'){ 
                                    $this->transaction->sendUserPaymentMail($each_user, $each_transaction, $dateFormat, $payment_type, $interest);
                                }
                            }
                            //update interest growth to 0
                            $each_transaction->intrest_growth = 0;
                            // add 1 to the day counter column
                            $each_transaction->day_counter = 0;
                            // add 1 to the number od days column 
                            $each_transaction->no_of_days = $each_transaction->no_of_days + 1;
                            $each_transaction->save();
                        }elseif ($each_transaction->no_of_days == $each_transaction->plans->capital_duration) {
                            $new_amount = $each_transaction->amount + $each_transaction->intrest_growth;
                            $earning = new Earning();
                            $earning->unique_id = $this->createUniqueId('earnings', 'unique_id');
                            $earning->user_unique_id = $each_user->unique_id;
                            $earning->transaction_id = $each_transaction->unique_id;
                            $earning->amount = $new_amount;
                            $earning->earning_type = 'capital_payout';
                            $earning->save();

                            $payment_type = 'Capital Payout';
                            if($appSettings->send_basic_emails == 'yes'){ 
                                $this->transaction->sendUserPaymentMail($each_user, $each_transaction, $dateFormat, $payment_type, $capital);
                            }
                            
                            // add 1 to the day counter column
                            $each_transaction->day_counter = $each_transaction->no_of_days;
                            //update the investment status to confirmed
                            $each_transaction->intrest_growth  = 0;
                            $each_transaction->invest_status  = 'confirmed';
                            $each_transaction->save();
                        }else{
                            //get the investment amount
                            $cal_amount = ($each_transaction->amount * $each_transaction->plans->plan_percentage) / 100;
                            //add the daily interest to the amount
                            $each_transaction->intrest_growth = $each_transaction->intrest_growth + $cal_amount;
                            // add 1 to the day counter column
                            $each_transaction->day_counter = $each_transaction->day_counter + 1;
                            // add 1 to the number od days column 
                            $each_transaction->no_of_days = $each_transaction->no_of_days + 1;
                            //save new values to the database
                            $each_transaction->save();
                            if($appSettings->send_basic_emails != 'no'){ 
                                // send investment mail the user
                                $this->transaction->sendInvestmentSummaryMailToUser($each_user, $each_transaction, $dateFormat);
                            }
                        }
                    }
                }
            }
        }
    }

}
