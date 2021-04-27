<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('coin',10);
            $table->string('address',100);
            $table->double('balance', 15, 8)->default(0);
            $table->double('deposit', 15, 8)->default(0);
            $table->double('freezed', 15, 8)->default(0);
            $table->double('profit', 15, 8)->default(0);
            $table->double('referral', 15, 8)->default(0);
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
        Schema::dropIfExists('wallet');
    }
}
