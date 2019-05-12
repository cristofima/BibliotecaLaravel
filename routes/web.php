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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('usuarios', 'UsersController')->middleware('role:admin');
    Route::resource('prestamos', 'LoansController')->middleware('role:admin');
    Route::resource('libros', 'BooksController')->except(['index','show'])->middleware('role:admin');
    Route::get('libros', 'BooksController@index');
    Route::get('libros/{idBook}', 'BooksController@show')->name('libros.show');
    Route::put('libros/giveBack/{idBook}', 'BooksController@giveBack')->middleware('role:admin')->name('libros.giveBack');
});
