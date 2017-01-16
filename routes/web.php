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
    Route::any('add', 'SettingController@add');
    Route::any('del', 'SettingController@del');
});

Route::get('admin', 'AdminController@index');
Route::get('forgot', 'AdminController@forgot');
Route::get('login', 'AdminController@login');

Route::group(['prefix' => '', 'middleware' => 'checklogin'], function() {
    Route::get('dashboard', 'AdminController@dashboard');
    Route::get('personal', 'AdminController@personal');
    Route::get('help', 'AdminController@help');
    Route::get('message', 'AdminController@message');
    Route::get('logout', 'AdminController@logout');
});

Route::group(['prefix' => 'card', 'middleware' => 'checklogin'], function() {
    Route::get('', 'CardController@index');
    Route::any('picurl', 'CardController@picurl');
    Route::any('avatar', 'CardController@avatar');
    Route::any('test', 'CardController@test');
    // Route::get('get', 'CardController@get');
    // Route::gets('gets', 'CardController@gets');
});

Route::group(['prefix' => 'profile', 'middleware' => 'checklogin'], function() {
    Route::get('', 'ProfileController@index');
    Route::any('add', 'ProfileController@add');
    Route::get('edit', 'ProfileController@edit');
    // Route::get('get', 'ProfileController@get');
    // Route::gets('gets', 'ProfileController@gets');
});

Route::group(['prefix' => 'history', 'middleware' => 'checklogin'], function() {
    Route::get('', 'HistoryController@index');
    Route::get('recycle', 'HistoryController@recycle');
    Route::get('edit', 'HistoryController@edit');
    Route::any('add', 'HistoryController@add');
    Route::any('del', 'HistoryController@del');
    Route::any('batechdel', 'HistoryController@batechdel');
    Route::any('search', 'HistoryController@search');
    // Route::get('get', 'HistoryController@get');
    // Route::gets('gets', 'HistoryController@gets');
});

Route::group(['prefix' => 'famous', 'middleware' => 'checklogin'], function() {
    Route::get('', 'FamousController@index');
    Route::get('recycle', 'FamousController@recycle');
    Route::get('edit', 'FamousController@edit');
    Route::any('add', 'FamousController@add');
    Route::any('del', 'FamousController@del');
    Route::any('batechdel', 'FamousController@batechdel');
    Route::any('search', 'FamousController@search');
    // Route::get('get', 'FamousController@get');
    // Route::gets('gets', 'FamousController@gets');
});

Route::group(['prefix' => 'champion', 'middleware' => 'checklogin'], function() {
    Route::get('', 'ChampionController@index');
    Route::get('recycle', 'ChampionController@recycle');
    Route::get('edit', 'ChampionController@edit');
    Route::any('add', 'ChampionController@add');
    Route::any('del', 'ChampionController@del');
    Route::any('batechdel', 'ChampionController@batechdel');
    Route::any('search', 'ChampionController@search');
    // Route::get('get', 'ChampionController@get');
    // Route::gets('gets', 'ChampionController@gets');
});

Route::group(['prefix' => 'merit', 'middleware' => 'checklogin'], function() {
    Route::get('', 'MeritController@index');
    Route::get('recycle', 'MeritController@recycle');
    Route::get('edit', 'MeritController@edit');
    Route::any('add', 'MeritController@add');
    Route::any('del', 'MeritController@del');
    Route::any('batechdel', 'MeritController@batechdel');
    Route::any('search', 'MeritController@search');
    // Route::get('get', 'ChampionController@get');
    // Route::gets('gets', 'ChampionController@gets');
});

Route::group(['prefix' => 'tree', 'middleware' => 'checklogin'], function() {
    Route::get('', 'TreeController@index');
    // Route::get('get', 'TreeController@get');
    // Route::gets('gets', 'TreeController@gets');
});

Route::group(['prefix' => 'image', 'middleware' => 'checklogin'], function() {
    Route::get('', 'ImageController@index');
    Route::get('detail', 'ImageController@detail');
    // Route::get('get', 'ImageController@get');
    // Route::gets('gets', 'ImageController@gets');
});