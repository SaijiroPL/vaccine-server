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

Route::any('/store/test', 'Api\StoreApiController@test');
Route::post('/store/login', 'Api\StoreApiController@login');
Route::post('/store/signup', 'Api\StoreApiController@signup');
Route::get('/store/get_stores/{code?}', 'Api\StoreApiController@get_stores');
Route::group(['middleware'=>'token:store'], function() {
    Route::post('/store/add_tossup', 'Api\StoreApiController@add_tossup');
    Route::any('/store/get_tossup', 'Api\StoreApiController@get_tossup');
    Route::post('/store/reply_inquiry', 'Api\StoreApiController@reply_inquiry');
    Route::any('/store/get_inquiry', 'Api\StoreApiController@get_inquiry');
    Route::any('/store/get_atec', 'Api\StoreApiController@get_atec');
    Route::any('/store/confirm_atec', 'Api\StoreApiController@confirm_atec');
    Route::any('/store/search_member', 'Api\StoreApiController@search_member');
    Route::post('/store/add_coupon', 'Api\StoreApiController@add_coupon');
    Route::any('/store/get_coupon', 'Api\StoreApiController@get_coupon');
    Route::post('/store/add_notice', 'Api\StoreApiController@add_notice');
    Route::any('/store/get_notice', 'Api\StoreApiController@get_notice');
    Route::any('/store/get_member', 'Api\StoreApiController@get_member');
    Route::any('/store/get_bottle', 'Api\StoreApiController@get_bottle');
    Route::any('/store/get_bottle_use', 'Api\StoreApiController@get_bottle_use');
    Route::any('/store/bottle_input', 'Api\StoreApiController@bottle_input');
});

Route::any('/client/test', 'Api\ClientApiController@test');
Route::post('/client/login', 'Api\ClientApiController@login');
Route::post('/client/sendVerifyNumber', 'Api\ClientApiController@sendVerifyNumber');
Route::post('/client/confirmVerifyNumber', 'Api\ClientApiController@confirmVerifyNumber');
Route::post('/client/signup', 'Api\ClientApiController@signup');
Route::post('/client/getLicense', 'Api\ClientApiController@getLicense');
Route::group(['middleware'=>'token:client'], function() {
    Route::any('/logout', 'Api\ClientApiController@logout');

});
