<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('site_name')->nullable();
            $table->string('site_email')->nullable();
            $table->string('site_phone')->nullable();
            $table->string('site_address')->nullable();
            $table->string('site_domain')->nullable();
            $table->string('site_logo_url')->default('default.png');
            $table->string('capital_withdrawal_access')->default('yes');
            $table->string('automatic_payout_access')->default('yes');
            $table->string('ref_bonus')->default(5);
            $table->string('withdrawal_penalty')->default(15);
            $table->string('two_factor_access')->default('no');
            $table->string('account_verification_access')->default('no');
            $table->string('verification_token_length')->default(5);
            $table->string('send_login_alert_mail')->default('no');
            $table->string('send_welcome_message_mail')->default('no');
            $table->string('referral_system_access')->default('no');
            $table->string('send_basic_emails')->default('no');
            $table->string('max_amount_to_withdraw')->default(1000);
            $table->string('min_wallet_withdrawal')->default(500);
            $table->string('min_amount_to_transfer')->default(100);
            $table->string('max_amount_to_transfer')->default(10000);
            $table->string('automate_money_send')->default('yes');

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
        Schema::dropIfExists('site_settings');
    }
}
