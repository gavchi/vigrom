<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {
    Route::resource('/wallet', 'WalletController')->only([
        'show'
    ]);
    Route::resource('/transaction', 'TransactionController')->only([
        'store'
    ]);
//    Route::get('/wallet/{id}', 'WalletController@show');
//    Route::post('/wallet/{id}', 'WalletController@update');
});
