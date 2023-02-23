<?php
// ******************** Enviar correo ************************************

// envia correo de forma basica sin clase maileable
Route::get('/testmail',['as' => 'testmail.index', 
'uses'=>'testmailController@index']); //Index 

Route::post('/testmail/send1',['as' => 'testmail.send1', 
'uses'=>'testmailController@send1']); //Enviar Correo

// envia correo con clase maileable
Route::get('/testmail2',['as' => 'testmail.index2', 
'uses'=>'testmailController@index2']); //Index 

Route::post('/testmail/send2',['as' => 'testmail.send2', 
'uses'=>'testmailController@send2']); //Enviar Correo


// envia correo con clase maileable y con Markdown
Route::get('/testmail3',['as' => 'testmail.index3', 
'uses'=>'testmailController@index3']); //Index 

Route::post('/testmail/send3',['as' => 'testmail.send3', 
'uses'=>'testmailController@send3']); //Enviar Correo

// envia correo de RECIBO con clase maileable 
Route::get('/testmail4',['as' => 'testmail.index4', 
'uses'=>'testmailController@index4']); //Index 

Route::post('/testmail/send4',['as' => 'testmail.send4', 
'uses'=>'testmailController@send4']); //Enviar Correo

