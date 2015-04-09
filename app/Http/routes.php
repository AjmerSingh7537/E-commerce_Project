<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::bind('products', function($slug)
{
    return App\Products::whereSlug($slug)->first();
});

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::resource('products', 'ProductsController', [
    'names' => [
        'index' => 'products_path',
        'show' => 'product_path',
        'create' => 'add_product_path',
        'update' => 'update_product',
        'edit' => 'edit_product',
        'destroy' => 'delete_product',
        'store' => 'store_product'
    ]
]);

Route::resource('categories', 'CategoriesController', [
    'only' => ['index', 'store', 'destroy'],
    'names' => [
        'index' => 'categories',
        'store' => 'add_category',
        'destroy' => 'delete_category'
    ]
]);

Route::resource('cart', 'CartController', [
    'except' => ['show', 'create'],
    'names' => [
        'index' => 'show_cart',
        'edit' => 'edit_cart_view',
        'update' => 'update_cart',
        'store' => 'add_to_cart',
        'destroy' => 'delete_item'
    ]
]);

Route::resource('reviews', 'ReviewsController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
