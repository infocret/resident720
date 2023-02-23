<?php

/*
|--------------------------------------------------------------------------
| 									En Relación CATALOGOS
|--------------------------------------------------------------------------
|				*****************************************************
|--------------------------------------------------------------------------
 */ 
Route::resource('countries', 'countriesController');

Route::resource('codPos', 'CodPoController');

Route::resource('curpestados', 'curpestadosController');

Route::resource('fileTypes', 'FileTypeController');

Route::resource('measurunits', 'measurunitController');

Route::resource('banks', 'bankController');

Route::resource('banksquares', 'banksquareController');

Route::resource('currencytypes', 'currencytypeController');

Route::resource('parameters', 'parameterController');

// ***************************************************************************************
// ***************************************************************************************
