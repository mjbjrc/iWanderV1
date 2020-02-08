<?php

use Illuminate\Http\Request;
use App\Countries;
use Illuminate\Support\Facades\Input;



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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'API\PassportController@login');
Route::post('register', 'API\PassportController@register');
Route::post('bookmarks', 'API\ProfileController@bookmarks');
Route::post('createitinerary', 'API\ItineraryController@create');
Route::post('addtoitinerary', 'API\EventController@create');
// Route::get('viewbookmarks', 'API\ProfileController@viewBookmarks');
// Route::get('/profile','API\ProfileController@index');
Route::put('/profile','API\ProfileController@update');

//autocomplete
Route::get('autocomplete', 'API\CountryController@autocomplete');
Route::get('search', 'API\CountryController@search');


Route::middleware('auth:api')->group(function () {
  //allow send back user information that is currently logged in
  Route::get('user', 'API\PassportController@user');
  Route::get('logout', 'API\PassportController@logout');
  Route::get('countries', 'API\CountryController@index');
  Route::get('viewbookmarks', 'API\ProfileController@viewBookmarks');
  Route::get('viewItineraries', 'API\ItineraryController@view');
  Route::get('viewEvents', 'API\EventController@view');
  Route::get('getItinerary', 'API\ItineraryController@getItinerary');
});
