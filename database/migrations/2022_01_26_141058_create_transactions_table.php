<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('user_unique_id');
            $table->string('plan_unique_id');
            $table->string('system_wallet_id');
            $table->decimal('amount', 13,2)->default(0);
            $table->decimal('amount_upgrade', 13,2)->default(0);
            $table->string('payment_proof')->default('default.png');
            $table->string('intrest_growth')->default(0);
            $table->string('invest_status')->default('pending');
            $table->string('received_status')->default('pending');
            $table->string('upgrade_status')->default('no');
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
        Schema::dropIfExists('transactions');
    }
}
