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
// Route::get('/siswa/login', 'Auth\RegisterSiswaController@showRegisterForm');

Route::get('/', function () {

    return view('welcome');

})->name('welcome');

// Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/siswa/register', 'Auth\RegisterSiswaController@showRegisterForm')->name('registersiswa');
Route::post('/siswa/register', 'Auth\RegisterSiswaController@register');
Route::get('/siswa/login', 'Auth\LoginSiswaController@showLoginForm')->name('loginsiswa');
Route::post('/siswa/login', 'Auth\LoginSiswaController@login');
Route::post('logoutsiswa', 'Auth\LoginSiswaController@logout')->name('logoutsiswa');
Route::get('/dashboard', 'HomeController@dashboard');
Route::get('/dashboardsiswa', 'HomeSiswaController@dashboardsiswa');
Route::get('/myProfile', 'HomeController@myprofile');
Route::get('/profile', 'HomeController@profile');
Route::post('/profile/update/{idmentor}', 'HomeController@update');
Route::get('/profilesiswa', 'HomeSiswaController@profilesiswa');
Route::get('/myprofilesiswa', 'HomeSiswaController@myprofilsiswa');
Route::get('/calendarsiswa', 'HomeSiswaController@calendarsiswa');
Route::put('/profilesiswa/update/{idtbSiswa}', 'HomeSiswaController@update');
Route::put('/profile/update/{idmentor}', 'HomeController@update');
Route::get('/states/get/{id}', 'HomeController@getStates');

