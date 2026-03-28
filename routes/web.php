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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'App\Http\Controllers\PagesController@index');

Route::get('/site-admin', 'App\Http\Controllers\PagesController@admin');

Route::get('/new', 'App\Http\Controllers\PagesController@new');

Route::get('/sample', 'App\Http\Controllers\PagesController@sample');

Route::post('/site-admin/increment/{id}', 'App\Http\Controllers\PagesController@increment')->name('admin.increment');

Route::get('/vote/{name}C{id}', 'App\Http\Controllers\PagesController@vote');

Route::post('process', 'App\Http\Controllers\PagesController@process')->name('process');

Route::get('callback', 'App\Http\Controllers\PagesController@callback');
