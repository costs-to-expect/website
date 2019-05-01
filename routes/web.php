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

Route::get('/jack', function () {
    return view('jack');
});

Route::get('/jack/years', function () {
    return view('jack-years');
});

Route::get('/niall', function () {
    return view('niall');
});

Route::get('/niall/years', function () {
    return view('niall-years');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/changelog', function () {
    return view('changelog');
});
