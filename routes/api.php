<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => 'auth'], function() {
    Route::post('login', 'AuthController@login');
    Route::post('refresh-token', 'AuthController@refreshToken');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::delete('logout', 'AuthController@logout');
    });
});
Route::get('products', 'API\ProductController@index')->middleware('auth:api');

