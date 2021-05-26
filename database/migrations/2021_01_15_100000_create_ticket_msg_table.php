<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketMsgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_msg', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->integer('user_id');
            $table->integer('ticket_id');
            $table->text('text');
            $table->timestamp('added_on');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_msg');
    }
}
