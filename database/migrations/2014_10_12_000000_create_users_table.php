<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('account_type')->default('user');
            $table->string('status')->default('active');
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->text('address')->nullable();
            $table->string('avatar')->default('avatar.png');
            $table->string('account_number')->unique();
            $table->decimal('main_balance', 13,2)->default(0);
            $table->decimal('ref_bonus_balance', 13,2)->default(0);
            $table->string('referral_id')->nullable();
            $table->string('referred_id')->nullable();
            $table->string('first_time_login')->default('yes');
            $table->string('wallet_address_update')->default('no');
            $table->string('password');

            $table->softDeletes();  //add this line
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
