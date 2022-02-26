<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptoPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('user_unique_id');
            $table->string('system_wallet_id');
            $table->string('coin_unique_id');
            $table->decimal('amount_to_buy', 13,2)->default(0);
            $table->decimal('amount_to_pay', 13,2)->default(0);
            $table->string('payment_proof')->default('default.png');
            $table->string('intrest_growth')->default(0);
            $table->string('status')->default('pending');
            $table->string('received_status')->default('pending');
            $table->string('settled_status')->default('no');
            $table->string('day_counter')->default(0);
            $table->string('no_of_days')->default(0);

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
        Schema::dropIfExists('crypto_purchases');
    }
}
