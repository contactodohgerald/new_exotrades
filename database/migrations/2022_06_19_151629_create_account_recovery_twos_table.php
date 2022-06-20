<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountRecoveryTwosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_recovery_twos', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('user_unique_id');
            $table->string('recovery_id');
            $table->string('system_wallet_id')->nullable();
            $table->decimal('service_charge', 13,2)->default(35);
            $table->string('payment_proof')->default('default.png');
            $table->decimal('trader_fee', 13,2)->default(0);
            $table->string('trader_status')->default('pending');
            $table->string('proof')->default('default.png');
            $table->string('status')->default('pending');
            $table->string('type')->default('second');

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
        Schema::dropIfExists('account_recovery_twos');
    }
}
