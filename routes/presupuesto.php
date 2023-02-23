<?php

//***************************************************************************************
//************************** Establecer Pesupuesto a Inmuebles (condominio)  **************************** 
//***************************************************************************************
//Route::resource('presupuestos', 'presupuestoController');

Route::get('/presup/{inmuid}/',['as' => 'presup.index', 
'uses'=>'expedpresupuestoController@index']); //Index 

Route::get('/presup/ini/{inmuid}/',['as' => 'presup.inicializa', 
'uses'=>'expedpresupuestoController@inicializa']); //Inicializar

Route::get('/presup/show/{valid}/{inmuid}/',['as' => 'presup.show', 
'uses'=>'expedpresupuestoController@show']); //Show	

Route::get('/presup/create/{inmuid}/',['as' => 'presup.create', 
 'uses' => 'expedpresupuestoController@create']); //Create 

Route::post('/presup/',['as' => 'presup.store', 
 'uses' => 'expedpresupuestoController@store']); //store

Route::get('/presup/{valid}/{inmuid}/edit',['as' => 'presup.edit', 
'uses' => 'expedpresupuestoController@edit']); //Edit  

Route::patch('/presup/{inmuid}/',['as' => 'presup.update', 
'uses' => 'expedpresupuestoController@update']); //Update

Route::delete('/presup/{valid}/{inmuid}',['as' => 'presup.destroy', 
 'uses' => 'expedpresupuestoController@destroy']); //Destroy 
