<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\UserBalance;
use App\User;

class AddUserBalanceController extends Controller
{
    public function showUserBalance($user_id)
    {
        $user = User::with('balance','currency')->find($user_id);

        return view('adduserbalance.adduserbalance', ['user' => $user]);
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
            'balance' => 'required|numeric|min:1',
            'user_id' => 'required|numeric|min:1',
            'password' => 'required|min:1',
            'reference' => 'required|min:1'
        ]);

        try {
            //validate 'password' is matched with logged in user's password.
            //get user by $user email
           // $searchUser = \DB::table('users')->where('id', '=', $request['user_id'])->first();
            //$isMatched  = $this->checkPasswordWithAuthUser($request->input('password'), $searchUser->password);

            $credentials = [
                'email' => \Auth::user()->email,
                'password' => $request->input('password'),
            ];

            $valid = \Auth::validate($credentials);
            if(!$valid){
                return \Redirect::to('/adduserbalance/'.$request['user_id'])->with('error', 'Error, invalid password for current user')->withInput();
            }

            $userBalance = \DB::table('userBalance')->where('user_id', '=', $request['user_id'])->first();
            //if user already added in balance, add new amount in pending column
            if (count($userBalance) > 0) {

                $totalBalance = $userBalance->balance + $request['balance'];
                $result = UserBalance::where('user_id', '=', $request['user_id'])
                    ->update(['balance' =>  $totalBalance,
                        'reference' => $request['reference'],
                        'status' => config('pin.approved')]);

            } else {
                //  user first time added in balance, add in pending column
                $newUserBalance = new UserBalance();
                $newUserBalance->balance = $request['balance'];
                $newUserBalance->user_id = $request['user_id'];
                $newUserBalance->reference = $request['reference'];
                $newUserBalance->status = config('pin.approved');
                $newUserBalance->save();
            }

            return \Redirect::to('/manageuserbalance')->with('status', 'Save successful');
        } catch (\Exception $e) {
            return \Redirect::to('/manageuserbalance')->with('error', 'Error occurred' . $e->getMessage());

        }
    }


    /**
     * validate 'password' is matched with logged in user's password.
     *
     * @param varchar @password
     * @return boolean
     */
    private function checkPasswordWithAuthUser($inputPassword, $authUserPassword) {

        if (!\Hash::check($inputPassword,$authUserPassword)) {
            return false;
            //return \Response::json(array('status' => 'NO', 'message' => 'no user found'));
        }
        else {
            return true;
        }
    }


}
