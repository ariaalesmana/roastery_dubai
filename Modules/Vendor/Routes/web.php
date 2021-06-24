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

Route::prefix('vendor')->group(function() {
    Route::group(['middleware' => 'auth:vendor'], function () {
        Route::get('{code}/dashboard', 'VendorController@index')->name('vendor');
        Route::get('{code}/product/{product}', 'ProductController@index')->name('vendor.product');
        Route::get('{code}/product/hapusQR/{product}', 'ProductController@hapusQR')->name('vendor.product.hapusqr');
        Route::get('{code}/product/detail/{id}', 'ProductController@detail')->name('vendor.product.detail');
        Route::get('{code}/product/edit/{id}', 'ProductController@edit')->name('vendor.product.edit');
        Route::post('{code}/product/edit', 'ProductController@edit_post')->name('vendor.product.edit_post');

        Route::get('{code}/product/contract/{contract}', 'ProductContractController@contract')->name('vendor.product.contract');
        Route::get('{code}/product/contract-detail/{contract}', 'ProductContractController@detail')->name('vendor.product.contract.detail');
        Route::get('{code}/product/contract/add/{id}', 'ProductContractController@product_create')->name('vendor.product.contract.add_product');
        Route::post('{code}/product/contract/add/{id}/post', 'ProductContractController@product_create_post')->name('vendor.product.contract.add_product_post');

        Route::get('{code}/subsubcategory', 'ProductController@subcategory')->name('vendor.product.subcategory');

        Route::get('{code}/order/{order}', 'OrderController@index')->name('vendor.order');
        Route::get('{code}/order/detail/{id}', 'OrderController@detail')->name('vendor.order.detail');
        Route::post('{code}/order/post', 'OrderController@kirim')->name('vendor.order.post');
        Route::get('{code}/order-notes', 'OrderController@notes')->name('vendor.order.notes');
        Route::post('{code}/order/notes-post', 'OrderController@notes_post')->name('vendor.order.notes.post');
    });
});
