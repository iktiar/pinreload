<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\UserBalance;

class AddUserBalanceController extends Controller
{
    public function showUserBalance ($user_id)
    {
        $currencies = Currency::pluck('currencyName','isoCode');

        return view('adduserbalance.adduserbalance', ['currencies' => $currencies, 'user_id' =>  $user_id]);
    }
}
