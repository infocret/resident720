<?php

/*
|--------------------------------------------------------------------------
| 				En Relación Cuentas bancarias y chequeras
|--------------------------------------------------------------------------
|				*****************************************************
|--------------------------------------------------------------------------
 */
Route::resource('bankaccounts', 'bankaccountController');

Route::get('/bankacounts/idxb',['as' => 'bankaccounts.indexb', 
'uses'=>'bankaccountController@indexb']); //IndexB 

 //Ruta que guarda cuenta bancaria y chequera desde vista de nuevo proveedor
 Route::post('bankacountspop',['as' => 'bankaccounts.storepop', 
  'uses' => 'bankaccountController@storepop']); //store

Route::resource('checkbooks', 'checkbookController');

//####################################################################################
//
// Route::get('/checkbooks/{inmuid}',['as' => 'checkbooks.index', 
// 'uses'=>'checkbookController@index']); //Index 

// Route::get('/checkbooks/show/{valid}/{inmuid}/',['as' => 'checkbooks.showb', 
// 'uses'=>'checkbookController@showb']); //Show	

Route::get('/checkbooksb/create/{ctaid}/',['as' => 'checkbooks.createb', 
 'uses' => 'checkbookController@createb']); //Create 

Route::post('/checkbooksb/',['as' => 'checkbooks.storeb', 
 'uses' => 'checkbookController@storeb']); //store

Route::get('/checkbooksb/{ctaid}/edit',['as' => 'checkbooks.editb', 
'uses' => 'checkbookController@editb']); //Edit  

Route::patch('/checkbooksb/{ctaid}/',['as' => 'checkbooks.updateb', 
'uses' => 'checkbookController@updateb']); //Update

Route::delete('/checkbooksb/{ctaid}',['as' => 'checkbooks.destroyb', 
'uses' => 'checkbookController@destroyb']); //Destroy 
//
//####################################################################################