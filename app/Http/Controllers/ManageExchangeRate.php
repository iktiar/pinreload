<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\ExchangeRate;

class ManageExchangeRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exchangerate = ExchangeRate::all();

        return view('manageExchangeRate.index', ['exchangerate' => $exchangerate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'currencies' => 'required|min:1',
            'exchangeRate' => 'required|numeric|min:1'
        ]);

        $currencyName = \DB::table('currency')->where('isoCode', $request['currencies'])->value('currencyName');

        $search = ExchangeRate::where('isoCode', '=', $request['currencies'])->get();

        if (count($search) > 0) {
            $exchangeRate = ExchangeRate::where('isoCode', '=', $request['currencies'])
                ->update(['exchangeRate' => $request['exchangeRate']]);

        } else {
            $exchangeRate = new ExchangeRate;
            $exchangeRate->isoCode = $request['currencies'];
            $exchangeRate->exchangeRate = $request['exchangeRate'];
            $exchangeRate->currencyName = $currencyName;
            $exchangeRate->save();

        }

        return \Redirect::to('/manageexchangerate');

    }


}
