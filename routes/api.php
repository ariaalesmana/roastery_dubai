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

Route::post('v1/login', 'API\AuthController@login');

Route::get('{code}/order/data/{order}', 'APIController@order')->name('katalog.monitoring.order');

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('v1/list-jenis', 'API\JenisController@index');
    Route::get('v1/detail-jenis/{id}', 'API\JenisController@detail');
    Route::get('v1/delete-jenis/{id}', 'API\JenisController@delete');
    Route::post('v1/add-jenis', 'API\JenisController@add');

    Route::get('v1/list-supplier', 'API\SupplierController@index');
    Route::get('v1/detail-supplier/{id}', 'API\SupplierController@detail');
    Route::get('v1/delete-supplier/{id}', 'API\SupplierController@delete');
    Route::post('v1/add-supplier', 'API\SupplierController@add');

    Route::get('v1/list-batch', 'API\BatchController@index');
    Route::get('v1/detail-batch/{id}', 'API\BatchController@detail');
    Route::get('v1/delete-batch/{id}', 'API\BatchController@delete');
    Route::post('v1/add-batch', 'API\BatchController@add');
    Route::get('v1/add-detail', 'API\BatchController@add_detail');

    Route::get('v1/list-product', 'API\ProductController@index');
    Route::get('v1/add-detail-product', 'API\ProductController@add_detail');
    Route::post('v1/add-product', 'API\ProductController@add');
    Route::get('v1/get-sub-category/{id}', 'API\ProductController@sub_category');
    Route::get('v1/detail-product/{id}', 'API\ProductController@detail');
    Route::get('v1/delete-product/{id}', 'API\ProductController@delete');

    Route::post('v1/add-biji', 'API\BijiController@add');
    Route::get('v1/delete-biji/{id}', 'API\BijiController@delete');

    Route::post('v1/add-unit', 'API\UnitController@add');
    Route::get('v1/delete-unit/{id}', 'API\UnitController@delete');
    Route::get('v1/get-unit-detail', 'API\UnitController@get_unit_detail');

    Route::post('v1/add-proses', 'API\ProsesController@add');
    Route::get('v1/delete-proses/{id}', 'API\ProsesController@delete');


    // app pabrik
    Route::get('v1/list-production', 'API\ProductionController@index');
    Route::post('v1/add-production', 'API\ProductionController@add');
    Route::get('v1/summary-production', 'API\ProductionController@summary');

    Route::get('v1/list-logistic', 'API\LogisticController@index');
    Route::post('v1/add-logistic', 'API\LogisticController@add');
    Route::get('v1/summary-logistic', 'API\LogisticController@summary');

    Route::get('v1/sales', 'API\SalesController@index');
    Route::post('v1/add-sales', 'API\SalesController@add');
    Route::get('v1/summary-sales', 'API\SalesController@summary');
    // end app pabrik
});
