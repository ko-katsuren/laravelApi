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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('/userinfo', 'App\Http\Controllers\UserInfoController');
Route::apiResource('/matterinfo', 'App\Http\Controllers\MatterInfoController');

Route::post('/login', 'App\Http\Controllers\ApiController@login');
Route::group(['/middleware' => ['auth.jwt']], function () {
    Route::post('/logout', 'App\Http\Controllers\ApiController@logout');
    Route::get('/user-info', 'App\Http\Controllers\ApiController@getUser');
});
