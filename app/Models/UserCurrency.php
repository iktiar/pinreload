<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCurrency extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'userCurrency';

    protected $fillable = ['currency','user_id'];
}
