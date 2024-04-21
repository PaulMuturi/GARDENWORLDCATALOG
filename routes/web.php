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
Route::get('/', 'App\Http\Controllers\admin\DashboardController@dashboard')->name('dashboard');
Route::get('/products', 'App\Http\Controllers\admin\ProductController@index')->name('products');
Route::get('/addproduct', 'App\Http\Controllers\admin\ProductController@create')->name('addProduct');
Route::post('/saveproduct', 'App\Http\Controllers\admin\ProductController@store')->name('saveProduct');
Route::get('editproduct/{id}', 'App\Http\Controllers\admin\ProductController@edit')->name('editProduct');
Route::post('/deleteproduct', 'App\Http\Controllers\admin\ProductController@destroy')->name('deleteProduct');
Route::post('/deleteImg', 'App\Http\Controllers\admin\ProductController@deleteImg')->name('deleteImg');
Route::post('/editCaption', 'App\Http\Controllers\admin\ProductController@editCaption')->name('editCaption');


Route::get('/projects', 'App\Http\Controllers\admin\ProjectController@index')->name('projects');
Route::get('/addproject', 'App\Http\Controllers\admin\ProjectController@create')->name('addProject');
Route::post('/saveproject', 'App\Http\Controllers\admin\ProjectController@store')->name('saveProject');
Route::get('editproject/{id}', 'App\Http\Controllers\admin\ProjectController@edit')->name('editProject');
Route::post('/deleteproject', 'App\Http\Controllers\admin\ProjectController@destroy')->name('deleteProject');

Route::get('/palettes', 'App\Http\Controllers\admin\PaletteController@index')->name('palettes');
Route::get('/addpalette', 'App\Http\Controllers\admin\PaletteController@create')->name('addPalette');
Route::post('/savepalette', 'App\Http\Controllers\admin\PaletteController@store')->name('savePalette');
Route::get('editpalette/{id}', 'App\Http\Controllers\admin\PaletteController@edit')->name('editPalette');
Route::post('/deletepalette', 'App\Http\Controllers\admin\PaletteController@destroy')->name('deletePalette');
Route::post('/addsection', 'App\Http\Controllers\admin\PaletteController@addSection')->name('addSection');
Route::get('/sectionpage/{id}', 'App\Http\Controllers\admin\PaletteController@sectionPage')->name('sectionPage');
Route::post('/savesection', 'App\Http\Controllers\admin\PaletteController@saveSection')->name('saveSection');
Route::get('/editsection/{id}', 'App\Http\Controllers\admin\PaletteController@editSection')->name('editSection');
Route::get('/move_section', 'App\Http\Controllers\admin\PaletteController@moveSectionsToNewTable')->name('moveSection');
Route::post('/savesectionOrder', 'App\Http\Controllers\admin\PaletteController@saveSectionOrder')->name('saveSectionOrder');



//WEB ROUTES
Route::get('/showpalette/{id}', 'App\Http\Controllers\admin\PaletteController@showPalette')->name('showPalette');
Route::get('/copy_category_to_newtable', 'App\Http\Controllers\admin\ProductController@showPalette');
