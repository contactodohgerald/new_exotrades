<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        //
        Commands\TransactionInterestAdder::class,
        Commands\UpdateCoinPrices::class,
        Commands\CryptoPurchaseInterestAdder::class,
        Commands\EarningsAdder::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
         $schedule->command('automatic_interest:adder')->daily();
         $schedule->command('updates:coin_prices')->everySixHours();
         $schedule->command('crypto_purchase_interest:adder')->daily();
         $schedule->command('earning:adder')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
