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
Route::group(['prefix' => 'v1'], function() {

Route::get('get-surat/','API\SuratController@index');
Route::get('get-surat/{id}','API\SuratController@show');
Route::get('get-surat/{id}/{limit}/{offset}','API\SuratController@scrolling');
});

Route::apiResources([
    'get-surat' => 'SuratController'
]);