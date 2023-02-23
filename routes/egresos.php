<?php 


Route::get('/egresos/{condomid}/',['as' => 'edoscta.egresos', 
'uses'=>'condominioectaController@egresos']); // muestra egresos del condominio

Route::get('/egresos/create/{condomid}/',['as' => 'egreso.create', 
'uses'=>'egresoController@create']); // muestra formulario de captura de egreso / gasto

Route::get('/egresos/getareas/{condomid}/',['as' => 'egreso.getareas', 
'uses'=>'egresoController@getareas']); // Consulta areas desde inmuegresos.js

Route::get('/egresos/getconcepts/{condomid}/',['as' => 'egreso.getconcepts', 
'uses'=>'egresoController@getconcepts']); // Consulta conceptos desde inmuegresos.js

Route::get('/egresos/getmovtos/{condomid}/{concepserv}/',['as' => 'egreso.getmovtos', 
'uses'=>'egresoController@getmovtos']); // Consulta movtos en contrato desde inmuegresos.js y desde create

Route::post('/egresos/store',['as' => 'egreso.store', 
'uses' => 'egresoController@store']); //store


/// Edos de cuenta Egresos
Route::get('/egresos/selp/{condomid}/',
	['as' => 'egresos.selperiod', 
'uses'=>'egresoedoctaController@selperiod']); //periodo de consulta 

Route::post('/egresos/sendp/',
 	['as' => 'egresos.sendperiod', 
 	'uses'=>'egresoedoctaController@sendperiod']); //Enviar Consulta

Route::get('/egresos/indexb/{condomid}/{dfrom}/{dto}',
	['as' => 'egresos.indexb', 
	'uses'=>'egresoedoctaController@indexb']); //Realiza consulta nivel 1

Route::get('/egresos/indexc/{chargeid}/',
	['as' => 'egresos.indexc', 
	'uses'=>'egresoedoctaController@indexc']); //Det.de cargo movtos C / A  

Route::get('/egresos/indexd/{chargeid}/',
	['as' => 'egresos.indexd', 
'uses'=>'egresoedoctaController@indexd']); //movtob - Estado de cuenta HTML

//Lista de cheques emitidos a un cargo (inmuchargeid)
Route::get('/egresos/indexch/{condomid}/',
	['as' => 'egresos.indexch', 
	'uses'=>'egresoedoctaController@indexch']); 

Route::get('/egresosshowpdf/{headid}/{action}/',['as' => 'egresos.showpdf', 
'uses'=>'egresoedoctaController@showpdf']); //Estado de cuenta  PDF 

Route::get('/egresosrecipmailpdf/{headid}/',['as' => 'egresos.mailpdf', 
'uses'=>'egresoedoctaController@mailpdf']); //emailsend - datos para envio 

Route::post('/egresossendrecipmail/',['as' => 'egresos.sendrecipmail', 
'uses'=>'egresoedoctaController@sendrecipmail']); //Enviar Correo

