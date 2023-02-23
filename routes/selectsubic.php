
<?php

/*
|--------------------------------------------------------------------------
| 				En Relación Selects dinamicos de Ubicaciones / Direcciones
|--------------------------------------------------------------------------
|				*****************************************************
|--------------------------------------------------------------------------
 */
// Rutas para llenar los selects de ciudad, estado, municipio, asentamienros
// 
Route::get('/ubicaciones', 'LocationController@getUbicaciones');	// no se usa
// llamada desde menu
Route::get('/select', 'CodPoController@getEstados');						

Route::get('/estados/{pais}','CodPoController@getEstados');			// llamada desde js dropdown
Route::get('/ciudades/{estado}','CodPoController@getCiudades');			// llamada desde js dropdown
Route::get('/municipios/{ciudad}','CodPoController@getMunicipios');		// llamada desde js dropdown
Route::get('/asentamientos/{municipio}','CodPoController@getAsentamientos');	// llamada desde js dropdown

