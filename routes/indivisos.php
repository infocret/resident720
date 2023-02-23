<?php

//***************************************************************************************
//************************** Establecer indivisos a Inmuebles  **************************** 
//***************************************************************************************
//Route::resource('propertyvalues', 'propertyvalueController');
//inmupropertyvalueController
//
Route::get('/indivisos/{inmuid}/',['as' => 'indivisos.index', 
'uses'=>'inmuindivisoController@index']); //Index 

Route::get('/indivisosu/{inmuid}/',['as' => 'indivisos.uindex', 
'uses'=>'inmuindivisoController@uindex']); //Index 

Route::get('/indivisos/show/{valid}/{inmuid}/',['as' => 'indivisos.show', 
'uses'=>'inmuindivisoController@show']); //Show	

Route::get('/indivisos/create/{inmuid}/',['as' => 'indivisos.create', 
 'uses' => 'inmuindivisoController@create']); //Create 

Route::post('/indivisos',['as' => 'indivisos.store', 
 'uses' => 'inmuindivisoController@store']); //store

Route::get('/indivisos/{valid}/{inmuid}/edit',['as' => 'indivisos.edit', 
'uses' => 'inmuindivisoController@edit']); //Edit  

Route::patch('/indivisos/{valid}/{inmuid}/',['as' => 'indivisos.update', 
'uses' => 'inmuindivisoController@update']); //Update

Route::delete('/indivisos/{valid}/{inmuid}',['as' => 'indivisos.destroy', 
 'uses' => 'inmuindivisoController@destroy']); //Destroy 

//************************************************************ Generar Cuotas ***********************
Route::get('/indivisosc/{inmuid}/',['as' => 'indivisos.cuotasidx', 
'uses'=>'inmuindivisoController@cuotasidx']); //Cuotas index

Route::get('/indivisos/ccreate/{inmuid}/',['as' => 'indivisos.ccreate', 
 'uses' => 'inmuindivisoController@ccreate']); //Cuotas Create 

Route::post('/indivisoscs',['as' => 'indivisos.cstore', 
 'uses' => 'inmuindivisoController@cstore']); //Cuotas store

//***************************************************************************************
//************************** Establecer indivisos a Unidad  **************************** 
//***************************************************************************************
//Route::resource('propertyvalues', 'propertyvalueController');
//inmupropertyvalueController
//
Route::get('/indivisosu/{inmuid}/',['as' => 'indivisosu.index', 
'uses'=>'unidindivisoController@index']); //Index 

Route::get('/indivisosu/show/{valid}/{inmuid}/',['as' => 'indivisosu.show', 
'uses'=>'unidindivisoController@show']); //Show	

Route::get('/indivisosu/create/{inmuid}/',['as' => 'indivisosu.create', 
 'uses' => 'unidindivisoController@create']); //Create 

Route::post('/indivisosu',['as' => 'indivisosu.store', 
 'uses' => 'unidindivisoController@store']); //store

Route::get('/indivisosu/{valid}/{inmuid}/edit',['as' => 'indivisosu.edit', 
'uses' => 'unidindivisoController@edit']); //Edit  

Route::patch('/indivisosu/{valid}/{inmuid}/',['as' => 'indivisosu.update', 
'uses' => 'unidindivisoController@update']); //Update

Route::delete('/indivisos/{valid}/{inmuid}',['as' => 'indivisos.destroy', 
 'uses' => 'unidindivisoController@destroy']); //Destroy 


