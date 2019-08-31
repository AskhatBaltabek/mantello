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

// Route::get('/', function () {
//     return redirect('admin/main');
// })->middleware('auth');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware'=> 'auth'], function () {
	Route::get('/', 'MainController@index')->name('Admin.Main');

	Route::get('/getCities', 'MainController@getCities');
	Route::get('/getCitiesList', 'MainController@getCitiesList');
	Route::post('/storeCity', 'MainController@storeCity');
	Route::post('/deleteCity', 'MainController@deleteCity');

	Route::get('/getServices', 'MainController@getServices');
	Route::post('/storeService', 'MainController@storeService');
	Route::post('/deleteService', 'MainController@deleteService');

	Route::get('/getRoles', 'MainController@getRoles');
	Route::post('/storeRole', 'MainController@storeRole');
	Route::post('/deleteRole', 'MainController@deleteRole');

	Route::get('/getStores', 'MainController@getStores');
	Route::post('/storeStore', 'MainController@storeStore');
	Route::post('/deleteStore', 'MainController@deleteStore');

	Route::get('/getEmployees', 'MainController@getEmployees');
	Route::post('/storeEmployee', 'MainController@storeEmployee');
	Route::get('/userEditWindow', 'MainController@userEditWindow');
	Route::get('/deleteUser', 'MainController@deleteUser');

	Route::get('/goods', 'ProductController@index')->name('Admin.Goods');
	Route::get('/getProducts', 'ProductController@getProducts');
	Route::get('/goods/{id}', 'ProductController@productWindow')->name('Admin.Goods.Good');
	Route::post('/uploadGalleryImages', 'ProductController@uploadGalleryImages');

	Route::get('/getCategories', 'ProductController@getCategories');
	Route::get('/storeCategory', 'ProductController@storeCategory');

	Route::get('/getSizes', 'ProductController@getSizes');

	Route::get('/getValuts', 'MainController@getValuts');

	Route::get('/catalog', 'CategoryController@index')->name('Admin.Catalog');



	Route::get('/test', 'GoodsController@test')->name('Admin.Test');
});

Route::group(['prefix' => '/'], function() {
	Route::get('/', 'ShopController@index')->name('Shop.Main');
	Route::get('/shop-grid', 'ShopController@shopGrid')->name('Shop.Grid');
	Route::get('/product-details', 'ShopController@productDetails')->name('Shop.Good');
	Route::get('/about', 'ShopController@about')->name('Shop.About');
	Route::get('/addToCart', 'ShopController@addToCart');
	Route::get('/getCartDetails', 'ShopController@getCartDetails');
	Route::get('/updateCart', 'ShopController@updateCart');
	Route::get('/contact', 'ShopController@contact')->name('Shop.Contact');
	Route::get('/checkout', 'ShopController@checkout')->name('Shop.Checkout');
});