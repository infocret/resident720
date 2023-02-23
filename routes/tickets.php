<?php
/*
|--------------------------------------------------------------------------
| 									En Relación Tickets
|--------------------------------------------------------------------------
|				*****************************************************
|--------------------------------------------------------------------------
 */ 
Route::resource('tickets', 'ticketController');

Route::resource('statustickets', 'statusticketController');

Route::resource('statusticketimgs', 'statusticketimgController');

