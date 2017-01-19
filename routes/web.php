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
    Route::any('', 'UserController@index');
    Route::any('lock', 'UserController@lock');
    Route::any('locked', 'UserController@locked');
    Route::any('search', 'UserController@search');
});

Route::group(['prefix' => 'setting'], function() {
    Route::any('', 'SettingController@index');
    Route::any('add', 'SettingController@add');
    Route::any('del', 'SettingController@del');
    Route::any('code', 'SettingController@code');
    Route::any('updatepassword', 'SettingController@updatepassword');
    Route::any('upadtemobile', 'SettingController@upadtemobile');
});

Route::any('admin', 'AdminController@index');
Route::any('forgot_one', 'AdminController@forgot_one');
Route::any('login', 'AdminController@login');

Route::group(['prefix' => '', 'middleware' => 'checklogin'], function() {
    Route::any('dashboard', 'AdminController@dashboard');
    Route::any('personal', 'AdminController@personal');
    Route::any('help', 'AdminController@help');
    Route::any('message', 'AdminController@message');
    Route::any('logout', 'AdminController@logout');
    Route::any('upload', 'AdminController@upload');
});

Route::group(['prefix' => 'card', 'middleware' => 'checklogin'], function() {
    Route::any('', 'CardController@index');
    Route::any('picurl', 'CardController@picurl');
    Route::any('avatar', 'CardController@avatar');
    Route::any('test', 'CardController@test');
    Route::any('zuname', 'CardController@zuname');
    // Route::get('get', 'CardController@get');
    // Route::gets('gets', 'CardController@gets');
});

Route::group(['prefix' => 'profile', 'middleware' => 'checklogin'], function() {
    Route::any('', 'ProfileController@index');
    Route::any('add', 'ProfileController@add');
    Route::any('edit', 'ProfileController@edit');
    Route::any('update', 'ProfileController@update');
    Route::any('info', 'ProfileController@info');
    // Route::get('get', 'ProfileController@get');
    // Route::gets('gets', 'ProfileController@gets');
});

Route::group(['prefix' => 'history', 'middleware' => 'checklogin'], function() {
    Route::any('', 'HistoryController@index');
    Route::any('recycle', 'HistoryController@recycle');
    Route::any('recycleoption', 'HistoryController@recycleoption');
    Route::any('edit', 'HistoryController@edit');
    Route::any('add', 'HistoryController@add');
    Route::any('del', 'HistoryController@del');
    Route::any('batchdel', 'HistoryController@batchdel');
    Route::any('search', 'HistoryController@search');
    Route::any('update', 'HistoryController@update');
    Route::any('create', 'HistoryController@create');
    Route::any('info', 'HistoryController@info');
    // Route::get('get', 'HistoryController@get');
    // Route::gets('gets', 'HistoryController@gets');
});

Route::group(['prefix' => 'famous', 'middleware' => 'checklogin'], function() {
    Route::any('', 'FamousController@index');
    Route::any('recycle', 'FamousController@recycle');
    Route::any('edit', 'FamousController@edit');
    Route::any('add', 'FamousController@add');
    Route::any('del', 'FamousController@del');
    Route::any('batchdel', 'FamousController@batchdel');
    Route::any('search', 'FamousController@search');
    Route::any('recycleoption', 'FamousController@recycleoption');
    Route::any('update', 'FamousController@update');
    Route::any('create', 'FamousController@create');
    // Route::get('get', 'FamousController@get');
    // Route::gets('gets', 'FamousController@gets');
});

Route::group(['prefix' => 'champion', 'middleware' => 'checklogin'], function() {
    Route::get('', 'ChampionController@index');
    Route::get('recycle', 'ChampionController@recycle');
    Route::get('edit', 'ChampionController@edit');
    Route::any('add', 'ChampionController@add');
    Route::any('del', 'ChampionController@del');
    Route::any('batchdel', 'ChampionController@batchdel');
    Route::any('search', 'ChampionController@search');
    Route::any('recycleoption', 'ChampionController@recycleoption');
    Route::any('update', 'ChampionController@update');
    Route::any('create', 'ChampionController@create');
    // Route::get('get', 'ChampionController@get');
    // Route::gets('gets', 'ChampionController@gets');
});

Route::group(['prefix' => 'merit', 'middleware' => 'checklogin'], function() {
    Route::get('', 'MeritController@index');
    Route::get('recycle', 'MeritController@recycle');
    Route::get('edit', 'MeritController@edit');
    Route::any('add', 'MeritController@add');
    Route::any('del', 'MeritController@del');
    Route::any('batchdel', 'MeritController@batchdel');
    Route::any('search', 'MeritController@search');
    Route::any('recycleoption', 'MeritController@recycleoption');
    Route::any('update', 'MeritController@update');
    Route::any('create', 'MeritController@create');
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
    Route::get('createdir', 'ImageController@createdir');
    Route::get('udpatedir', 'ImageController@udpatedir');
    Route::get('uploadfile', 'ImageController@uploadfile');
    Route::get('delfile', 'ImageController@delfile');
    Route::get('video', 'ImageController@video');
    Route::get('deldir', 'ImageController@deldir');
    // Route::get('get', 'ImageController@get');
    // Route::gets('gets', 'ImageController@gets');
});