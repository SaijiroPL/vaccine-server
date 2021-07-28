<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/test', function () {
    dd(sha1('3B964965-A793-443D-BDFE-DEBDD83DB9B936'));
});
Route::get('/', function () {
    if (Auth::check())
        return redirect('/dashboard');
    else
        return redirect('/login');
})->name('login');

Route::get('/login', function() {
    return view('signin');
});
Route::post('/do_login', 'HomeController@do_login');
Route::post('/do_signup', 'HomeController@do_signup');

Route::get('/terms_of_use', 'HomeController@terms_of_use');

Route::group(['middleware'=>'auth'], function() {
    Route::any('/logout', 'HomeController@logout');
    Route::any('/dashboard', 'HomeController@index');

    Route::any('/coupon', 'CouponController@index');
    Route::any('/coupon/edit/{id?}', 'CouponController@edit');
    Route::post('/coupon/update', 'CouponController@update');
    Route::post('/coupon/delete', 'CouponController@delete');

    Route::any('/coupon_application', 'CouponApplicationController@index');
    Route::any('/coupon_application/agree', 'CouponApplicationController@update');

    Route::any('/notice', 'NoticeController@index');
    Route::any('/notice/edit/{id?}', 'NoticeController@edit');
    Route::post('/notice/update', 'NoticeController@update');
    Route::post('/notice/delete', 'NoticeController@delete');

    Route::any('/topic', 'CustomerTopController@index');
    Route::any('/topic/create', 'CustomerTopController@create');
    Route::any('/topic/edit/{id?}', 'CustomerTopController@edit');
    Route::post('/topic/update', 'CustomerTopController@update');
    Route::post('/topic/delete', 'CustomerTopController@delete');

    Route::any('/notice_application', 'NoticeApplicationController@index');
    Route::any('/notice_application/agree', 'NoticeApplicationController@update');

    Route::any('/shop', 'ShopController@index');
    Route::any('/shop/edit/{id?}', 'ShopController@edit');
    Route::post('/shop/update', 'ShopController@update');
    Route::post('/shop/delete', 'ShopController@delete');
    Route::any('/shop/get_counties_by_province', 'ShopController@get_counties_by_province');

    Route::any('/atec', 'AtecController@index');
    Route::any('/atec/edit/{id?}', 'AtecController@edit');
    Route::post('/atec/update', 'AtecController@update');
    Route::post('/atec/delete', 'AtecController@delete');

    Route::any('/tossup', 'TossupController@index');
    Route::any('/tossup/tossup', 'TossupController@tossup');

    Route::any('/manual', 'CarryingManualController@manuals');
    Route::any('/suggest_tools', 'CarryingManualController@suggest_tools');
    Route::get('/manual/delete/{id}', 'CarryingManualController@delete');
    Route::post('/manual/add', 'CarryingManualController@add');

    Route::any('/master/customer','MasterController@show_customer');
    Route::any('/master/carrying','MasterController@show_carrying');
    Route::any('/master/inquiry','MasterController@show_inquiry');
    Route::any('/master/policy','MasterController@policy');
    Route::post('/master/save_policy','MasterController@save_policy');
    Route::any('/master/faq','MasterController@faq');
    Route::post('/master/save_faq','MasterController@save_faq');
    Route::any('/master/carrying_goods','CarryingGoodsController@index');
    Route::any('/master/carrying_goods/edit/{id?}', 'CarryingGoodsController@edit');
    Route::post('/master/carrying_goods/delete', 'CarryingGoodsController@delete');
    Route::post('/master/carrying_goods/update', 'CarryingGoodsController@update');

    Route::get('/master/carrying_goods/detail/{id}', 'CarryingGoodsController@detail');
    Route::post('/master/carrying_goods/detail/{id}', 'CarryingGoodsController@detail_post');
    Route::get('/master/carrying_goods/detail/delete/{id}', 'CarryingGoodsController@delete_detail');

    Route::resource('/master/admins', AdminController::class);

    Route::any('/manager', 'ManagerController@index');
    Route::get('/manager/allow/{id}', 'ManagerController@allow');
});
