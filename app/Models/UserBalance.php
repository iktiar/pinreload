<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBalance extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'userBalance';

    protected $fillable = [
        'balance', 'user_id', 'pendingBalance', 'isoCode', 'status'
    ];
}
