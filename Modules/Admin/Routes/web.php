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

Route::prefix('admin')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('{code}/dashboard', 'AdminController@index')->name('admin');
        
        Route::get('{code}/vendor/{vendor}', 'VendorController@index')->name('admin.vendor');
        Route::get('{code}/vendor/add/{vendor}', 'VendorController@create')->name('admin.vendor.create');
        Route::post('{code}/vendor/post', 'VendorController@create_post')->name('admin.vendor.create_post');
        Route::get('{code}/vendor/edit/{hash}', 'VendorController@edit')->name('admin.vendor.edit');
        Route::post('{code}/vendor/edit', 'VendorController@edit_post')->name('admin.vendor.edit_post');
        Route::post('{code}/vendor/edit-ubah-password', 'VendorController@edit_ubah_password')->name('admin.vendor.edit.ubah_password');
        Route::post('{code}/vendor/delete', 'VendorController@delete')->name('admin.vendor.delete');

        Route::get('{code}/vendor/contract/{contract}', 'ContractController@index')->name('admin.vendor.contract');
        Route::get('{code}/vendor/contract-edit/{hash}', 'ContractController@edit')->name('admin.vendor.contract.edit');
        Route::get('{code}/vendor/contract/create/{contract}', 'ContractController@create')->name('admin.vendor.contract_create');
        Route::post('{code}/vendor/contract/post', 'ContractController@create_post')->name('admin.vendor.contract_create_post');
        Route::post('{code}/vendorcontract/edit', 'ContractController@edit_post')->name('admin.vendor.contract_edit_post');
        
        Route::get('{code}/customer/{customer}', 'CustomerController@index')->name('admin.customer');
        Route::get('{code}/customer/edit/{customer}', 'CustomerController@edit')->name('admin.customer.edit');
        Route::get('{code}/customer/add/{customer}', 'CustomerController@create')->name('admin.customer.create');
        Route::post('{code}/customer/post', 'CustomerController@create_post')->name('admin.customer.create_post');
        Route::post('{code}/customer/edit-post', 'CustomerController@edit_post')->name('admin.customer.edit_post');

        Route::get('{code}/customer-group/{customer}', 'CustomerGroupController@index')->name('admin.customer_group');
        Route::get('{code}/customer-group/create/{customer_group}', 'CustomerGroupController@create')->name('admin.customer_group.create');
        Route::post('{code}/customer-group/create-post', 'CustomerGroupController@create_post')->name('admin.customer_group.create_post');
        Route::get('{code}/customer-group-show/{id}', 'CustomerGroupController@show')->name('admin.customer_group_show');
        Route::post('{code}/customer-group/edit-post', 'CustomerGroupController@edit_post')->name('admin.customer_group.edit_post');

        Route::get('{code}/product/{product}', 'ProductController@index')->name('admin.product');
        Route::get('{code}/product/edit/{id}', 'ProductController@edit')->name('admin.product.edit');
        Route::post('{code}/product/edit', 'ProductController@edit_post')->name('admin.product.edit_post');
        
        Route::get('{code}/product-group/{product}', 'ProductGroupController@index')->name('admin.product_group');
        Route::get('{code}/product-group-create', 'ProductGroupController@create')->name('admin.product_group_create');
        Route::get('{code}/product-group-edit/{id}', 'ProductGroupController@edit')->name('admin.product_group_edit');

        Route::get('{code}/category/{category}', 'CategoryController@index')->name('admin.category');
        Route::get('{code}/category-create/{category}', 'CategoryController@create')->name('admin.category_create');
        Route::post('{code}/category-create', 'CategoryController@create_post')->name('admin.category_create_post');
        Route::get('{code}/category-edit/{id}', 'CategoryController@edit')->name('admin.category_edit');
        
        Route::get('{code}/subcategory/{subcategory}', 'SubCategoryController@index')->name('admin.subcategory');
        Route::get('{code}/subcategory-search/search', 'SubCategoryController@search')->name('admin.subcategory_search');
        Route::get('{code}/subcategory-show/{id}', 'SubCategoryController@show')->name('admin.subcategory_show');
        Route::get('{code}/subcategory-edit/{id}', 'SubCategoryController@edit')->name('admin.subcategory_edit');
        
        Route::get('{code}/subsubcategory/{subsubcategory}', 'SubSubCategoryController@index')->name('admin.subsubcategory');
        Route::get('{code}/subsubcategory-search/search', 'SubSubCategoryController@search')->name('admin.subsubcategory_search');
        Route::get('{code}/subsubcategory-show/{id}', 'SubSubCategoryController@show')->name('admin.subsubcategory_show');
        Route::get('{code}/subsubcategory-edit/{id}', 'SubSubCategoryController@edit')->name('admin.subsubcategory_edit');
        Route::get('get-subcategory', 'SubCategoryController@get_sub_category_by_parent')->name('admin.getsubcategory');
        
        Route::get('{code}/orders-cart/{cart}', 'AdminCartController@index')->name('admin.orders.cart');
        Route::get('{code}/orders-cart-search/search', 'AdminCartController@search')->name('admin.orders.cart.search');
        Route::get('{code}/orders-cart-show/{id}', 'AdminCartController@show')->name('admin.orders.cart_show');
        
        Route::get('{code}/orders-order/{order}', 'AdminOrderController@index')->name('admin.orders.order');
        Route::get('{code}/orders-order-search/search', 'AdminOrderController@search')->name('admin.orders.order.search');
        Route::get('{code}/orders-order-show/{id}', 'AdminOrderController@show')->name('admin.orders.order_show');
        
        Route::get('{code}/orders-po/{po}', 'AdminPOController@index')->name('admin.orders.po');
        Route::get('{code}/orders-po-search/search', 'AdminPOController@search')->name('admin.orders.po.search');
        Route::get('{code}/orders-po-show/{id}', 'AdminPOController@show')->name('admin.orders.po_show');
        Route::get('{code}/orders-po-cetakpdf/{po_id}', 'AdminPOController@cetakpdf')->name('admin.orders.po.cetakpdf');
    });
});
