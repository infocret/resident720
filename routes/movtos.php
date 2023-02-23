<?php
//*************************************************************************
// ***************************************************************************************
/*
|--------------------------------------------------------------------------
| 									En Relación Movimientos
|--------------------------------------------------------------------------
|				*****************************************************
|--------------------------------------------------------------------------
 */ 

Route::resource('inmovtos', 'inmumovimientoController');

Route::resource('movtoheads', 'movtoheadController');

Route::resource('movtodetails', 'movtodetailController');

Route::resource('movtobankaccounts', 'movtobankaccountController');

Route::resource('movdetailapplies', 'movdetailapplieController');

Route::resource('activitytrackings', 'activitytrackingController');

// // Estas rutas estan en Oper originales
//Route::resource('headmovs', 'headmovController');
//Route::resource('detailmovs', 'detailmovController');

