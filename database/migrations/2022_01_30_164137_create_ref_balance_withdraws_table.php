<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefBalanceWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_balance_withdraws', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('user_unique_id');
            $table->string('user_wallet_unique_id');
            $table->decimal('amount', 13,2)->default(0);
            $table->string('status')->default('pending');
            $table->string('withdraw_type')->default('ref_balance_withdrawal');
            $table->string('remove_status')->default('no');

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
        Schema::dropIfExists('ref_balance_withdraws');
    }
}
