<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	//lets simulate auth for testing. should be removed in production
	//Auth::LoginUsingId(1);
    return view('auth/login');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::resource('/pins', 'PinController', ['middleware' => 'auth']);
Route::get('/adduserbalance/{user_id}',['uses' => 'AddUserBalanceController@showUserBalance']);
Route::resource('/userbalance', 'UserBalanceController', ['middleware' => 'auth']);

Route::resource('/manageuserbalance', 'ManageUserBalanceController', ['middleware' => 'auth']);
Route::resource('/currency', 'CurrencyController', ['middleware' => 'auth']);
Route::resource('/manageexchangerate', 'ManageExchangeRateController', ['middleware' => 'auth']);

Route::post('/pinupload', function() {
	 $path = request()->file('pinfile')->store('pinfiles');
	
	 return back($path);
	});
