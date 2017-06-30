<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRerefenceColumnPinTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pinTransactions', function (Blueprint $table) {
            $table->string('api_reference')->after('userId');
            $table->integer('reference')->after('userId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pinTransactions', function (Blueprint $table) {
            $table->dropColumn('api_reference')->after('user_id');
            $table->dropColumn('reference')->after('user_id');
        });
    }
}
