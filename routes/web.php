<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/home', 'HomeController@store');

Route::get('/home/{date}', 'HomeController@getWeek');

Route::get('/select', 'HomeController@select');

Route::get('/new', 'HomeController@new');

Route::get('/admin', 'AdminController@index');

Route::get('/admin/change/{id}', 'AdminController@hours');

Route::post('/admin', 'AdminController@change');

Route::get('/timesheet/{id}', 'AdminController@viewUser');

Route::get('/remove/{id}', 'AdminController@remove');