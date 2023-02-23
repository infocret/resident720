<?php
/*
|--------------------------------------------------------------------------
| 									En Relación a anticipos
|--------------------------------------------------------------------------
|				*****************************************************
|--------------------------------------------------------------------------
 */ 

Route::resource('anticipos', 'anticipoController');

// llamada desde el clic de select de unidades en anticipos.js
Route::get('/anticipos/gconcepts/{unididid}',['as' => 'anticipos.gconceptbyunid',
'uses'=>'anticipoController@gconceptbyunid']);//llena select de concept/services

Route::resource('anticiposaplis', 'anticiposapliController');
