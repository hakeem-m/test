<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

Route::group(array('before' => 'auth.custom'), function() {



    //route for index page, call index method of controller
    Route::get('/dashboard', 'UrlsController@index');
          

    Route::model('url', 'Url');
    // route for long to short URL conversion.
    Route::get('/longToShort', 'UrlsController@longToShort');

    // route for url builder page.
    Route::get('/urlBuilder', 'UrlsController@urlBuilder');

    Route::get('/delete/{url}', 'UrlsController@delete');

    Route::post('/delete', 'UrlsController@handleDelete');

    // route for form submission call handle long to short method.
    Route::post('/longToShort', 'UrlsController@handleLongToShort');

    // route for handle urlBuilder form submission.
    Route::post('/urlBuilder', 'UrlsController@handleUrlBuilder');
    // route for save call to save method.
    Route::post('/save', 'UrlsController@save');
    // route for save build url data int url_data table.
    Route::post('/save_url', 'UrlsController@saveBuildUrl');

    // route for   short to long URL conversion.
    Route::get('/shortToLong', 'UrlsController@shortToLong');

    // route for form submission call handle   short to long method.
    Route::post('/shortToLong', 'UrlsController@handleShortToLong');
    // route for   showing short url form, then get its analytics.
    Route::get('/shortAnalytics', 'UrlsController@shortAnalytics');

    // route for handle shortAnalytics request.
    Route::post('/shortAnalytics', 'UrlsController@handleShortAnalytics');
    
    //routes needed for datatable
    Route::resource('urls', 'UrlsController');
    Route::get('api/urls', array('as' => 'api.urls', 'uses' => 'UrlsController@getDatatable'));

    // test route to just run code snippet 
    Route::get('/test', function() {
        
        
        
    });

});// end of authentication routes

// route for   cron job script.
Route::get('/cron', 'UrlsController@cronJob');
// post route called using tabletool ajax button with post dat
Route::post('/export', 'UrlsController@exportCsv');
// get route for testing propose
Route::get('/export', 'UrlsController@exportCsv');
// get route for testing propose
Route::get('/downloadCSV', 'UrlsController@downloadCsv');
// get route for testing propose
Route::post('/downloadCSV', 'UrlsController@downloadCsv');

// Confide routes

Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::get('/', 'UsersController@login');
Route::get('/users/login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', 'UsersController@logout');


