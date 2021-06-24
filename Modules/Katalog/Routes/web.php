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

Route::prefix('coffee-dubai/katalog')->group(function() {
    Route::group(['middleware' => 'auth:customer'], function () {
        //product
        Route::get('{code}', 'KatalogController@index')->name('katalog');
        Route::get('{code}/{hash}', 'KatalogController@detail_product')->name('katalog.detail.product');
        Route::get('{code}/category/{hash}', 'KatalogController@get_category')->name('katalog.get_category');
        Route::get('{code}/subcategory/{hash}', 'KatalogController@get_sub_category')->name('katalog.get_sub_category');
        Route::get('{code}/subsubcategory/{hash}', 'KatalogController@get_sub_sub_category')->name('katalog.get_sub_sub_category');

        //cart
        Route::get('{code}/get/data/cart', 'CartController@get_data_cart')->name('katalog.cart.getdata');
        Route::get('{code}/add/data/cart', 'CartController@add_to_cart')->name('katalog.cart.add');
        Route::get('{code}/cart/data/{cart}', 'CartController@index')->name('katalog.cart.index');
        Route::post('{code}/update/data/cart', 'CartController@update_cart')->name('katalog.cart.update');
        Route::get('{code}/delete/data/cart', 'CartController@delete_cart')->name('katalog.cart.delete');

        //compare
        Route::get('{code}/get/data/comparison', 'ComparisonController@get_data_comparison')->name('katalog.comparison.getdata');
        Route::get('{code}/add/data/comparison', 'ComparisonController@add_to_comparison')->name('katalog.comparison.add');
        Route::get('{code}/delete/data/comparison', 'ComparisonController@delete_comparison')->name('katalog.comparison.delete');
        Route::get('{code}/comparison/data/{comparison}', 'ComparisonController@index')->name('katalog.comparison.index');

        //notification
        Route::get('{code}/get/data/notification', 'NotificationController@get_data_notification')->name('katalog.notification.getdata');

        //checkout
        Route::post('{code}/checkout', 'CheckoutController@index')->name('katalog.checkout.index');
        Route::post('{code}/checkout/post', 'CheckoutController@add_order')->name('katalog.checkout.post');

        //order
        Route::get('{code}/order/data/{order}', 'MonitoringController@order')->name('katalog.monitoring.order');
        Route::get('{code}/order/data/detail/{order_number}', 'MonitoringController@order_detail')->name('katalog.monitoring.order.detail');
        Route::get('{code}/order/notes', 'MonitoringController@notes')->name('katalog.monitoring.order.notes');
        Route::post('{code}/order/notes-post', 'MonitoringController@notes_post')->name('katalog.monitoring.order.notes.post');
        Route::get('{code}/order/reorder/{order_number}', 'MonitoringController@reorder')->name('katalog.monitoring.reorder');
        Route::get('{code}/order/finish/{order_number}', 'MonitoringController@finish')->name('katalog.monitoring.finish');

        //po
        Route::get('{code}/po/create/{order_number}', 'POController@create_po')->name('katalog.monitoring.po.create');
        Route::post('{code}/create/po/post', 'POController@post_po')->name('katalog.monitoring.po.post');
        Route::get('{code}/po/data/{po}', 'POController@index')->name('katalog.monitoring.po.index');
        Route::get('{code}/po/data/detail/{id}', 'POController@detail_po')->name('katalog.monitoring.po.detail_po');
        Route::get('{code}/po/data/cetakpdf/{po_id}', 'POController@cetakpdf')->name('katalog.monitoring.po.cetakpdf');
    });
});
