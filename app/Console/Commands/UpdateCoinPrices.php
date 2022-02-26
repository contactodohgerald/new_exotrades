<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Coins\CoinsToPurchase;
use App\Traits\RequestHandler;
use Carbon\Carbon;
use App\Traits\Generics;

class UpdateCoinPrices extends Command
{
    use RequestHandler, Generics;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updates:coin_prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command updates the various current prices of different coins';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(User $user, CoinsToPurchase $coinsToPurchase)
    {
        parent::__construct();
        $this->user = $user;
        $this->coinsToPurchase = $coinsToPurchase;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->updateCoinPrices();
    }

    public function updateCoinPrices(){
        try {

            $coinsToPurchase = $this->coinsToPurchase->getAllCoinsToPurchase([
                ['deleted_at', null]
            ]);

            if(count($coinsToPurchase) > 0){

                $this->updateCoinDetails($coinsToPurchase);

            }else{
        
                $coin_list = $this->fectCoinsCurrentPrices();

                $this->addNewCoinDetails($coin_list['data']);
                
            }

        } catch (Exception $exception) {
            return $exception->getMessage();
        }       

    }

    public function addNewCoinDetails($coin_list){

        foreach ($coin_list as $each_coin) {
            $coinToPurchase = new CoinsToPurchase();
            $coinToPurchase->unique_id = $this->createUniqueId('coins_to_purchases', 'unique_id');
            $coinToPurchase->coin_name = $each_coin['name'];
            $coinToPurchase->coin_symbol = $each_coin['symbol'];
            $coinToPurchase->currrent_price = $each_coin['quote']['USD']['price'];
            $coinToPurchase->volume_change_24h = $each_coin['quote']['USD']['volume_change_24h'];
            $coinToPurchase->percent_change_24h = $each_coin['quote']['USD']['percent_change_24h'];
            $coinToPurchase->market_cap = $each_coin['quote']['USD']['market_cap'];
            $coinToPurchase->last_updated = $each_coin['quote']['USD']['last_updated'];
            $coinToPurchase->coin_logo = $this->fectCoinsCurrentLogo($each_coin['symbol'])['data'][$each_coin['symbol']][0]['logo'];
            $coinToPurchase->save();
        }
    }

    public function updateCoinDetails($coinsToPurchase){

        foreach($coinsToPurchase as $each_coin){
            $coin_details = $this->fectSingleCoinsCurrentPrices($each_coin->coin_symbol)['data'][$each_coin->coin_symbol]['quote']['USD'];
            $coin_logo = $this->fectCoinsCurrentLogo($each_coin->coin_symbol)['data'][$each_coin->coin_symbol][0]['logo'];
            $each_coin->currrent_price = $coin_details['price'];
            $each_coin->volume_change_24h = $coin_details['volume_change_24h'];
            $each_coin->percent_change_24h = $coin_details['percent_change_24h'];
            $each_coin->market_cap = $coin_details['market_cap'];
            $each_coin->last_updated = $coin_details['last_updated'];

            $each_coin->coin_logo = $coin_logo;
            $each_coin->save();
        }
    }
}
