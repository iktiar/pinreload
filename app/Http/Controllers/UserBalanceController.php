<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\UserBalance;

class UserBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::pluck('currencyName', 'isoCode');

        return view('userbalance.userbalance', ['currencies' => $currencies])->with('status', 'Data imported successfully');
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
            'balance' => 'required|numeric|min:1',
            'user_id' => 'required|numeric|min:1'
        ]);


        try {
            $userBalance = \DB::table('userBalance')->where('user_id', '=', $request['user_id'])->first();
            //if user already added in balance, add new amount in pending column
            if (count($userBalance) > 0) {

                $totalBalance = $userBalance->balance + $request['balance'];
                $result = UserBalance::where('user_id', '=', $request['user_id'])
                                      ->update(['balance' =>  $totalBalance,
                                                'isoCode' => $request['currencies'],
                                                'status' => config('pin.approved')]);

            } else {
                //  user first time added in balance, add in pending column
                $newUserBalance = new UserBalance();
                $newUserBalance->balance = $request['balance'];
                $newUserBalance->user_id = $request['user_id'];
                $newUserBalance->isoCode = $request['currencies'];
                $newUserBalance->status = config('pin.approved');
                $newUserBalance->save();
            }

            return \Redirect::to('/manageUserBalance')->with('status', 'Save successful');
        } catch (\Exception $e) {
            return \Redirect::to('/userbalance')->with('error', 'Error occurred' . $e->getMessage());

        }
    }

}
