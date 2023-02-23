<?php

/*
|--------------------------------------------------------------------------
| 									En Relación INVENTARIOS
|--------------------------------------------------------------------------
|				*****************************************************
|--------------------------------------------------------------------------
 */ 
Route::resource('storages', 'storageController');

Route::resource('articlescategories', 'articlescategorieController');

Route::resource('articles', 'articleController');

Route::resource('stocks', 'stockController');

Route::resource('stockmovements', 'stockmovementController');


