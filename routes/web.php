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
    return view('home');
});

//another way to return view, first argument is url, second is view name.

//Route::view('contact', 'contact');
Route::view('about', 'about')->middleware('test');

Route::get('contact', 'ContactFormController@create')->name('contact.create');
Route::post('contact', 'ContactFormController@store')->name('contact.store');

// Route::get('customers', 'CustomersController@index');
// Route::post('customers', 'CustomersController@store');
// Route::get('customers/create', 'CustomersController@create');
// Route::get('customers/{customer}', 'CustomersController@show');
// Route::patch('customers/{customer}', 'CustomersController@update');
// Route::get('customers/{customer}/edit', 'CustomersController@edit');
// Route::delete('customers/{customer}', 'CustomersController@destroy');

Route::resource('customers', 'CustomersController'); //->middleware('auth');
Auth::routes();

Route::get('/home', 'HomeController@index');
