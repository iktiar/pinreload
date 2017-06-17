<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pin;
use Carbon\Carbon;

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
       
        return view('pin.pinlist', ['pinlist' => $pins]); 
       
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
        
        if(!empty(request()->file('pinfile'))) {
            $path = request()->file('pinfile')->storePublicly('pincsvs');
            $path = request()->file('pinfile')->storePublicly('pincsvs');

            $storagePath  = \Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
            $fullPath = $storagePath.$path;

            \Excel::filter('chunk')->load($fullPath)->chunk(250, function($results) {
                foreach ($results as $row) {
                    Pin::updateOrCreate([
                        'serial_no' => $row->serial_no,
                        'country'  => $row->countrey,
                        'operator'  => $row->operator,
                        'amount'    => $row->amount,
                        'pin'       => $row->pin,
                        'expiry_date' => date_format(new \DateTime($row->experity_date), 'Y-m-d H:i:s'),
                        'status'    => $row->status
                    ]);
                }
            });
            return \Redirect::to('/pins')->with('status', 'Data imported successfully');
        }
        else {
            return \Redirect::to('/home')->with('error', 'Error, Invalid input file!');
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
