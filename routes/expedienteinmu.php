<?php

// *******************************************************************************
// ****************        EXPEDIENTE INMUEBLE              **********************
 // ******************************************************************************
 Route::get('/propertyexp/{property}',['as' => 'propertyexp.index', 
'uses'=>'inmuebleexpController@propertyexpindex']); //Index 

Route::get('/propexpclose',['as' => 'propertyexp.close', 
'uses'=>'inmuebleexpController@propertyexpclose']); //Close - Cierra expediente	
// *******************************************************************************
// ****************        EXPEDIENTE Condominio           **********************
// ******************************************************************************
Route::get('/expcondominio/{property}',['as' => 'expcondominio.index', 
'uses'=>'expcondominioController@expcondominio']); //Index 

Route::get('/expcondclose',['as' => 'expcondominio.close', 
'uses'=>'expcondominioController@expcondclose']); //Close - Cierra expediente	

// *******************************************************************************
// ****************            Subir imagen inmueble        **********************
// *******************************************************************************
Route::get('/addimginmu/{propertyid}',['as' => 'imginmu.add', 
'uses'=>'inmuebleexpController@uploadForm']);				//Lanza la vista

Route::post('/uploadimginmu',['as' => 'imginmu.upload', 
'uses'=>'inmuebleexpController@uploadImgid']); //Subir los Archivos

Route::post('/upstoreinmu',['as' => 'imginmu.storeupload', 
'uses' => 'inmuebleexpController@storeupload']); //Store en DB

Route::get('/delimginmu/{filename}',['as' => 'imginmu.delimgid', 
'uses' => 'inmuebleexpController@delfileimgid']); //Delete File

Route::get('/showimginmu/{propertyid}',['as' => 'imginmu.showimgids', 
'uses'=>'inmuebleexpController@showimgids']);	//Lanza la vista para seleccionar imagenes

Route::get('/selimginmu/{imgid}',['as' => 'imginmu.selimgids', 
'uses'=>'inmuebleexpController@selimgids']);	//Cambia la imagende perfil

// *******************************************************************************
//**********************      Unidades de CONDOMINIO      ************************
//// *****************************************************************************
// MAntenimiento de inmueble tipo departamentos y relacionarlos a un inmueble tipo condominio
// Route::resource('unidades', 'condominioController'); 

Route::get('/unidades/',['as' => 'unidades.index', 
'uses'=>'expcondominioController@unidadesindex']); //Index 	- Lista de unidades en exp condominio

Route::get('/unidades/create/',['as' => 'unidades.create', 
'uses' => 'expcondominioController@unidadcreate']); //Create  - Se usa en expediente condominio

Route::post('/unidades',['as' => 'unidades.store', 
'uses' => 'expcondominioController@unidadstore']); //Store 	- Se usa en expediente condominio


// Route::get('/unidades/show/{id}',['as' => 'unidades.show', 
// 'uses'=>'expcondominioController@unidadshow']); //Show			Metodo NO existe!		


Route::get('/unidades/{id}/edit',['as' => 'unidades.edit', 
'uses' => 'expcondominioController@unidadedit']); //Edit  		

Route::patch('/unidades/{id}',['as' => 'unidades.update', 
'uses' => 'expcondominioController@unidadupdate']); //Update 	

// Route::delete('/unidades/{id}',['as' => 'unidades.destroy', 
// 'uses' => 'expcondominioController@unidaddestroy']); //Destroy Metodo NO existe!

//*********************************************************************************
// *************** importar datos de unidades desde archivo de excell *************
//*********************************************************************************
Route::get('unidimport',['as' => 'unidimport.index', 
'uses'=>'unidimportController@selfile']); //Index 

Route::post('/unidimport/upl',['as' => 'unidimport.upload', 
'uses'=>'unidimportController@upfile']); //Subir los Archivos



//*********************************************************************************
// ************** Medios de Contacto de un INMUEBLE  ******************************
//********************************************************************************* 
Route::get('/inmumediosexp/{inmuid}',['as' => 'inmumediosexp.index', 
'uses'=>'InmuebleMedioexpController@inmumediosindex']); //Index 	

Route::get('/inmumediosexp/show/{id}/{inmuid}',['as' => 'inmumediosexp.show', 
'uses'=>'InmuebleMedioexpController@inmumediosshow']); //Show	

Route::get('/inmumediosexp/{inmuid}/create/',['as' => 'inmumediosexp.create', 
'uses' => 'InmuebleMedioexpController@inmumedioscreate']); //Create 

Route::post('/inmumediosexp',['as' => 'inmumediosexp.store', 
'uses' => 'InmuebleMedioexpController@inmumediostore']); //Store 

Route::get('/inmumediosexp/{id}/{inmuid}/edit',['as' => 'inmumediosexp.edit', 
'uses' => 'InmuebleMedioexpController@inmumediosedit']); //Edit  {personaid}/

Route::patch('/inmumediosexp/{id}',['as' => 'inmumediosexp.update', 
'uses' => 'InmuebleMedioexpController@inmumediosupdate']); //Update

Route::delete('/inmumediosexp/{id}/{inmuid}',['as' => 'inmumediosexp.destroy', 
'uses' => 'InmuebleMedioexpController@inmumediodestroy']); //Destroy 

//*********************************************************************************
// **************       Ubicaciones de Inmueble      ******************************
 //********************************************************************************
Route::get('/inmubicaciones/{inmuid}',['as' => 'inmubicaciones.index', 
'uses'=>'InmuebleDirexpController@inmubicacionesindex']); //Index 

Route::get('/inmubicaciones/show/{id}/{inmuid}',['as' => 'inmubicaciones.show', 
'uses'=>'InmuebleDirexpController@inmubicacionesshow']); //Show		

Route::get('/inmubicaciones/{inmuid}/create/',['as' => 'inmubicaciones.create', 
'uses' => 'InmuebleDirexpController@inmubicacionescreate']); //Create 
// llamada desde js dropdown
Route::get('/paises/{continente}','countriesController@getpaises');//select

Route::post('/inmubicaciones',['as' => 'inmubicaciones.store', 
'uses' => 'InmuebleDirexpController@inmubicacionesstore']); //Store 

Route::get('/inmubicaciones/{id}/{inmuid}/edit',['as' => 'inmubicaciones.edit', 
'uses' => 'InmuebleDirexpController@personaubicacionesedit']); //Edit  {personaid}/

Route::patch('/inmubicaciones/{id}',['as' => 'inmubicaciones.update', 
'uses' => 'InmuebleDirexpController@inmubicacionesupdate']); //Update

Route::delete('/inmubicaciones/{id}/{inmuid}',['as' => 'inmubicaciones.destroy', 
'uses' => 'InmuebleDirexpController@inmubicacionesdestroy']); //Destroy 

Route::get('/inmubicaciones/pdfshow/{id}',['as' => 'inmubicaciones.pdfshow',  
'uses'=>'InmuebleDirexpController@inmubicacionespdfshow']); //Crea PDF de vista Show	

Route::get('/inmubicaciones/{inmuid}/excell',['as' => 'inmubicaciones.excell', 
'uses'=>'InmuebleDirexpController@inmubicacionesexcell']); //Exporta a Excell 

//*****************************************************************************
// ***** Relacionar Persona a Inmuebles desde Expediente de Inmueble  ********* 
//*****************************************************************************
Route::get('/relinmp/{inmuid}',['as' => 'relinmp.expinmuindex', 
'uses'=>'PersonaInmuebleController@expinmuindex']); //Index lista personas asignadas

Route::get('/relinmpl/{inmuid}',['as' => 'relinmp.frompersonas', 
 'uses' => 'PersonaInmuebleController@frompersonas']); //Index lista Personas disponibles

Route::get('/relinmp/create/{inmuid}/{persid}/{nombre}',['as' => 'relinmp.fromperscreate', 
 'uses' => 'PersonaInmuebleController@fromperscreate']); //Create Nueva relacion desde persona

Route::post('/relinmp',['as' => 'relinmp.fromperstore', 
 'uses' => 'PersonaInmuebleController@fromperstore']); //Guarda relacion desde persona existente

 Route::get('/relinmp/createn/{inmuid}',['as' => 'relinmp.newperson', 
 'uses' => 'PersonaInmuebleController@newperson']); //Create Nueva relacion desde unapersona nueva

Route::post('/relinmpcn/{inmuid}',['as' => 'relinmp.nstore', 
 'uses' => 'PersonaInmuebleController@nstore']); //Guarda relacion desde persona existente

Route::delete('/relinmpd/{relid}/{inmuid}',['as' => 'relinmp.expdestroy', 
 'uses' => 'PersonaInmuebleController@expdestroy']); //Destroy 

Route::get('/relinmpd/{relid}/{inmuid}/edit',['as' => 'relinmpd.expedit', 
'uses' => 'PersonaInmuebleController@expedit']); //Edit  

Route::patch('/relinmpd/{relid}',['as' => 'relinmpd.expupdate', 
'uses' => 'PersonaInmuebleController@expupdate']); //Update

//*****************************************************************************
// ***** Relacionar Areas a Inmuebles desde Expediente de Inmueble  ********* 
//*****************************************************************************
//Route::resource('condomareas', 'condomareasController');

Route::get('/condomareas/{inmuid}',['as' => 'condomareas.index', 
'uses'=>'condomareasController@index']); //Index 

Route::get('/condomareas/show/{areaid}/{inmuid}/',['as' => 'condomareas.show', 
'uses'=>'condomareasController@show']); //Show	

Route::get('/condomareas/create/{inmuid}/',['as' => 'condomareas.create', 
 'uses' => 'condomareasController@create']); //Create 

Route::post('/condomareas',['as' => 'condomareas.store', 
 'uses' => 'condomareasController@store']); //store

Route::get('/condomareas/{areaid}/{inmuid}/edit',['as' => 'condomareas.edit', 
'uses' => 'condomareasController@edit']); //Edit  

Route::patch('/condomareas/{areaid}',['as' => 'condomareas.update', 
'uses' => 'condomareasController@update']); //Update

Route::delete('/condomareas/{areaid}/{inmuid}',['as' => 'condomareas.destroy', 
 'uses' => 'condomareasController@destroy']); //Destroy 
//***************************************************************************************
// ***** Relacionar CUENTAS BANCARIAS a Inmuebles desde Expediente de Inmueble  ********* 
//***************************************************************************************
//

//Para mostrar las descripciones de las cuentas  en el expediente de inmueble
Route::get('/condomaccounts/{inmuid}',['as' => 'condomaccounts.index', 
'uses'=>'condomaccountController@index']); 			//Index	

Route::get('/condomaccounts/show/{relid}/{inmuid}',['as' => 'condomaccounts.show', 
'uses'=>'condomaccountController@show']); 			//Show	

Route::get('/condomaccounts/create/{inmuid}/',['as' => 'condomaccounts.create', 
 'uses' => 'condomaccountController@create']); 		//Create 

Route::post('/condomaccounts',['as' => 'condomaccounts.store', 
 'uses' => 'condomaccountController@store']); 		//store

Route::get('/condomaccounts/{relid}/{inmuid}/edit',['as' => 'condomaccounts.edit', 
'uses' => 'condomaccountController@edit']); 		//Edit  

Route::patch('/condomaccounts/{relid}/{inmuid}',['as' => 'condomaccounts.update', 
'uses' => 'condomaccountController@update']); 		//Update

Route::delete('/condomaccounts/{areaid}',['as' => 'condomaccounts.destroy', 
 'uses' => 'condomaccountController@destroy']); 	//Destroy 

