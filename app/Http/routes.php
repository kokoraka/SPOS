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

/* DEFINE AUTH */
Route::auth();
/* DEFINE AUTH */


/* AUTHENTICATION */
Route::post('/login', 'Auth\EmployeeAuthController@login');
Route::get('/login', 'Auth\EmployeeAuthController@showLoginForm');
Route::get('/logout', 'Auth\EmployeeAuthController@logout');
/* AUTHENTICATION */

Route::group(['middleware' => 'employee'], function() {



  /* HOME */
  Route::get('/', 'HomeController@index');
  /* HOME */

  /* PROFILE */
  Route::get('/profile', 'ProfileController@index');
  Route::post('/profile/save', 'ProfileController@save');
  /* PROFILE */

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

  /* EMPLOYEES */
  Route::get('/employees', 'EmployeeController@index');
  Route::get('/employees/view/{id}', 'EmployeeController@view');
  Route::get('/employees/delete/{id}', 'EmployeeController@confirm');

  Route::post('/employees/change/{id}', 'EmployeeController@change');
  Route::post('/employees/delete/{id}', 'EmployeeController@delete');
  Route::post('/employees/add', 'EmployeeController@store');

  Route::get('/employees/change', function() {
    return redirect('/employees');
  });
  Route::get('/employees/delete', function() {
    return redirect('/employees');
  });
  /* EMPLOYEES */

  /* TRANSACTION HISTORY */
  Route::get('/transaction/history', 'TransactionHistoryController@index');
  Route::get('/transaction/history/view/{id}', 'TransactionHistoryController@view');
  Route::get('/transaction/history/delete/{id}', 'TransactionHistoryController@confirm');

  Route::post('/transaction/history/change/{id}', 'TransactionHistoryController@change');
  Route::post('/transaction/history/delete/{id}', 'TransactionHistoryController@delete');
  Route::post('/transaction/history/add', 'TransactionHistoryController@store');

  Route::get('/transaction/history/change', function() {
    return redirect('/transaction/history');
  });
  Route::get('/transaction/history/delete', function() {
    return redirect('/transaction/history');
  });
  /* TRANSACTION HISTORY */


  /* TRANSACTION */
  Route::get('/transaction', 'TransactionController@index');
  Route::post('/transaction/add', 'TransactionController@store');
  /* TRANSACTION */

  /* REPORT */
  Route::get('/report/items', 'ReportController@items');
  Route::get('/report/items/view', 'ReportController@viewReportItems');

  Route::get('/report/incomes', 'ReportController@incomes');
  Route::get('/report/incomes/view', 'ReportController@viewReportIncomes');
  Route::get('/report/incomes/view/{start}/{finish}', 'ReportController@viewReportIncomesCustom');
  Route::get('/report', function() {
    return redirect('/');
  });
  /* REPORT */


  Route::group(['prefix' => '/api'], function() {
    Route::post('/add/item/', 'TransactionController@addItem');
    Route::post('/remove/item', 'TransactionController@removeItem');
    Route::get('/get/orders', 'TransactionController@getOrders');
    Route::post('/remove/orders', 'TransactionController@removeOrders');

    Route::get('/chart/transactions/', 'TransactionController@last10');
  });

});
