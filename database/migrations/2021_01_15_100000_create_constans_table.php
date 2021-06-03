@@ -1,33 +0,0 @@
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key',50);
            $table->string('value',255);
            $table->enum('category', ['home', 'user','admin','other'])->default('home');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('constans');
    }
}