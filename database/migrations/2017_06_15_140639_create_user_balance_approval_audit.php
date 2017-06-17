<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBalanceApprovalAudit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_balance_approval_audit', function (Blueprint $table) {
            $table->increments('auditId');
            $table->string('action');
            $table->integer('userBalancesId');
            $table->float('balance', 8,2);
            $table->integer('userId');
            $table->float('pendingBalance', 8, 2);
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
        Schema::dropIfExists('user_balance_approval_audit');
    }
}
