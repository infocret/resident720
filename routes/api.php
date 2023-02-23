<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('inmueble_imagesids', 'InmuebleImagesidsAPIController');















Route::resource('providers', 'providersAPIController');

Route::resource('propertyareas', 'propertyareasAPIController');

Route::resource('provcats', 'provcatsAPIController');

Route::resource('categorie_providers', 'categorieProvidersAPIController');

Route::resource('services', 'serviceAPIController');







Route::resource('movimiento_tipos', 'movimientoTipoAPIController');

Route::resource('headmovs', 'headmovAPIController');

Route::resource('detailmovs', 'detailmovAPIController');

Route::resource('measurunits', 'measurunitAPIController');

Route::resource('banks', 'bankAPIController');

Route::resource('banksquares', 'banksquareAPIController');

Route::resource('bankaccounts', 'bankaccountAPIController');

Route::resource('currencytypes', 'currencytypeAPIController');

Route::resource('checkbooks', 'checkbookAPIController');



Route::resource('personaccounts', 'personaccountAPIController');

Route::resource('provideraccounts', 'provideraccountAPIController');





Route::resource('movtoheads', 'movtoheadAPIController');

Route::resource('movtodetails', 'movtodetailAPIController');

Route::resource('movtobankaccounts', 'movtobankaccountAPIController');

Route::resource('movdetailapplies', 'movdetailapplieAPIController');

Route::resource('activitytrackings', 'activitytrackingAPIController');

Route::resource('tickets', 'ticketAPIController');





Route::resource('statustickets', 'statusticketAPIController');





Route::resource('statusticketimgs', 'statusticketimgAPIController');

Route::resource('storages', 'storageAPIController');

Route::resource('articlescategories', 'articlescategorieAPIController');

Route::resource('articles', 'articleAPIController');

Route::resource('stocks', 'stockAPIController');

Route::resource('stockmovements', 'stockmovementAPIController');



Route::resource('contracts', 'contractAPIController');

Route::resource('propertyservices', 'propertyserviceAPIController');







Route::resource('periods', 'periodAPIController');

Route::resource('propertycontractservices', 'propertycontractserviceAPIController');

Route::resource('perioddates', 'perioddateAPIController');

Route::resource('events', 'eventAPIController');





Route::resource('relationship_properties', 'relationshipPropertieAPIController');









Route::resource('propertyparameters', 'propertyparameterAPIController');

Route::resource('maillists', 'maillistAPIController');

Route::resource('propertyvalues', 'propertyvalueAPIController');

Route::resource('presupuestos', 'presupuestoAPIController');

Route::resource('parameters', 'parameterAPIController');

Route::resource('propaccounts', 'propaccountAPIController');









Route::resource('conceptservices', 'conceptserviceAPIController');

Route::resource('catmovtos', 'catmovtoAPIController');

Route::resource('unidadmovtos', 'unidadmovtoAPIController');

Route::resource('inmucharges', 'inmuchargeAPIController');

Route::resource('inmumovtos', 'inmumovtoAPIController');

Route::resource('gasconsumptions', 'gasconsumptionAPIController');



Route::resource('conceptservpropaccounts', 'conceptservpropaccountAPIController');





Route::resource('checkissuances', 'checkissuanceAPIController');

Route::resource('checkbooktrackings', 'checkbooktrackingAPIController');

Route::resource('checkbookprints', 'checkbookprintAPIController');



Route::resource('procedmovtos', 'procedmovtoAPIController');



Route::resource('anticipos', 'anticipoAPIController');

Route::resource('anticiposaplis', 'anticiposapliAPIController');