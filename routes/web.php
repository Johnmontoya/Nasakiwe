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

Route::group(['middleware' => ['guest']], function () {
    
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('inicio');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
});

Route::group(['middleware' => ['auth']], function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    /*Usuarios */
    Route::get('showUser', 'UserController@show');
    Route::post('/user/registrar','UserController@store');
    Route::put('/user/actualizar','UserController@update');
    Route::put('/user/desactivar','UserController@desactivar');
    Route::put('/user/activar','UserController@activar');
    
    /*Roles*/
    Route::get('/rol','RolController@index');
    Route::post('/rol/registrar','RolController@store');
    Route::put('/rol/actualizar','RolController@update');
    Route::put('/rol/desactivar','RolController@desactivar');
    Route::put('/rol/activar','RolController@activar');
    Route::get('/rol/selectRol','RolController@selectRol');

});



