<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountRecoveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_recoveries', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('user_unique_id');
            $table->string('system_wallet_id')->nullable();
            $table->decimal('recovery_amount', 13,2)->default(0);
            $table->string('proof')->default('default.png');
            $table->string('status')->default('pending');
            $table->string('account_id')->nullable();
            $table->decimal('amount', 13,2)->default(35);
            $table->decimal('portifolio_value', 13,2)->default(0);
            $table->string('payment_proof')->default('default.png');
            $table->timestamp('first_date')->nullable();
            $table->timestamp('last_date')->nullable();
            $table->string('rollover')->nullable();
            $table->string('comp_days')->nullable();

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
        Schema::dropIfExists('account_recoveries');
    }
}
