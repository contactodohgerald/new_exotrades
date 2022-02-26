<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSiteEmail2ToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('site_settings', 'return_coins_limit')){
            Schema::table('site_settings', function (Blueprint $table) {
                //
                $table->string('return_coins_limit')->after('max_amount_to_transfer')->default(10);
                $table->string('purchase_coin_percent')->after('automate_money_send')->default(3);
                $table->string('purchase_coin_duration')->after('purchase_coin_percent')->default(7);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            //
        });
    }
}
