<?php
/*
|--------------------------------------------------------------------------
| 	Procedimientos (Store procedures en BD) de aplicacion de movimientos
|--------------------------------------------------------------------------
|				*****************************************************
|--------------------------------------------------------------------------
 */ 

Route::resource('procedmovtos', 'procedmovtoController');

Route::get('/procedmovtos/revisarsp/{procedmovtoid}/{origen}/',['as' => 'procedmovtos.revisarsp', 
 'uses' => 'procedmovtoController@revisarsp']); //Revisar SP a ejecutar

Route::get('/procedmovtos/ejecutasp/{procedmovtoid}/',['as' => 'procedmovtos.ejecutasp', 
 'uses' => 'procedmovtoController@ejecutasp']); //Ejecutar SP

Route::get('/procedmovtos/seldate/{procedmovtoid}/',['as' => 'procedmovtos.seldate', 
 'uses' => 'procedmovtoController@seldate']); //Asignar fecha en vista aparte

Route::post('/procedmovtos/prog/',['as' => 'procedmovtos.programar', 
 'uses' => 'procedmovtoController@programar']); //Editar Programación

// llamada desde js dropdown
Route::get('/procedmovtos/getmovs/{inmuid}/{conceptid}','procedmovtoController@getmovtos');

