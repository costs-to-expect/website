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

Route::get('/', 'DashboardController@index');

Route::get('/jack', 'ChildController@jack');
Route::get('/niall', 'ChildController@niall');

Route::get('/{child}/expenses/category/{category_uri}', 'ChildController@category');
Route::get('/{child}/expenses/category/{category_uri}/subcategory/{subcategory_id}', 'ChildController@subcategory');
Route::get('/{child}/expenses/year/{year}', 'ChildController@year');
Route::get('/{child}/expenses/year/{year}/month/{month}', 'ChildController@month');
Route::get('/{child}/expenses', 'ChildController@expenses');

Route::get('/about', 'ContentController@about');
Route::get('/what-we-count', 'ContentController@whatWeCount');
Route::get('/changelog', 'ContentController@changelog');
