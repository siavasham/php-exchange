<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dex', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('coin',10);
            $table->double('amount', 15, 8);
            $table->float('price');
            $table->enum('type', ['buy','sell'])->default('buy');
            $table->enum('with', ['site','user'])->default('site');
            $table->enum('status', ['pending','progress','rejected', 'cancel', 'done'])->default('pending');
            $table->text('data');
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
        Schema::dropIfExists('dex');
    }
}
