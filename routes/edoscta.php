<?php

//***************************************************************************************
// ************************** Consultar Edos de cuenta General   ***********************
//***************************************************************************************

// *****************   Registro de Pagos   ********************
Route::get('/inmumovtos/pay/{conceptid}/',['as' => 'inmovto.createpay', 
'uses'=>'inmumovtoController@createpay']); //Vista captura pagos

Route::post('/inmumovtos/spay',['as' => 'inmovto.storepay', 
'uses'=>'inmumovtoController@storepay']); //Guarda pago

// *****************   Registro de movtos de cancelaciones   ********************
// Route::get('/inmumovtos/movc/{conceptid}/',['as' => 'inmovto.createmovc', 
// 'uses'=>'inmumovtoController@createmovc']); //Vista popup de cancelacion de cargos

// llamada desde el boton de cancelacion para llenar select
Route::get('/inmumovtos/gmovs/{movtoid}',['as' => 'inmovto.getapmovtos',
'uses'=>'inmumovtoController@getapmovtos']);//llena select

Route::post('/inmumovtos/movc',['as' => 'inmovto.storemovc', 
'uses'=>'inmumovtoController@storemovc']); //Guarda cancelacion de cargos

// llamada desde el boton de reversar cancelacion para llenar campos
Route::get('/inmumovtos/rbackc/{movtoid}/',['as' => 'inmovto.rbackc', 
'uses'=>'inmumovtoController@rbackc']); //Vista para reversar cancelacion

Route::post('/inmumovtos/aplirback',['as' => 'inmovto.aplirback', 
'uses'=>'inmumovtoController@aplirback']); //Aplica el rollback

Route::get('/inmumovtos/rbackcancel/{movtoid}/',['as' => 'inmovto.rbackcancel', 
'uses'=>'inmumovtoController@rbackcancel']); //ejecuta rollback de movimiento de cancelacion

// llamada desde el boton de edicion para llenar select
Route::get('/inmumovtos/gmovsed/{movtoid}',['as' => 'inmovto.getapmovtosed',
'uses'=>'inmumovtoController@getapmovtosed']);//llena select

Route::post('/inmumovtos/apliupdate',['as' => 'inmovto.apliupdate', 
'uses'=>'inmumovtoController@apliupdate']); //Aplica los cambios

//*********************** Cargos **************************************************

Route::get('/periodcharge/{condomid}/',['as' => 'edoscta.selperiod', 
'uses'=>'condominioectaController@selperiod']); //periodo de consulta 

Route::post('/periodsend/',['as' => 'edoscta.sendperiod', 
'uses'=>'condominioectaController@sendperiod']); //Enviar Consulta

Route::get('/edoscta/{condomid}/{dfrom}/{dto}/{cservid}/',['as' => 'edoscta.index', 
'uses'=>'condominioectaController@index']); //Index - todos los cargos todas las unidades

Route::get('/edosctab/{unidid}/{dfrom}/{dto}/{cservid}/',['as' => 'edoscta.indexb', 
'uses'=>'condominioectaController@indexb']); // indexb - cargos de una unidad

Route::get('/edosctad/{chrid}/{dfrom}/{dto}/{cservid}/',['as' => 'edoscta.indexd', 
'uses'=>'condominioectaController@indexd']); //indexd - Vista de movimientos

Route::get('/edosctac/{headid}/',['as' => 'edoscta.indexc', 
'uses'=>'condominioectaController@indexc']); //movtob - Estado de cuenta HTML

Route::get('/recipshowpdf/{headid}/{action}/',['as' => 'edoscta.showpdf', 
'uses'=>'condominioectaController@showpdf']); //Estado de cuenta  PDF 

//Route::get('/recipdwnlpdf/{headid}/',['as' => 'edoscta.dnlwpdf', 
//'uses'=>'condominioectaController@dnlwpdf']); //Descarga de pdf

Route::get('/recipmailpdf/{headid}/',['as' => 'edoscta.mailpdf', 
'uses'=>'condominioectaController@mailpdf']); //emailsend - datos para envio 

Route::post('/sendrecipmail/',['as' => 'edoscta.sendrecipmail', 
'uses'=>'condominioectaController@sendrecipmail']); //Enviar Correo

Route::get('/egresos/{condomid}/',['as' => 'edoscta.egresos', 
'uses'=>'condominioectaController@egresos']); // muestra egresos del condominio


// // ***************** Consulta Pagos  **********************************************
// Route::get('/cpay/',['as' => 'cpay.index', 
// 'uses'=>'condomcpagosController@index']); //Index - todos los pagos todas las unidades

// Route::get('/cpayb/{inmuid}/',['as' => 'cpay.indexb', 
// 'uses'=>'condomcpagosController@indexb']); // indexb - pagos de una unidad

// Route::get('/cpayd/{headid}/{unidid}/',['as' => 'cpay.indexd', 
// 'uses'=>'condomcpagosController@indexd']); //indexd - Vista de pagos de un cargo

Route::get('/receip/{headid}/{movid}/',['as' => 'cpay.receip', 
'uses'=>'condomcpagosController@receip']); // showrecip - Vista del recibo

Route::get('/payshowpdf/{chrid}/{movid}/{action}/',['as' => 'cpay.showpdf', 
'uses'=>'condomcpagosController@showpdf']); //Muestra PDF recibo de pago

Route::get('/recipaymailpdf/{chrid}/{movid}/',['as' => 'cpay.mailpdf', 
'uses'=>'condomcpagosController@mailpdf']); //emailsend - datos para envio 

Route::post('/sendreceipaymail/',['as' => 'cpay.sendrecipmail', 
'uses'=>'condomcpagosController@sendrecipmail']); //Enviar Correo


//******************************************************************************

//Cat Conceptos/Servicios
Route::resource('conceptservices', 'conceptserviceController'); 
//Cat Movimientos y rel a conceptos
Route::resource('catmovtos', 'catmovtoController');				
//Relacion de cuentas a conceptos/servicios
Route::resource('conceptservpropaccounts', 'conceptservpropaccountController');
//Rel unidades a movimientos ( * CONTRATO * )
Route::resource('unidadmovtos', 'unidadmovtoController');
//Registro de cargos por Concepto / Servicio ( Headder)
Route::resource('inmucharges', 'inmuchargeController');
//Registro de movimientos ( Details )
Route::resource('inmumovtos', 'inmumovtoController');

//Importar movimientos
Route::get('movsimport',['as' => 'movsimport.selfile', 
'uses'=>'movtosimportController@selfile']); //Index 

Route::post('/movsimport/upl',['as' => 'movsimport.upload', 
'uses'=>'movtosimportController@upload']); //Subir los Archivos



//Registro de conseumo de GAS
Route::resource('gasconsumptions', 'gasconsumptionController');
 
Route::post('/gasconsumgm/',['as' => 'gasconsum.gmonth', 
'uses'=>'gasconsumptionController@gmonth']); //obtener mes y llamar a consulta

Route::get('/gasconsumsel/{condomid}/{vmonth}/{vyear}',['as' => 'gasconsum.showgas', 
'uses'=>'gasconsumptionController@showgas']); //Index - Lecturas del mes

Route::get('/gasconsum/create/{inmuid}/',['as' => 'gasconsum.gcreate', 
 'uses' => 'gasconsumptionController@gcreate']); //Create 

Route::post('/gasconsumst/',['as' => 'gasconsum.gstore', 
 'uses' => 'gasconsumptionController@gstore']); //store
