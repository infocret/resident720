<?php

// ******************************************************************************
// ****************        EXPEDIENTE Unidad               **********************
// ******************************************************************************
Route::get('/expunidad/{property}',['as' => 'expunidad.index', 
'uses'=>'expunidadController@expunidad']); //Index 

Route::get('/expunidclose',['as' => 'expunidad.close', 
'uses'=>'expunidadController@expunidclose']); //Close - Cierra expediente	

