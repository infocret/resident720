<?php

// ***************************************************************************************
/*
|--------------------------------------------------------------------------
| 									En Relación PARAMETROS
|--------------------------------------------------------------------------
|				*****************************************************
|--------------------------------------------------------------------------
 */ 
Route::resource('inmuebleTipos', 'InmuebleTipoController'); 

Route::resource('locations', 'locationController');

Route::resource('medios', 'medioController');

Route::resource('personaInmuebleReltipos', 'PersonaInmuebleReltipoController');

Route::resource('docTypes', 'DocTypeController');

Route::resource('persInmuReltipoReqDocs', 'PersInmuReltipoReqDocController');

Route::resource('movimientoTipos', 'movimientoTipoController');

Route::resource('provcats', 'provcatsController');
//Ruta que guarda categorias desde vista de nuevo proveedor
Route::post('provcatspop',['as' => 'provcats.storepop', 
 'uses' => 'provcatsController@storepop']); //store
