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

Route::get('/prueba', function(){
   return view('welcome'); 
});
// VISTAS
Route::get('', array('middleware' => 'auth', 'uses'=> 'FrontController@home'));
Route::get('/home', array('middleware' => 'auth', 'uses'=> 'FrontController@home'));
Route::get('/simcard', array('middleware' => 'auth','as' => 'simcard', 'uses'=> 'FrontController@simcard'));
Route::get('/settings', array('middleware' => 'auth','uses'=> 'FrontController@settings'));
Route::get('/finanzas', array('middleware' => 'auth','as' => 'finanzas','uses'=> 'FrontController@finanzas'));
Route::get('/recargas', array('middleware' => 'auth','as' => 'recargas','uses'=> 'FrontController@recargas'));
Route::get('/cartera', array('middleware' => 'auth','as' => 'cartera','uses'=> 'FrontController@cartera'));
Route::get('/control_vendedores', array('middleware' => 'auth','uses'=> 'FrontController@control_vendedores'));

// FINANZAS
Route::get('finanzas/datos_subdistribuidor', array('middleware' => 'auth','uses'=> 'FinanzasController@datos_subdistribuidor'));
Route::post('finanzas/agregar', array('middleware' => 'auth','as' => 'agregarComisiones','uses'=> 'FinanzasController@agregar'));

// RECARGAS
Route::get('recargas/simcards', array('middleware' => 'auth','uses'=> 'RecargasController@simcards'));
Route::get('recargas/proyecciones', array('middleware' => 'auth','uses'=> 'RecargasController@proyecciones'));
Route::get('recargas/borrar', array('middleware' => 'auth','uses'=> 'RecargasController@borrar'));
Route::post('recargas/subirArchivo', array('middleware' => 'auth', 'as' => 'agregarRecargas', 'uses'=> 'RecargasController@subirArchivo'));

// ACCIONES SIMCARD
Route::post('simcard/subirArchivo', array('middleware' => 'auth','as' => 'subirArchivoSimcards','uses'=> 'SimcardController@subirArchivo'));
Route::get('simcard/asignarUnidad', array('middleware' => 'auth','uses'=> 'SimcardController@asignarUnidad'));
Route::get('simcard/asignarPaquete', array('middleware' => 'auth','uses'=> 'SimcardController@asignarPaquete'));
Route::get('simcard/empaquetar', array('middleware' => 'auth','uses'=> 'SimcardController@empaquetar'));
Route::get('simcard/buscar', array('middleware' => 'auth','uses'=> 'SimcardController@buscarSimcard'));
Route::get('simcard/buscarLibre', array('middleware' => 'auth','uses'=> 'SimcardController@buscarSimcardLibre'));
Route::get('simcard/actualizarLibre', array('middleware' => 'auth','uses'=> 'SimcardController@actualizarLibre'));
Route::get('simcard/asignaciones', array('middleware' => 'auth','uses'=> 'SimcardController@asignaciones'));
Route::get('simcard/buscarPaquete', array('middleware' => 'auth','as' => 'buscarPaquete', 'uses'=> 'SimcardController@buscarPaquete'));

// ACCIONES USUARIOS
Route::post('user/actualizar', array('middleware' => 'auth','uses'=> 'UserController@actualizar'));
Route::post('user/crear', array('middleware' => 'auth','uses'=> 'UserController@crear'));
Route::get('user/eliminar', array('middleware' => 'auth','uses'=> 'UserController@eliminar'));

// ACCIONES SUBDISTRIBUIDORES
Route::get('subdistribuidor/buscarTodos', array('middleware' => 'auth', 'uses'=> 'SubdistribuidorController@buscarSubdistribuidores'));
Route::get('subdistribuidor/crear', array('middleware' => 'auth','uses'=> 'SubdistribuidorController@crear'));
Route::get('subdistribuidor/eliminar', array('middleware' => 'auth','uses'=> 'SubdistribuidorController@eliminar'));
Route::get('subdistribuidor/actualizar', array('middleware' => 'auth','uses'=> 'SubdistribuidorController@actualizar'));

// DATOS DIAGRAMAS
Route::get('diagrama/simcards', array('middleware' => 'auth', 'uses'=> 'SimcardController@datosSimcard'));
Route::get('diagrama/recargas', array('middleware' => 'auth', 'uses'=> 'RecargasController@datosRecargas'));
Route::get('diagrama/comisiones', array('middleware' => 'auth', 'uses'=> 'FinanzasController@datosComisiones'));
Route::get('diagrama/asignaciones', array('middleware' => 'auth', 'uses'=> 'SimcardController@datosAsignaciones'));

// ACCIONS CARTERA
Route::get('cartera/datos', array('middleware' => 'auth', 'uses'=> 'CarteraController@datos'));
Route::get('cartera/eliminar', array('middleware' => 'auth', 'uses'=> 'CarteraController@eliminar'));
Route::get('cartera/actualizar', array('middleware' => 'auth', 'uses'=> 'CarteraController@actualizar'));
Route::get('cartera/agregar', array('middleware' => 'auth', 'uses'=> 'CarteraController@agregar'));
Route::get('cartera/descargar', array('middleware' => 'auth', 'uses'=> 'CarteraController@descargar'));

// Login routes
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'UserController@postReset');


// CONTROL VENDEDORAS
Route::get('/control', function(){
    return view('controlVendedores');
});

Route::get('control/registroVendedor', 'ControlController@registroVendedor');
Route::get('control/buscar', array('middleware' => 'auth', 'uses'=> 'ControlController@buscar'));
Route::post('control/crearAsesor', array('middleware' => 'auth', 'uses'=> 'ControlController@crearAsesor'));