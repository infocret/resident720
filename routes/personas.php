<?php
// ***************************************************************************************
// 
/*
|--------------------------------------------------------------------------
| 									En Relación a PERSONAS 
|--------------------------------------------------------------------------
|				*****************************************************
|--------------------------------------------------------------------------
 */ 
// Route::resource('personas', 'personaController');

Route::get('/personas/',['as' => 'personas.index', 
'uses'=>'personaController@index']); //Index 	

Route::get('/personas/show/{id}',['as' => 'personas.show', 
'uses'=>'personaController@show']); //Show	

Route::get('/personas/create/',['as' => 'personas.create', 
'uses' => 'personaController@create']); //Create 

Route::post('/personas',['as' => 'personas.store', 
'uses' => 'personaController@store']); //Store 

Route::get('/personas/{id}/{orig}/edit',['as' => 'personas.edit', 
'uses' => 'personaController@edit']); //Edit  {personaid}/

Route::patch('/personas/{id}/{orig}',['as' => 'personas.update', 
'uses' => 'personaController@update']); //Update

Route::delete('/personas/{id}',['as' => 'personas.destroy', 
'uses' => 'personaController@destroy']); //Destroy 


// esta ruta esta en oper originales
//Route::resource('personaDirs', 'PersonaDirController');

// esta ruta esta en oper originales
//Route::resource('medioPersonas', 'MedioPersonaController');

// esta ruta esta en oper originales
//Route::resource('personaImagesids', 'PersonaImagesidsController');

// esta ruta esta en oper originales
//Route::resource('personaDocuments', 'PersonaDocumentController');

// esta ruta esta en oper originales
//Route::get('/proveedor/{personaid}',['as' => 'proveedor.index', 'uses'=>'proveedorController@index']); 

Route::resource('personaccounts', 'personaccountController');

// llamada desde js dropdowndoc
Route::get('/listadoc/{trel}','PersInmuReltipoReqDocController@getTdocs');	


//*****************************************************************************
// ****************            EXPEDIENTE PERSONA        ********************** 
//*****************************************************************************
 Route::get('/personaexp/{personaid}',['as' => 'personaexp.index', 
'uses'=>'personaController@personaexpindex']); //Index 

Route::get('/expclose',['as' => 'personaexp.close', 
'uses'=>'personaController@personaexpclose']); //Close - Cierra expediente	

//*****************************************************************************
// ****************      Subir imagen persona id         **********************
//*****************************************************************************
Route::get('/addimgid/{personaid}',['as' => 'personaImagesids.add', 
'uses'=>'PersonaImagesidsController@uploadForm']);				//Lanza la vista

//'personaController@uploadform'); 
Route::post('/uploadimg',['as' => 'personaImagesids.upload', 
'uses'=>'PersonaImagesidsController@uploadImgid']); //Subir los Archivos

Route::post('/upstore',['as' => 'personaImagesids.storeupload', 
'uses' => 'PersonaImagesidsController@storeupload']); //Store en DB

Route::get('/delimgid/{filename}',['as' => 'personaImagesids.delimgid', 
'uses' => 'PersonaImagesidsController@delfileimgid']); //Delete File

Route::get('/showimgids/{personaid}',['as' => 'personaImagesids.showimgids', 
'uses'=>'PersonaImagesidsController@showimgids']);	//Lanza la vista para seleccionar imagenes

Route::get('/selimgids/{imagenid}',['as' => 'personaImagesids.selimgids', 
'uses'=>'PersonaImagesidsController@selimgids']);	//Cambia la imagende perfil

//*****************************************************************************
// **************     Medios de Contacto de una Persona  **********************
//*****************************************************************************
Route::get('/personamedios/',['as' => 'personamedios.index', 
'uses'=>'MedioPersonaController@personamediosindex']); //Index 	

Route::get('/personamedios/show/{id}',['as' => 'personamedios.show', 
'uses'=>'MedioPersonaController@personamediosshow']); //Show	

Route::get('/personamedios/create/',['as' => 'personamedios.create', 
'uses' => 'MedioPersonaController@personamedioscreate']); //Create 

Route::post('/personamedios',['as' => 'personamedios.store', 
'uses' => 'MedioPersonaController@personamediostore']); //Store 

Route::get('/personamedios/{id}/edit',['as' => 'personamedios.edit', 
'uses' => 'MedioPersonaController@personamediosedit']); //Edit  {personaid}/

Route::patch('/personamedios/{id}',['as' => 'personamedios.update', 
'uses' => 'MedioPersonaController@personamediosupdate']); //Update

Route::delete('/personamedios/{id}',['as' => 'personamedios.destroy', 
'uses' => 'MedioPersonaController@personamediodestroy']); //Destroy 


//*****************************************************************************
// ************** Ubicaciones de una Persona  *********************************
//*****************************************************************************
Route::get('/personaubicaciones/',['as' => 'personaubicaciones.index', 
'uses'=>'PersonaDirController@personaubicacionesindex']); //Index 	

Route::get('/personaubicaciones/excell',['as' => 'personaubicaciones.excell', 
'uses'=>'PersonaDirController@personaubicacionesexcell']); //Exporta a Excell 

Route::get('/personaubicaciones/show/{id}',['as' => 'personaubicaciones.show', 
'uses'=>'PersonaDirController@personaubicacionesshow']); //Show	

Route::get('/personaubicaciones/pdfshow/{id}',['as' => 'personaubicaciones.pdfshow',  
'uses'=>'PersonaDirController@personaubicacionespdfshow']); //Crea PDF de vista Show		

Route::get('/personaubicaciones/create/',['as' => 'personaubicaciones.create', 
'uses' => 'PersonaDirController@personaubicacionescreate']); //Create 
// llamada desde js dropdown
Route::get('/paises/{continente}','countriesController@getpaises');//select

Route::post('/personaubicaciones',['as' => 'personaubicaciones.store', 
'uses' => 'PersonaDirController@personaubicacionestore']); //Store 

Route::get('/personaubicaciones/{id}/edit',['as' => 'personaubicaciones.edit', 
'uses' => 'PersonaDirController@personaubicacionesedit']); //Edit  {personaid}/

Route::patch('/personaubicaciones/{id}',['as' => 'personaubicaciones.update', 
'uses' => 'PersonaDirController@personaubicacionesupdate']); //Update

Route::delete('/personaubicaciones/{id}',['as' => 'personaubicaciones.destroy', 
'uses' => 'PersonaDirController@personaubicacionesdestroy']); //Destroy 

//*****************************************************************************
// ************** Importar Personas   *****************************************
//*****************************************************************************
Route::get('personasimport',['as' => 'personasimport.index', 
'uses'=>'personimportController@selfile']); //Index 

Route::post('/personasimport/upl',['as' => 'personasimport.upload', 
'uses'=>'personimportController@upfile']); //Subir los Archivos

