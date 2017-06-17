<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pins', function (Blueprint $table) {
              $table->increments('id');
              $table->bigInteger('serial_no');
              $table->string('country');
              $table->string('operator');
              $table->integer('amount');
              $table->bigInteger('pin');
              $table->dateTime('expiry_date');
              $table->integer('status');
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
        Schema::dropIfExists('pins');
    }
}
