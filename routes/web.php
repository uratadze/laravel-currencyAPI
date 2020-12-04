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

Route::redirect('/home', '/');

//Show currency list.
Route::get('/', 'DashboardController@index')
    ->name('dashboard');

//User property.
Route::middleware('auth')->group(function () {

    Route::get('/token', 'UserController@token')
        ->name('token');

    Route::post('/logout', 'UserController@logout')
        ->name('logout');
        
});

//Guest property.
Route::middleware("guest")->group(function () {

    Route::get('/login', 'UserController@loginForm')
        ->name('login');

    Route::post('/login', 'UserController@login')
        ->name('login.submit');

    Route::get('/register', 'UserController@registerForm')
        ->name('register.form');

    Route::post('/register', 'UserController@register')
        ->name('register.submit');

});

