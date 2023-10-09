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

Route::get('/', 'App\Http\Controllers\admin\AdminPagesController@dashboard')->name('dashboard');
Route::get('/addplant', 'App\Http\Controllers\admin\PlantController@create')->name('addPlant');