<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|

ES FRONT NO CLIENTE EL SCOPE DEL FRONT
*/




Route::post('estados/index', 'API\EstadoController@index');
Route::get('tipos/index', 'API\TipoController@index');
Route::get('grupos/index', 'API\GrupoController@index');
Route::post('viviendas/index/{page?}', 'API\ViviendaController@index');
Route::get('vivienda/{id?}', 'API\ViviendaController@vivienda');
Route::get('index/inmobiliarias', 'API\InmobiliariaController@index');
Route::get('suscripciones/tarifas','API\SuscripcionController@tarifas');

Route::group(['middleware' => ['guest:api']], function () {
    Route::post('login', 'API\AuthController@login');
    Route::post('register', 'API\AuthController@register');
    Route::post('isAdminGuest', 'API\AuthController@isAdmin');
    Route::get('changePass/{token}', 'API\PasswordResetController@changePass')->name('changePass');

    // Reset password
    Route::post('resetPassword/create', 'API\PasswordResetController@create');
    Route::get('resetPassword/find/{token}', 'API\PasswordResetController@find');
    Route::post('resetPassword/reset', 'API\PasswordResetController@reset')->name('resetPass');
});
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('logout', 'API\AuthController@logout');
    Route::post('isEntidadAuth', 'API\AuthController@isEntidad');
    Route::post('isAdminAuth', 'API\AuthController@isAdmin');
    Route::get('getUser', 'API\AuthController@getUser')->middleware('scope:admin,colaborador');

    //Permisos
    Route::post('permiso/index', 'API\PermisoController@index')->middleware('scope:admin,colaborador');
    Route::post('permiso/list', 'API\PermisoController@list')->middleware('scope:admin,colaborador');
    Route::post('permiso/store', 'API\PermisoController@store')->middleware('scope:admin,colaborador');
    Route::post('permiso/show', 'API\PermisoController@show')->middleware('scope:admin,colaborador');
    Route::post('permiso/update/{id}', 'API\PermisoController@update')->middleware('scope:admin,colaborador');
    Route::post('permiso/destroy/{id}', 'API\PermisoController@destroy')->middleware('scope:admin,colaborador');

    //Usuarios
    Route::post('usuarios/index/{page?}', 'API\UserController@index')->middleware('scope:admin');
    Route::post('usuarios/crear', 'API\UserController@store')->middleware('scope:admin');
    Route::post('usuario/actualizar/{id}', 'API\UserController@update')->middleware('scope:admin');
    Route::post('usuarios/cambiar-password', 'API\UserController@cambiarPassword')->middleware('scope:admin,colaborador');
    Route::post('usuarios/eliminar/{id}', 'API\UserController@eliminarUsuario')->middleware('scope:admin');
    Route::post('usuarios/miPerfil', 'API\UserController@miPerfil')->middleware('scope:admin,colaborador');

    // Inmobiliaria
    Route::post('inmobiliaria/store', 'API\InmobiliariaController@store')->middleware('scope:admin,colaborador');
    Route::post('comprobar/inmobiliaria', 'API\InmobiliariaController@comprobar')->middleware('scope:admin,colaborador');
    Route::post('actualizar/inmobiliaria', 'API\InmobiliariaController@actualizar')->middleware('scope:admin,colaborador');
    Route::post('inmobiliaria/eliminar/{id}', 'API\InmobiliariaController@eliminarInmobiliaria')->middleware('scope:admin');
    Route::post('editar/inmobiliaria/{id}', 'API\InmobiliariaController@editar')->middleware('scope:admin');


    // Estado
    Route::post('estado/store', 'API\EstadoController@store')->middleware('scope:admin');
    Route::post('estados/eliminar/{id}', 'API\EstadoController@eliminarEstado')->middleware('scope:admin');

    // Notificaciones
    Route::post('notificaciones/index','API\NotificacionController@index')->middleware('scope:colaborador');
    

    // Tipo
    Route::post('tipo/store', 'API\TiposController@store')->middleware('scope:admin');
    Route::post('tipo/eliminar/{id}', 'API\TipoController@eliminarTipo')->middleware('scope:admin');

    // Suscripciones
    Route::post('suscripciones/index/{page?}', 'API\SuscripcionController@index')->middleware('scope:admin');
    Route::post('suscripcion/crear','API\SuscripcionController@store')->middleware('scope:admin');
    // Viviendas
    Route::post('viviendas/mis-viviendas/{page?}', 'API\ViviendaController@misViviendas')->middleware('scope:admin,colaborador');
    Route::post('vivienda/store', 'API\ViviendaController@store')->middleware('scope:admin,colaborador');
    Route::post('vivienda/actualizar/{id}', 'API\ViviendaController@update')->middleware('scope:admin,colaborador');
    Route::post('vivienda/eliminar/{id}', 'API\ViviendaController@eliminarVivienda')->middleware('scope:admin,colaborador');

    // Estados
    // ->middleware('scope:admim,colaborador');


    // Tipos
    // Route::post('tipos/index','API\TipoController@index')->middleware('scope:admin,colaborador');

    //Dashboard
    Route::post('dashboard/usuarios', 'API\UserController@usuarios')->middleware('scope:admin');
});
