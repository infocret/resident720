<?php 



Route::resource('checkissuances', 'checkissuanceController');

Route::get('/checkissuances/emit/{chargeid}/',
['as' => 'checkissuances.emit', 
'uses'=>'checkissuanceController@emit']); //Vista captura datos de cheque

Route::get('/checkprint/{checkid}/',['as' => 'checkissuances.chprint', 
'uses'=>'checkissuanceController@chprint']); //para imprimir cheque

Route::resource('checkbooktrackings', 'checkbooktrackingController');
Route::resource('checkbookprints', 'checkbookprintController');



