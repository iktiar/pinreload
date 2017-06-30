<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'operators';
    protected $primaryKey = 'operatorId';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'country', 'operator', 'currency', 'amount', 'pin', 'expiry_date', 'status'
    ];
}
