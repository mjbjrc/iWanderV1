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

Route::get('/', function () {
    return view('welcome');
});

//test autocomplete
Route::get('autocomplete', 'API\CountryController@autocomplete');
Route::get('search', 'API\CountryController@search');

// Auth::routes();
Route::get('/home', 'PlaceController@index')->name('home');
Route::get('search/{name}', 'RestaurantController@searchLocation');
// Route::get('/restaurant/{id}', 'RestaurantController@viewRestaurant')->name('restaurant');
