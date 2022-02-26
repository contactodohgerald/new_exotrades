<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinsToPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins_to_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('coin_name')->nullable();
            $table->string('coin_symbol')->nullable();
            $table->string('coin_logo')->nullable();
            $table->string('currrent_price')->nullable();
            $table->string('volume_change_24h')->nullable();
            $table->string('percent_change_24h')->nullable();
            $table->string('market_cap')->nullable();
            $table->string('last_updated')->nullable();

            $table->softDeletes();  //add this line
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coins_to_purchases');
    }
}
