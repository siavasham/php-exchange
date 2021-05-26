<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('coin',10);
            $table->string('address',100);
            $table->string('tag',30)->nullable();
            $table->double('amount', 15, 8) ;
            $table->enum('type', ['deposit','withdraw','interuser'])->default('deposit');
            $table->enum('status', ['pending','progress','rejected', 'done'])->default('pending');
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
        Schema::dropIfExists('transaction');
    }
}
