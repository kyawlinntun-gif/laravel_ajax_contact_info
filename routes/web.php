<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

// Auth route
Auth::routes();


// Contact Routes Support
Route::get('contacts/all', 'ContactController@allContact')->name('contacts.all');

// Contact Routes
Route::resource('contacts', 'ContactController')->except('update', 'destroy');
Route::post('/contacts/{contact}', 'ContactController@update')->name('contacts.update')->where('contact', '[0-9]+');
Route::get('/contacts/delete/{contact}', 'ContactController@destroy')->name('contacts.destroy')->where('contact', '[0-9]+');


