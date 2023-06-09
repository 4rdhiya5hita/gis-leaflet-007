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

use App\Http\Controllers\GuruController;

Route::get('/', 'OutletMapController@index')->name('outlet.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Outlets Routes
Route::get('/our_outlets', 'OutletMapController@index')->name('outlet_map.index');
Route::resource('outlets', 'OutletController');

//Route AJAX
Route::get('siswa/{outlet}/{tahun}', 'OutletController@getSiswaTahun')->name('siswa.tahun');
Route::get('siswa_create/siswa_kelas', 'SiswaController@getSiswaKelas');


// //dipakai
// Route::get('/', 'OutletMapController@index')->name('outlet_map.index');

// // Route::get('/our_outlets', 'OutletMapController@index');
// Route::resource('outlets', 'OutletController');
Route::get('/guru_create/{outlet}', 'GuruController@create')->name('guru.create');
Route::post('/guru_store/{outlet}', 'GuruController@store')->name('guru.store')->middleware('auth');
Route::get('/guru_edit/{outlet}/{id}', 'GuruController@edit')->name('guru.edit');
Route::post('/guru_update/{outlet}/{id}', 'GuruController@update')->name('guru.update')->middleware('auth');
Route::post('/guru_delete/{outlet}/{id}', 'GuruController@delete')->name('guru.delete')->middleware('auth');

Route::get('/siswa_create/{outlet}', 'SiswaController@create')->name('siswa.create');
Route::post('/siswa_store/{outlet}', 'SiswaController@store')->name('siswa.store')->middleware('auth');
Route::get('/siswa_edit/{outlet}/{id}', 'SiswaController@edit')->name('siswa.edit');
Route::post('/siswa_update/{outlet}/{id}', 'SiswaController@update')->name('siswa.update')->middleware('auth');
Route::post('/siswa_delete/{outlet}/{id}', 'SiswaController@delete')->name('siswa.delete')->middleware('auth');

// Route::controller(GuruController::class)->group(function () {
//     Route::get('dataGuru', 'index')->name('dataGuru');
//     Route::get('createGuru', 'create')->name('createGuru');
//     Route::get('storeGuru', 'store')->name('storeGuru');
//     Route::get('detailGuru', 'detail')->name('detailGuru');

//     Route::get('editGuru/{id}', 'edit')->name('editGuru');
//     Route::post('updateGuru/{id}', 'update')->name('updateGuru');
//     Route::post('deleteGuru/{id}', 'delete')->name('deleteGuru');
// });