<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('wallet_name')->nullable();
            $table->string('wallet_address')->nullable();
            $table->string('admin_only')->default('no');
            $table->string('wallet_image')->nullable();
            $table->string('current_value')->nullable();

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
        Schema::dropIfExists('wallet_addresses');
    }
}
