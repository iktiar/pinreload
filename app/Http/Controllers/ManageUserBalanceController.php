<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserBalance;
use App\User;
use App\Models\ModelUserBalanceApprovalAudit;

class ManageUserBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$userBalances = UserBalance::all();

        //fetch all nomal/pin puller user
        $allNormalUser =  User::select('id', 'name', 'email')->with(
                            ['roles' => function ($query) {  $query->select('name');}]
                            )->get();
        return view('manageUserBalance.manageUserBalanceIndex', ['userBalances' => $allNormalUser]);
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
        //update user's pending balance by admin pending > approved/discard
        // if approved, pending should be added to existing balance.

        $this->validate($request, [
            'status' => 'required|string',
            'user_id' => 'required|numeric',
          ]);

        $userBalance = UserBalance::where('user_id', '=', $request['user_id'])->first();

        if($request['status'] == config('bdpin.approved')) {

           //admin has approved user's pending amoung, lets add it with existing balance.
            $balance =  $userBalance->balance + $userBalance->pendingBalance;
            $result  = UserBalance::where('user_id', '=', $request['user_id'])
                            ->update(['balance'  => $balance, 'pendingBalance' => 0,
                                      'status' => $request['status']]);
        }
        if($request['status'] == config('bdpin.discard')) {
            //admin has approved user's pending amoung, lets add it with existing balance.
            $balance =  $userBalance->balance + $userBalance->pendingBalance;
            $result  = UserBalance::where('user_id', '=', $request['user_id'])
                ->update(['status'  => config('bdpin.discard')]);
        }

        $userBalances = UserBalance::all();

        return view('manageUserBalance.manageUserBalanceIndex', ['userBalances' => $userBalances]);

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
