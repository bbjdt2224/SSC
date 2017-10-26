<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/home', 'HomeController@store')->name('home');

Route::get('/home/{date}', 'HomeController@getWeek')->name('date');

Route::get('/select', 'HomeController@select')->name('select');

Route::get('/new', 'HomeController@new')->name('new');

Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/admin/change/{id}', 'AdminController@hours')->name('change');

Route::post('/admin', 'AdminController@change')->name('admin');

Route::get('/timesheet/{id}/{date}', 'AdminController@viewUser')->name('timesheet');

Route::get('/remove/{id}', 'AdminController@remove')->name('remove');

Route::get('/records', function(){
	return view('search');
})->name('records');

Route::post('/search', 'AdminController@getRecords')->name('search');

Route::get('/prevusers', 'AdminController@getPastUsers')->name('prevusers');

Route::get('/restore/{id}', 'AdminController@restorePast')->name('revive');

Route::post('/signature', 'HomeController@saveSignature')->name('signature');

Route::get('/allowEdit/{id}/{date}', 'AdminController@allowEdit')->name('allowEdit');