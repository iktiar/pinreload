<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PinTransaction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pinTransactions';

    protected $fillable = [
        'serial_no', 'country', 'operator', 'amount', 'pinId', 'expiry_date', 'status', 'user_id',
        'api_reference', 'reference'
    ];
}
