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

Route::Get("/providers","GifProviderController@getProviders")->name("providers");
Route::Get("/provider/{identifier}/stats","GifProviderController@getStats")->name("providers-stats");
Route::Get("/gif/{keyword}","GifProviderController@keyword")->name("keyword");