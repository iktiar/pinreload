<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use App\Models\Country;
use App\Models\Operator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pins = Pin::all()->sortByDesc('id');
        $countries = Country::pluck('country_name', 'country_code');
        $operators = Operator::pluck('name','operatorId');
        return view('pin.pinlist', ['pinlist' => $pins, 'countries' => $countries, 'operators' => $operators]);

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

        if (!empty(request()->file('pinfile'))) {
            $path = request()->file('pinfile')->storePublicly('pincsvs');

            $storagePath = \Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
            $fullPath = $storagePath . $path;

            \Excel::filter('chunk')->load($fullPath)->chunk(250, function ($results) {
                foreach ($results as $row) {
                    Pin::updateOrCreate([
                        'serial_no' => $row->serial_no,
                        'country' => $row->countrey,
                        'operator' => $row->operator,
                        'amount' => $row->amount,
                        'pin' => $row->pin,
                        'expiry_date' => date_format(new \DateTime($row->experity_date), 'Y-m-d H:i:s'),
                        'status' => $row->status
                    ]);
                }
            });
            return \Redirect::to('/pins')->with('status', 'Data imported successfully');
        } else {
            return \Redirect::to('/home')->with('error', 'Error, Invalid input file!');
        }


    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $pin = Pin::find($id);
        //return \Response::json(array('pin' => $pin), 200);
        $countries = Country::pluck('country_name', 'country_code');
        $operators = Operator::pluck('name','name');
        return view('pin.pinedit', ['pin' => $pin, 'countries' => $countries, 'operators' => $operators]);
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
                'serial_no' => 'required|string',
                'operators' => 'required|string',
                'amount' => 'required|numeric',
                'pin' => 'required|numeric',
                'expiry_date' => 'required|string',
                'status' => 'required|string'
            ]);


            $pin = Pin::where('id', '=', $id)->first();
            //get operator info by id
            $operator = Operator::where('name', '=', $request->input('operators'))->first();

            $pin->serial_no = $request->input('serial_no');
            $pin->country = $operator->country;
            $pin->operator = $operator->name;
            $pin->pin     =  $request->input('pin');
            $pin->amount  = $request->input('amount');
            $pin->expiry_date = $request->input('expiry_date');
            $pin->status  = $request->input('status');
            $pin->update();

            // return \Response::json(['status' => 'OK', 'message' => 'Save successful'],200);
            return \Redirect::to('/pins')->with('status', 'Pin updated successfully');
        }
        catch(Exception $e)
        {
            return \Response::json(['status' => 'failed', 'error occurred '.$e->getMessage()],500);
        }
    }

}
