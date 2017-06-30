<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRerefenceColumnUserBalanceApprovalAudit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userBalanceApprovalAudit', function (Blueprint $table) {
            $table->dropColumn('pendingBalance');
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
        Schema::table('userBalanceApprovalAudit', function (Blueprint $table) {
            $table->dropColumn('api_reference');
            $table->dropColumn('reference');
        });
    }
}
