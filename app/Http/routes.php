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


Route::get('/', 'HomeController@index');

/* ITEMS */
Route::get('/items', 'ItemController@index');
Route::get('/items/view/{id}', 'ItemController@view');
Route::get('/items/delete/{id}', 'ItemController@confirm');

Route::post('/items/change/{id}', 'ItemController@change');
Route::post('/items/delete/{id}', 'ItemController@delete');
Route::post('/items/add', 'ItemController@store');

Route::get('/items/change', function() {
  return redirect('/items');
});
Route::get('/items/delete', function() {
  return redirect('/items');
});
/* ITEMS */

Route::group(['prefix' => '/api'], function() {

});

Route::auth();
