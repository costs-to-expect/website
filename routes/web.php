<?php

use App\Http\Controllers\ChildController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SitemapController;

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

Route::get('/', [DashboardController::class, 'index']);

Route::get('/sitemap.xml', [SitemapController::class, 'index']);

Route::get('/jack', [ChildController::class, 'jack']);
Route::get('/niall', [ChildController::class, 'niall']);

Route::get('/{child}/expenses/category/{category_uri}', [ChildController::class, 'category']);
Route::get('/{child}/expenses/category/{category_uri}/subcategory/{subcategory_id}', [ChildController::class, 'subcategory']);
Route::get('/{child}/expenses/year/{year}', [ChildController::class, 'year']);
Route::get('/{child}/expenses/year/{year}/month/{month}', [ChildController::class, 'month']);
Route::get('/{child}/expenses', [ChildController::class, 'expenses']);
Route::post('/{child}/expenses', [ChildController::class, 'setExpensesFilter']);

Route::get('/about', [ContentController::class, 'about']);
Route::get('/what-we-count', [ContentController::class, 'whatWeCount']);
Route::get('/changelog', [ContentController::class, 'changelog']);
Route::get('/privacy-policy', [ContentController::class, 'privacyPolicy']);
