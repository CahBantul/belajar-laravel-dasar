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

Route::get('/nozami', fn () => "Hello Nozami");

Route::redirect("/youtube", "/nozami");

Route::fallback(fn () => "404 by Nozami");

Route::view('/hello', "hello", ["name" => "nozami"]);

Route::view('/hello-world', 'hello.world', ["name" => "ajitama"]);