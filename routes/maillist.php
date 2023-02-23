<?php

//************************** Establecer Listas de correos a Inmuebles  **************************** 
//***************************************************************************************
//Route::resource('maillists', 'maillistController');
//
//
Route::get('/correolist/{inmuid}',['as' => 'correolist.index', 
'uses'=>'correolistcController@index']); //Index 

Route::get('/correolist/show/{valid}/{inmuid}/',['as' => 'correolist.show', 
'uses'=>'correolistcController@show']); //Show	

Route::get('/correolist/create/{inmuid}/',['as' => 'correolist.create', 
 'uses' => 'correolistcController@create']); //Create 

Route::post('/correolist/',['as' => 'correolist.store', 
 'uses' => 'correolistcController@store']); //store

Route::get('/correolist/{valid}/{inmuid}/edit',['as' => 'correolist.edit', 
'uses' => 'correolistcController@edit']); //Edit  

Route::patch('/correolist/{valid}/{inmuid}/',['as' => 'correolist.update', 
'uses' => 'correolistcController@update']); //Update

Route::delete('/correolist/{valid}/{inmuid}',['as' => 'correolist.destroy', 
 'uses' => 'correolistcController@destroy']); //Destroy 
