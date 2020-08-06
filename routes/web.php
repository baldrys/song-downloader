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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get("/", "SongDlController@index");

// Route::get('/', 'HomeController@index')->name('home');
// Route::post('prepare', 'DownloaderController@prepare')->name('prepare');
// Route::get('status/{song}', 'DownloaderController@status')->name('status');
// Route::get('download/{song}', 'DownloaderController@download')->name('download');

Route::get('/{any}', 'SpaController@index')->where('any', '.*');
