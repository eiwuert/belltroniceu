<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// VISTAS
Route::get('', array('middleware' => 'auth','as' => 'simcard', 'uses'=> 'FrontController@home'));
Route::get('/home', array('middleware' => 'auth','as' => 'simcard', 'uses'=> 'FrontController@home'));
Route::get('/simcard', array('middleware' => 'auth','as' => 'simcard', 'uses'=> 'FrontController@simcard'));

// ACCIONES SIMCARD
Route::get('simcard/activar', array('middleware' => 'auth','uses'=> 'SimcardController@activar'));
Route::get('simcard/agregar', array('middleware' => 'auth','uses'=> 'SimcardController@agregar'));
Route::get('simcard/empaquetar', array('middleware' => 'auth','uses'=> 'SimcardController@empaquetar'));
Route::get('simcard/buscar', array('middleware' => 'auth','uses'=> 'SimcardController@buscarSimcard'));
Route::get('simcard/buscarLibre', array('middleware' => 'auth','uses'=> 'SimcardController@buscarSimcardLibre'));
Route::get('simcard/actualizarLibre', array('middleware' => 'auth','uses'=> 'SimcardController@actualizarLibre'));
Route::get('simcard/buscarPaquete', array('middleware' => 'auth','as' => 'buscarPaquete', 'uses'=> 'SimcardController@buscarPaquete'));
Route::get('subdistribuidor/buscarTodos', array('middleware' => 'auth','as' => 'buscarSubdistribuidores', 'uses'=> 'SimcardController@buscarSubdistribuidores'));
// DATOS DIAGRAMAS SIMCARDS
Route::get('diagrama/simcards', array('middleware' => 'auth', 'uses'=> 'SimcardController@datosSimcard'));

// Login routes
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');