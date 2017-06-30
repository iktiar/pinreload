<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use Illuminate\Http\Request;
use App\Models\Pin;
use Mockery\CountValidator\Exception;

class AddPinController extends Controller
{

    /**
     * Remove the specified resource from storage.
     *
     * @param int $pin
     * @param int $serial
     * @param int $amount
     * @param datetime $expiry_date
     * @param string $country
     * @param string $operator
     * @return \Illuminate\Http\Response
     */
    //public function storeNewPin($pin, $serial, $amount, $expiry_date, $country, $operator)
    public function storeNewPin(Request $request)
    {

      try {
          $this->validate($request, [
              'serial_no' => 'required|string',
              'operators' => 'required|numeric',
              'amount' => 'required|numeric',
              'pin' => 'required|numeric',
              'expiry_date' => 'required|string',
              'status' => 'required|string'
          ]);

          //get operator info by id
          $operator = Operator::where('operatorId', '=', $request->input('operators'))->first();

          Pin::Create([
              'serial_no' => $request->input('serial_no'),
              'country' => $operator->country,
              'operator' => $operator->name,
              'amount' => $request->input('amount'),
              'pin' => $request->input('pin'),
              'expiry_date' => date_format(new \DateTime($request->input('experity_date')), 'Y-m-d H:i:s'),
              'status' => $request->input('status')
          ]);

          return \Redirect::to('/pins')->with('status', 'Pin created successfully');
      }
      catch (Exception $e) {
          exit($e->getMessage());
          return \Redirect::to('/pins')->with('error', 'Error, '.$e->getMessage());
      }

    }
}
