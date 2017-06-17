<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelUserBalanceApprovalAudit extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'userBalanceApprovalAudit';

    protected $fillable = [
        'balance', 'userId', 'userBalancesId', 'pendingBalance', 'balance', 'isoCode', 'status'
    ];
}
