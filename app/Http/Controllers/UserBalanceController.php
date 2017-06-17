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
        $currencies = Currency::pluck('currencyName','isoCode');

        return view('userBalance.userBalanceIndex', ['currencies' => $currencies]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'currencies' => 'required|min:1',
            'balance' => 'required|numeric|min:1',
            'user_id' => 'required|numeric|min:1'
        ]);


       try
        {
            $userBalance = \DB::table('userBalance')->where('user_id', '=',$request['user_id'])->first();
            //if user already added in balance, add new amount in pending column
            if (count($userBalance) > 0) {

                $totalpending = $userBalance->pendingBalance + $request['balance'];
                $result = UserBalance::where('user_id', '=', $request['user_id'])
                    ->update(['pendingBalance' => $totalpending,
                              'isoCode' => $request['currencies'],
                              'status' => config('bdpin.pending') ] );

            } else {
                //  user first time added in balance, add in pending column
                $newUserBalance = new UserBalance();
                $newUserBalance->balance = 0;
                $newUserBalance->pendingBalance = $request['balance'];
                $newUserBalance->user_id = $request['user_id'];
                $newUserBalance->isoCode = $request['currencies'];
                $newUserBalance->status  = config('bdpin.pending');
                $newUserBalance->save();
            }

            return \Redirect::to('/userbalance')->with('status', 'Save successful');
        }
        catch (\Exception $e){
            return \Redirect::to('/userbalance')->with('error', 'Error occurred'.$e->getMessage());

    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
