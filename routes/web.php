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
Auth::routes();

Route::get('coffee-dubai/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('login.admin');
Route::post('coffee-dubai/login/admin', 'Auth\LoginController@adminLogin')->name('login.post.admin');

Route::get('coffee-dubai/login', 'Auth\LoginController@showCustomerLoginForm')->name('login.customer');
Route::post('coffee-dubai/login', 'Auth\LoginController@customerLogin')->name('login.post.customer');

Route::get('coffee-dubai/login/vendor', 'Auth\LoginController@showVendorLoginForm')->name('login.vendor');
Route::post('coffee-dubai/login/vendor', 'Auth\LoginController@vendorLogin')->name('login.post.vendor');



Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('coffee-dubai/admin', 'Admin\AdminController@redirect')->name('admin.index');
});
Route::group(['middleware' => 'auth:vendor'], function () {
    Route::get('coffee-dubai/vendor', 'Vendor\VendorController@redirect')->name('vendor.index');
});
Route::group(['middleware' => 'auth:customer'], function () {
    Route::get('coffee-dubai/redirect', 'Katalog\KatalogController@redirect')->name('katalog.index');
});

Route::get('/', 'Katalog\GuestController@redirect')->name('guest.index');
Route::get('coffee-dubai/', 'Katalog\GuestController@index')->name('guest.index');
Route::get('coffee-dubai/detail/product/{code}/{hash}', 'Katalog\GuestController@detail_product')->name('guest.detail.product');


Route::get('coffee-dubai/test', 'TestController@index')->name('test');
Route::get('coffee-ketjil/index/7', 'TestController@index7')->name('index7');

