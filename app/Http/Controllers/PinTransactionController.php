<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PinTransaction;

use Illuminate\Support\Facades\Response;
use DB;
class PinTransactionController extends Controller
{


    /**
     * Show API doc static page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('api.api');
    }

    /**
     * Get all pintransaction list
     *
     * @return json data
     */
     public function getPinTransactionList() {

         //$transactionlist =  PinTransaction::all();
         $transactionlist = DB::table('pinTransactions')
         					->join('pins', 'pinTransactions.pinId', '=', 'pins.id')
         					->get();

         return view('pintransaction.pintransactionlist', ['transactionlist' => $transactionlist]);
     }
}
