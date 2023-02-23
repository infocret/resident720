<?php

// Muestra de codigo de barras
Route::get('barcode',['as' => 'testmail.barcode', 
'uses'=>'testmailController@barcode']); //Index 
