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
//frontend
Route::get('/', 'HomeController@index');

//Show product by category

Route::get('/product-by-category/{category_id}','HomeController@product_by_category');
Route::get('/product-by-manufacture/{manufacture_id}','HomeController@product_by_manufacture');
Route::get('/view-product/{product_id}','HomeController@product_details_by_id');

// Cart routes

Route::post('/add-to-cart','CartController@add_to_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-cart/{rowId}','CartController@delete_cart');
Route::post('/update-cart','CartController@update_cart');


//Checkout routes
Route::get('/login','CheckoutController@login');
Route::post('/customer-registration','CheckoutController@customer_registration');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save-shipping','CheckoutController@save_shipping');


//Customer login and logout
Route::post('/customer-login','CheckoutController@customer_login');
Route::get('/customer-logout','CheckoutController@customer_logout');

//payment routes
Route::get('/payment','CheckoutController@payment');
Route::post('/order-place','CheckoutController@order_place');
Route::get('/manage-order','CheckoutController@manage_order');
Route::get('/inactive-order/{order_id}','CheckoutController@inactive_order');
Route::get('/active-order/{order_id}','CheckoutController@active_order');
Route::get('/delete-order/{order_id}','CheckoutController@delete_order');


//Backend

Route::get('/logout','SuperAdminController@logout');
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard','SuperAdminController@index');
Route::post('/admin-dashboard','AdminController@dashboard');

//category routes

Route::get('/add-category','CategoryController@index');
Route::get('/all-category','CategoryController@all_category');
Route::post('/save-category','CategoryController@save_category');
Route::get('/inactive-category/{category_id}','CategoryController@inactive_category');
Route::get('/active-category/{category_id}','CategoryController@active_category');
Route::get('/edit-category/{category_id}','CategoryController@edit_category');
Route::post('/update-category/{category_id}','CategoryController@update_category');
Route::get('/delete-category/{category_id}','CategoryController@delete_category');


//brand routes

Route::get('/add-brand','BrandController@index');
Route::post('/save-brand','BrandController@save_brand');
Route::get('/all-brands','BrandController@all_brands');
Route::get('/inactive-brands/{manufacture_id}','BrandController@inactive_brands');
Route::get('/active-brands/{manufacture_id}','BrandController@active_brands');
Route::get('/edit-brand/{manufacture_id}','BrandController@edit_brand');
Route::post('/update-brand/{manufacture_id}','BrandController@update_brand');
Route::get('/delete-brand/{manufacture_id}','BrandController@delete_brand');


//product routes

Route::get('/add-product','ProductController@index');
Route::post('/save-product','ProductController@save_product');
Route::get('/all-products','ProductController@all_products');
Route::get('/inactive-products/{product_id}','ProductController@inactive_products');
Route::get('/active-products/{product_id}','ProductController@active_products');
Route::get('/delete-product/{product_id}','ProductController@delete_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::post('/update-product/{product_id}','ProductController@update_product');


// Slider Routes
Route::get('/add-slider','SliderController@index');
Route::post('/save-slider','SliderController@save_slider');
Route::get('/all-slider','SliderController@all_slider');
Route::get('/inactive-sliders/{slider_id}','SliderController@inactive_sliders');
Route::get('/active-sliders/{slider_id}','SliderController@active_sliders');
Route::get('/delete-slider/{slider_id}','SliderController@delete_slider');
