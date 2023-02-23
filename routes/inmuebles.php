<?php

/*
|--------------------------------------------------------------------------
| 									En Relación a INMUEBLE 
|--------------------------------------------------------------------------
|				*****************************************************
|--------------------------------------------------------------------------
*/
Route::resource('inmuebles', 'inmuebleController');

//Administración de condominios :P
Route::resource('condominios', 'condominioController');

Route::get('/lcondominios/{inmuid}/',['as' => 'condominios.list', 
'uses'=>'condominioController@list']); //Index 



// importar datos de condominio desde archivo de excell
Route::get('condimport',['as' => 'condimport.index', 
'uses'=>'condomimportController@selfile']); //Index 

Route::post('/condimport/upl',['as' => 'condimport.upload', 
'uses'=>'condomimportController@upfile']); //Subir los Archivos


// ** esta ruta es copia de propertyparameters pero solo se administran indivisos
//Route::resource('indivisos', 'indivisoController');

Route::get('/propareas/{inmueble}','inmumovimientoController@getareas');


//Ruta para select llamada desde js
Route::get('/baccnts/{bank}','bankaccountController@getAccounts');	

//Ruta para select llamada desde  js
Route::get('/bchecks/{account}','checkbookController@getCheckbooks');

Route::resource('propertycontractservices', 'propertycontractserviceController');


// estas rutas esta en oper originales
// Route::resource('relationshipProperties', 'relationshipPropertieController');
//Route::resource('inmuebleImagesids', 'InmuebleImagesidsController');
//Route::resource('inmuebleDirs', 'InmuebleDirController');
//Route::resource('inmuebleMedios', 'InmuebleMedioController');
//Route::resource('propertyareas', 'propertyareasController');
//

// movimientos de inmueble esta ruta esta en movimientos
//Route::resource('inmovtos', 'inmumovimientoController');

// esta ruta esta an parametros
//Route::resource('propertyservices', 'propertyserviceController');

// Esta ruta esta en oper originales
//Route::resource('propertyparameters', 'propertyparameterController');

// Condominios posiblemente debe desaparecer todo esta en expediente inmueble
//Route::resource('condominios', 'condominioController'); 

