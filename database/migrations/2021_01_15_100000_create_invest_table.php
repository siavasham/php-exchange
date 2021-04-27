<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invest', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('plan_id');
            $table->string('coin',10);
            $table->double('amount', 15, 8) ;
            $table->enum('status', ['open', 'done'])->default('open');
            $table->double('profit', 15, 8)->default(0) ;
            $table->timestamps();
            $table->timestamp('done_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invest');
    }
}
