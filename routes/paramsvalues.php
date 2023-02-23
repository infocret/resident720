<?php

//***************************************************************************************
//************************** Establecer valores a Inmuebles  **************************** 
//***************************************************************************************
//Route::resource('propertyvalues', 'propertyvalueController');
//inmupropertyvalueController
//
Route::get('/ivalues/{inmuid}',['as' => 'ivalues.index', 
'uses'=>'inmupropertyvalueController@index']); //Index 

Route::get('/ivalues/show/{valid}/{inmuid}/',['as' => 'ivalues.show', 
'uses'=>'inmupropertyvalueController@show']); //Show	

Route::get('/ivalues/create/{inmuid}/',['as' => 'ivalues.create', 
 'uses' => 'inmupropertyvalueController@create']); //Create 

Route::post('/ivalues',['as' => 'ivalues.store', 
 'uses' => 'inmupropertyvalueController@store']); //store

Route::get('/ivalues/{valid}/{inmuid}/edit',['as' => 'ivalues.edit', 
'uses' => 'inmupropertyvalueController@edit']); //Edit  

Route::patch('/ivalues/{valid}/{inmuid}/',['as' => 'ivalues.update', 
'uses' => 'inmupropertyvalueController@update']); //Update

Route::delete('/ivalues/{valid}/{inmuid}',['as' => 'ivalues.destroy', 
 'uses' => 'inmupropertyvalueController@destroy']); //Destroy 
//***************************************************************************************
//************************** Establecer propiedades a Inmuebles  **************************** 
//***************************************************************************************
//
Route::get('/pparams/{inmuid}',['as' => 'pparams.index', 
'uses'=>'exppropparameterController@index']); //Index 

Route::get('/pparams/show/{paramid}/{inmuid}/',['as' => 'pparams.show', 
'uses'=>'exppropparameterController@show']); //Show	

Route::get('/pparams/create/{inmuid}/',['as' => 'pparams.create', 
 'uses' => 'exppropparameterController@create']); //Create 

Route::post('/pparams',['as' => 'pparams.store', 
 'uses' => 'exppropparameterController@store']); //store

Route::get('/pparams/{paramid}/{inmuid}/edit',['as' => 'pparams.edit', 
'uses' => 'exppropparameterController@edit']); //Edit  

Route::patch('/pparams/{paramid}/{inmuid}/',['as' => 'pparams.update', 
'uses' => 'exppropparameterController@update']); //Update

Route::delete('/pparams/{paramid}/{inmuid}',['as' => 'pparams.destroy', 
 'uses' => 'exppropparameterController@destroy']); //Destroy 

