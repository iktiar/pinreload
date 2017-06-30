<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use App\Models\UserBalance;
use App\Models\ExchangeRate;
use App\Models\Operator;
use App\Models\UserCurrency;
use Carbon\Carbon;
use App\Models\PinTransaction;
use Illuminate\Support\Facades\Response;

class PinPullByUserController extends Controller
{
    /**
     * Fetch pin and serial api
     *
     * @param string $user
     * @param string $password
     * @param string $operator
     * @param int $value
     * @param int $userReference
     * @return status
     */
    public function ValidatePullRequest($operator, $amount, $userReference, $user, $password)
    {
        //get user by $user email
        $searchUser = \DB::table('users')->where('email', '=', $user)->first();


        if (!count($searchUser)) {
            return \Response::json(array('status' => 'NO', 'message' => 'no user found'));
        }

        if (!\Hash::check($password, $searchUser->password)) {
            return \Response::json(array('status' => 'NO', 'message' => 'no user found'));
        }

        //return \Response::json(array('YES','user pass matched'));

        //check user have enough userBalance
        $searchUserBalance = \DB::table('userBalance')->where('balance', '>=', $amount)
            ->where('user_id', '=', $searchUser->id)
            ->first();

        //get exchange rate against user currency
        $userCurrency = UserCurrency::where('user_id', '=', $searchUser->id)->first();

        $userCurrencyExchangeRate = ExchangeRate::where('isoCode', '=', $userCurrency->currency)->first();

        //get exchange rate for operator currency

        $operatorObj = Operator::where('name', '=', $operator)->first();

        if (!count($operatorObj)) {
            return \Response::json(array('status' => 'NO', 'message' => 'no operator found'));
        }

        $operatorCurrencyExchangeRate = ExchangeRate::where('currencyName', '=', $operatorObj->currency)->first();

        $userCurrencyExchangeRate = ExchangeRate::where('isoCode', '=', $userCurrency->currency)->first();

        //check user balance vs total cost for this product
        //total cost

        $total_cost = $amount/$operatorCurrencyExchangeRate->exchangeRate;
        $user_balance = $searchUserBalance->balance/$userCurrencyExchangeRate->exchangeRate;
        $hasBalance = ( $user_balance >=  $total_cost ) ? true : false;
        $total_cost_in_user_currency = $total_cost*$userCurrencyExchangeRate->exchangeRate;

        //$user1 = $searchUserBalance->balance/$userCurrencyExchangeRate->exchangeRate;
        //$operator1 = $amount/$operatorCurrencyExchangeRate->exchangeRate;

         /*
        return \Response::json(array('hasBalance' => $hasBalance,
            'total_cost' => $total_cost ,
            'total_cost_in_user_currency' => $total_cost_in_user_currency,
            'user_bal' => $user1,
            'currency_user' => $userCurrency->currency,
            'currency_operator' => $operatorObj->currency,
            'user_balance' => $searchUserBalance->balance,
            'amount' => $amount,
            'totalcost' => $operator1));
         */

        if (!$hasBalance) {
            return \Response::json(array('status' => 'NO', 'message' => 'not sufficient balance', 'total_cost' => $total_cost, 'balance' => $user_balance));
        }


        $currentDateTime = Carbon::now();
        $selectValidPin = \DB::table('pins')->where([['operator', '=', $operator],
            ['amount', '=', $amount],
            ['expiry_date', '>=', $currentDateTime],
            ['status', '=', config('pin.ACTIVE')]
        ])->first();

        if (!count($selectValidPin)) {
            return \Response::json(array('status' => 'NO', 'message' => 'no valid pin found'));
        }


        //ready for pull pin information.
        $result = $this->PullPinInformation($searchUser->id, $operator, $amount, $userReference, $total_cost_in_user_currency);

        return \Response::json($result);

    }

    /**
     * Pull Pin information from pins schema
     * deduct pin price/amount from user's account.
     *
     * @param string $user_id
     * @param string $operator
     * @param int $amount price of pin, that will be deducted from user.
     * @param int $userreference
     * @return json  pin,reference
     */
    private function PullPinInformation($user_id, $operator, $amount, $userReference, $total_cost)
    {

        // do your database transaction here

        // Start transaction!
        \DB::beginTransaction();

        try {
            //deduct pin recharge amount from user table

            //add pinpull transaction in transaction table for future reporting.

            $userBalance = \DB::table('userBalance')
                ->where('user_id', '=', $user_id)
                ->first();
            $user = \DB::table('users')
                ->select('name', 'email')
                ->where('id', '=', $user_id)
                ->get();

            $updatedUserBalance = UserBalance::where('user_id', '=', $user_id)
                ->update(['balance' => ($userBalance->balance - $total_cost)]
                );

            //select an active matched pin then change pin state to 'Used' in 'pins' table
            $currentDateTime = Carbon::now();
            $selectedPin = \DB::table('pins')->where([['operator', '=', $operator],
                ['amount', '=', $amount],
                ['expiry_date', '>=', $currentDateTime],
                ['status', '=', config('pin.ACTIVE')]
            ])->first();

            $pins = Pin::where('id', '=', $selectedPin->id)->update(['status' => config('pin.USED')]);
            $random = mt_rand(10000000000, 999999999999);

            //save pin pull api
            PinTransaction::Create([
                'user_id' => $user_id,
                'amount' => $amount,
                'reference' => $random,
                'api_reference' => $userReference,
                'pinId' => $selectedPin->id,
                'amount' => $amount
            ]);

        } catch (\Exception $e) {
            // Rollback and then return error message
            \DB::rollback();

            return Response::json(array('status' => 'NO', 'message' => 'error occurred.', 'reload_info' => 'error', 'errors' => $e->getMessage()));

        }

        // If we reach here, then
        // data is valid and working.
        // Commit the queries!
        \DB::commit();

        return Response::json(array('status' => 'YES',
            'reload_info' => 'reload ok',
            'service' => $selectedPin->operator,
            'serial_no' => $selectedPin->serial_no,
            'pin' => $selectedPin->pin,
            'reference' => $random,
            'value' => $amount,
            'user' => $user,
            'balance' => $userBalance->balance - $total_cost,
            'expiry' => $selectedPin->expiry_date
        ));
    }
}
