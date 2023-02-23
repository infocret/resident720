<?php

/*
|--------------------------------------------------------------------------
| 				Generador de archivos JSON  
|--------------------------------------------------------------------------
|				*****************************************************
|--------------------------------------------------------------------------
 */
Route::get('/codegenjb',['as' => 'codegenjb.index', 
'uses'=>'codegenjuliobController@codindex']); //Index 

Route::post('/codegenjb/upl',['as' => 'codegenjb.upload', 
'uses'=>'codegenjuliobController@codupload']); //Subir los Archivos

/**************************************************************************/

Route::get('/rootpath',['as' => 'rootpath.index', function () {  // muestra ruta raiz publica
    //return dd(public_path('algo'));
    return dd(public_path());
}]);

Route::get('/storagepath',['as' => 'storagepath.index', function () {  // muestra ruta 
    //return dd(public_path('algo'));
    return dd(storage_path());
}]);

Route::get('/clear_cache',['as' => 'rootpath.clear_cache', function () {
    \Artisan::call('cache:clear');
    return dd("Cache is cleared");
}]);