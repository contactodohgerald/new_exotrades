<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Settings\SiteSetting;
use App\Models\User;
use App\Models\Transaction\Transaction;
use App\Models\Earnings\Earning;
use Carbon\Carbon;
use App\Traits\Generics;

class EarningsAdder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'earning:adder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that gets all the earnings of various users and adds their respective interests';

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
        $this->AddDayToEarning();
    }

    public function AddDayToEarning(){
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
                //trying getting earnings that belongs to a particular user 
                $earning = $this->earning->getAllEarning([
                    ['user_unique_id', $each_user->unique_id],
                    ['status', 'pending'],
                ]);
                if(count($earning) > 0){//a check to ensure the request returned a value
                    foreach($earning as $each_earning){//loop through the earning returned!
                        //a check if the transaction date is still less than the number of days for that plan
                        if($each_earning->day_counter == $appSettings->earning_duration){
                            if($each_earning->earning_type == 'capital_payout'){
                                $each_user->main_balance = $each_user->main_balance + $each_earning->amount;
                                $each_user->save();
            
                                $each_earning->status = 'confirmed';
                                $each_earning->options = 'payout';
                                $each_earning->save();
                            }else{
                                $each_earning->transactions->amount = $each_earning->transactions->amount + $each_earning->amount;
                                $each_earning->transactions->day_counter = 0;
                                $each_earning->transactions->no_of_days = 0;
                                $each_earning->transactions->invest_status = 'pending';
                                $each_earning->transactions->save();
            
                                $each_earning->status = 'confirmed';
                                $each_earning->options = 'reinvest';
                                $each_earning->save();
                            }
                        }else{
                            // add 1 to the number od days column 
                            $each_earning->day_counter = $each_earning->day_counter + 1;
                            $each_earning->save();
                        }
                    }
                }
            }
        }
    }
}
