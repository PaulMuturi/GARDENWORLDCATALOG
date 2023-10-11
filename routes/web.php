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
Route::get('/addproduct', 'App\Http\Controllers\admin\ProductController@create')->name('addProduct');
Route::post('/saveproduct', 'App\Http\Controllers\admin\ProductController@store')->name('saveProduct');
Route::get('editProduct/{id}', 'App\Http\Controllers\admin\ProductController@edit')->name('editProduct');

