<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'user'], function() {
    Route::get('', 'UserController@index');
    Route::get('lock', 'UserController@lock');
});

Route::group(['prefix' => 'setting'], function() {
    Route::get('', 'SettingController@index');
});

Route::get('admin', 'AdminController@index');
Route::get('dashboard', 'AdminController@dashboard');
Route::get('personal', 'AdminController@personal');
Route::get('help', 'AdminController@help');
Route::get('message', 'AdminController@message');
Route::get('forgot', 'AdminController@forgot');
Route::get('logout', 'AdminController@logout');

Route::group(['prefix' => 'card'], function() {
    Route::get('', 'CardController@index');
    // Route::get('get', 'CardController@get');
    // Route::gets('gets', 'CardController@gets');
});

Route::group(['prefix' => 'profile'], function() {
    Route::get('', 'ProfileController@index');
    Route::get('edit', 'ProfileController@edit');
    // Route::get('get', 'ProfileController@get');
    // Route::gets('gets', 'ProfileController@gets');
});

Route::group(['prefix' => 'history'], function() {
    Route::get('', 'HistoryController@index');
    Route::get('recycle', 'HistoryController@recycle');
    Route::get('edit', 'HistoryController@edit');
    // Route::get('get', 'HistoryController@get');
    // Route::gets('gets', 'HistoryController@gets');
});

Route::group(['prefix' => 'famous'], function() {
    Route::get('', 'FamousController@index');
    Route::get('recycle', 'FamousController@recycle');
    Route::get('edit', 'FamousController@edit');
    // Route::get('get', 'FamousController@get');
    // Route::gets('gets', 'FamousController@gets');
});

Route::group(['prefix' => 'champion'], function() {
    Route::get('', 'ChampionController@index');
    Route::get('recycle', 'ChampionController@recycle');
    Route::get('edit', 'ChampionController@edit');
    // Route::get('get', 'ChampionController@get');
    // Route::gets('gets', 'ChampionController@gets');
});

Route::group(['prefix' => 'merit'], function() {
    Route::get('', 'MeritController@index');
    Route::get('recycle', 'MeritController@recycle');
    Route::get('edit', 'MeritController@edit');
    // Route::get('get', 'ChampionController@get');
    // Route::gets('gets', 'ChampionController@gets');
});

Route::group(['prefix' => 'tree'], function() {
    Route::get('', 'TreeController@index');
    // Route::get('get', 'TreeController@get');
    // Route::gets('gets', 'TreeController@gets');
});

Route::group(['prefix' => 'image'], function() {
    Route::get('', 'ImageController@index');
    // Route::get('get', 'ImageController@get');
    // Route::gets('gets', 'ImageController@gets');
});