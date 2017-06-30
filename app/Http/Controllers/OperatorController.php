<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Models\Operator;
use App\Models\Country;
use Mockery\CountValidator\Exception;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::pluck('country_name', 'country_name');
        $operators = Operator::all();
        $currecies = Currency::pluck('currencyName', 'currencyName');
        return view('operator.operatorlist', ['countries' => $countries, 'operators' => $operators, 'currencies' => $currecies]);
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
            'countries' => 'required|min:1',
            'operator' => 'required|min:1',
            'currencies' => 'required|min:1'
        ]);

        $operator = new Operator;
        $operator->country = $request->input('countries');
        $operator->name = $request->input('operator');
        $operator->currency = $request->input('currencies');

        $operator->save();

        return \Redirect::to('/operator')->with(['status' => 'Save successful']);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        print_r('came');
        $operator = Operator::where('operatorId', '=', $id)->first();
        $countries = Country::pluck('country_name', 'country_name');
        $currencies = Currency::pluck('currencyName', 'currencyName');
        //return \Response::json(array('operator' => $operator), 200);
        return view('operator.operatoredit', ['countries' => $countries, 'operator' => $operator, 'currencies' => $currencies]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'countries' => 'required|min:1',
                'operator' => 'required|min:1',
                'currencies' => 'required|min:1'
            ]);

            $operator = Operator::where('operatorId', '=', $id)->first();
            $operator->country = $request->input('countries');
            $operator->name = $request->input('operator');
            $operator->currency = $request->input('currencies');
            $operator->update();

            // return \Response::json(['status' => 'OK', 'message' => 'Save successful']);
            return \Redirect::to('/operator')->with('status', 'Operator updated successfully');
        }
        catch(Exception $e)
        {
            return \Response::json(['status' => 'failed', 'error occured '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
