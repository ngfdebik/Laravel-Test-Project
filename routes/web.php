<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/persons', 'App\Http\Controllers\PersonsController@index')->name('person.index');

Route::get('/persons/create', 'App\Http\Controllers\PersonsController@create')->name('person.create');

Route::post('/persons', 'App\Http\Controllers\PersonsController@store')->name('person.store');

Route::get('/persons/{person}/edit', 'App\Http\Controllers\PersonsController@edit')->name('person.edit');
Route::patch('/persons/{person}', 'App\Http\Controllers\PersonsController@update')->name('person.update');
Route::delete('/persons/{auto}', 'App\Http\Controllers\PersonsController@destroy')->name('person.delete');

Route::get('/cars', 'App\Http\Controllers\PersonsController@cars')->name('person.cars');



Route::get('/persons/first_or_create', 'App\Http\Controllers\PersonsController@first_or_create');

Route::get('/persons/update_or_create', 'App\Http\Controllers\PersonsController@update_or_create');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
