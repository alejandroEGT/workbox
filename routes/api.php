<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/login', 'AuthController@login');

Route::group(['middleware' => 'jwt.auth'], function(){
  Route::get('auth/user', 'AuthController@user');
  Route::post('auth/logout', 'AuthController@logout');

  Route::resource('proyecto','proyectoController');
  Route::get('contar_colaborador/{id_proyecto}','ColaboradorController@contar_by_proyecto');
  Route::resource('tarea','tareaController');
  Route::get('get_tarea/{id_proyecto}','tareaController@traer_tareas_by_proyecto');
  Route::get('estados_tarea','tareaController@estados_tarea');
});





Route::group(['middleware' => 'jwt.refresh'], function(){
  Route::get('auth/refresh', 'AuthController@refresh');
});