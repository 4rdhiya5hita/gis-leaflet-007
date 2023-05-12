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

// use Illuminate\Routing\Route;

Route::get('/', 'OutletMapController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Outlets Routes
Route::get('/our_outlets', 'OutletMapController@index')->name('outlet_map.index');
Route::resource('outlets', 'OutletController');

//Route AJAX
Route::get('siswa/{outlet}/{tahun}', 'OutletController@getSiswaTahun')->name('siswa.tahun');


// //dipakai
// Route::get('/', 'OutletMapController@index')->name('outlet_map.index');

// // Route::get('/our_outlets', 'OutletMapController@index');
// Route::resource('outlets', 'OutletController');