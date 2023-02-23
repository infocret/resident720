<?php

/*
|--------------------------------------------------------------------------
| 				En Relación operaciones originales
|--------------------------------------------------------------------------
|				*****************************************************
|--------------------------------------------------------------------------
 */
Route::resource('inmuebleImagesids', 'InmuebleImagesidsController');

Route::resource('inmuebleMedios', 'InmuebleMedioController');

Route::resource('inmuebleDirs', 'InmuebleDirController');

Route::resource('propertyparameters', 'propertyparameterController');

Route::resource('relationshipProperties', 'relationshipPropertieController');

Route::resource('propertyareas', 'propertyareasController');

Route::resource('propaccounts', 'propaccountController'); //creada Abril 10 2019

// Esta ruta aparece en el expediente de inmueble y en parametros
//Route::resource('propertycontractservices', 'propertycontractserviceController');
//Route::resource('propertyservices', 'propertyserviceController');


Route::resource('personaInmuebles', 'PersonaInmuebleController');

Route::resource('personaImagesids', 'PersonaImagesidsController');

Route::resource('personaDirs', 'PersonaDirController');

Route::resource('medioPersonas', 'MedioPersonaController');

// Esta ruta aparece en el expediente de persona 
//Route::resource('personaccounts', 'personaccountController');

Route::resource('personaDocuments', 'PersonaDocumentController');

Route::resource('categorieProviders', 'categorieProvidersController');

// Esta ruta aparece en el expediente de proveedor y en parametros
//Route::resource('provideraccounts', 'provideraccountController');

Route::resource('headmovs', 'headmovController');

Route::resource('detailmovs', 'detailmovController');

Route::resource('maillists', 'maillistController');

Route::resource('propertyvalues', 'propertyvalueController');

Route::resource('presupuestos', 'presupuestoController');



