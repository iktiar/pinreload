<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'serial_no', 'country', 'operator', 'amount', 'pin', 'expiry_date', 'status'
    ];

  
}
