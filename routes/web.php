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
Route::any('/getinfo','Testcontroller@getcurl');
Route::any('/sendcode','Testcontroller@sendcode');
Route::any('/login','Logincontroller@register');
Route::any('/do_register','Logincontroller@do_register');
Route::any('/login/login','Logincontroller@login');
Route::any('/login/do_login','Logincontroller@do_login');
