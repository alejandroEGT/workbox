<?php 

//use Illuminate\Routing\Route;


  Route::resource('proyecto','proyectoController');
  Route::get('contar_colaborador/{id_proyecto}','ColaboradorController@contar_by_proyecto');
  Route::get('todos_colaboradores/{id_proyecto}','ColaboradorController@todos_colaboradores');
  Route::get('mis_colaboradores/{id_proyecto}','ColaboradorController@mis_colaboradores');
  Route::post('agregar_colaborador','ColaboradorController@agregar_colaboradores');
  Route::resource('tarea','tareaController');
  Route::get('get_tarea/{id_proyecto}','tareaController@traer_tareas_by_proyecto');
  Route::get('get_perfil_tarea/{id_proyecto}/{id_tarea}','tareaController@traer_perfil_tareas_by_proyecto');
  Route::get('estados_tarea','tareaController@estados_tarea');
  Route::post('cambiar_estado_proyecto','proyectoController@cambiar_estado_proyecto');



