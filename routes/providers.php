<?php

/*
|--------------------------------------------------------------------------
| 				En Relación a Proveedores
|--------------------------------------------------------------------------
|				*****************************************************
|--------------------------------------------------------------------------
 */
Route::resource('providers', 'providersController');

//Esta ruta esta en oper Originales
//Route::resource('categorieProviders', 'categorieProvidersController');

Route::get('/proveedor/{personaid}',['as' => 'proveedor.index', 
'uses'=>'proveedorController@index']); //Index 

Route::get('/proveedorc/',['as' => 'proveedor.create', 
'uses'=>'proveedorController@provcreate']); //create

Route::post('/proveedor',['as' => 'proveedor.store', 
'uses'=>'proveedorController@store']); //store 

Route::get('/proveedor/{id}/edit',['as' => 'proveedor.edit', 
'uses' => 'proveedorController@edit']); //Edit  

Route::get('/proveedor/show/{id}',['as' => 'proveedor.show', 
'uses'=>'proveedorController@show']); //Show	

Route::patch('/proveedor/{id}',['as' => 'proveedor.update', 
'uses' => 'proveedorController@update']); //Update

Route::delete('/proveedor/{id}',['as' => 'proveedor.destroy', 
'uses' => 'proveedorController@destroy']); //Destroy 

Route::resource('provideraccounts', 'provideraccountController');

