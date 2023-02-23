<?php

//****************************************************************************************
// ***** Relacionar Inmuebles a una Persona desde Expediente de Persona  *****************
//****************************************************************************************
 //Route::resource('personaInmuebles', 'PersonaInmuebleController');
Route::get('/relperinmu/{id}',['as' => 'relperinmu.expindex', 
'uses'=>'PersonaInmuebleController@expindex']); //Index lista relaciones 

Route::get('/relperinmuadd/{id}',['as' => 'relperinmuadd.inmuindex', 
'uses'=>'PersonaInmuebleController@expindexadd']); //Index 	para Listar inmuebles

 Route::get('/relperinmu/create/{id}',['as' => 'relperinmu.createp', 
 'uses' => 'PersonaInmuebleController@relperinmucreate']); //Create Nueva relacion

 Route::post('/relperinmu',['as' => 'relperinmu.store', 
 'uses' => 'PersonaInmuebleController@relperinmustore']); //Store 

Route::delete('/relperinmudel/{id}',['as' => 'relperinmu.destroy', 
 'uses' => 'PersonaInmuebleController@relperinmudestroy']); //Destroy 

 Route::get('/relperinmu/show/{id}',['as' => 'relperinmu.show', 
 'uses'=>'PersonaInmuebleController@relperinmushow']); //Show	

 Route::get('/relperinmu/{id}/edit',['as' => 'relperinmu.edit', 
 'uses' => 'PersonaInmuebleController@relperinmuedit']); //Edit  {personaid}/

 Route::patch('/relperinmupd/{id}',['as' => 'relperinmu.update', 
 'uses' => 'PersonaInmuebleController@relperinmuupdate']); //Update