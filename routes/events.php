<?php

/*
|--------------------------------------------------------------------------
| 									En Relación Eventos
|--------------------------------------------------------------------------
|				*****************************************************
|--------------------------------------------------------------------------
 */ 
Route::resource('events', 'eventController'); // registro de eventos

Route::get('/calendar',['as' => 'event.showcalendar', 
'uses'=>'eventController@showcalendar']); //Muestra demo de calendario

