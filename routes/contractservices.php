<?php

/*
|--------------------------------------------------------------------------
| 				En Relación Contratos y servicios
|--------------------------------------------------------------------------
|				*****************************************************
|--------------------------------------------------------------------------
 */
Route::resource('contracts', 'contractController');

Route::resource('services', 'serviceController');

Route::resource('propertyservices', 'propertyserviceController');

