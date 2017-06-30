<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\UserCurrency;
use App\Permission;
use Illuminate\Http\Request;
use App\User;
use App\Role;

use Illuminate\Support\Facades\Response;

class SetUserStatusController extends Controller
{
    /**
     * Fetch pin and serial api
     *
     * @param string $user_id
     * @return status
     */
    public function showUserForm($user_id) {

        $roles = Role::pluck('name', 'id');
        $currencies = Currency::pluck('currencyName', 'isoCode');

        $user = User::select('id', 'name', 'email','status')->with(['roles' => function ($query) {
                                                                        $query->select('name'); }, 'currency'])
                                                            ->where(['id' => $user_id])
                                                            ->first();
        return view('userstatus.userstatus', ['roles' => $roles, 'user_id' => $user_id, 'user' => $user, 'currencies' => $currencies]);
        /*
        //fetch all nomal/pin puller user
        $allNormalUser = User::select('id', 'name', 'email','status')->with(
            ['roles' => function ($query) {
                $query->select('name');
            }]
        )->get();

        return view('manageUserBalance.manageUserBalanceIndex', ['userBalances' => $allNormalUser])->with('status', 'User status updated successfully');
        */

    }

    public function setUserRoleCurrencyById (Request $request) {

        $user = User::where('id', '=', $request->input('user_id'))->first();
        $role = Role::where('id', '=', $request->input('roles'))->first();
        $permission = Permission::where('name', '=', 'user_permission');

        //remove if earlier role exist
        \DB::table('role_user')->where('user_id' , '=', $request->input('user_id'))->delete();

        $user->roles()->save($role);

        $user->update(['status' => $request->input('status')]);

        $oldUser = UserCurrency::where('user_id', '=', $request->input('user_id'))->first();

        if(!count($oldUser)) {
            UserCurrency::Create([
                'user_id' => $request->input('user_id'),
                'currency' => $request->input('currencies')
            ]);
        }
        else {
            $usercurrency = UserCurrency::where('id', '=', $oldUser->id)->first();
            $usercurrency->currency = $request->input('currencies');

            $usercurrency->update();
        }


        //fetch all normal/pin puller user
        $allNormalUser = User::select('id', 'name', 'email','status')->with(
            ['roles' => function ($query) {
                $query->select('name');
            }]
        )->get();

        return view('manageUserBalance.manageUserBalanceIndex', ['userBalances' => $allNormalUser])->with('status', 'User information updated successfully');

    }
}
