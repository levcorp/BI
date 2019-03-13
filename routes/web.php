<?php
//Autentificacion
Route::get('/','Log\controllerAuth@inicio')->name('inicio');


//Panel
Route::get('panel','Panel\controllerPanel@inicio')->name('panel');
Route::get('panel/dashboard/{sector}','Panel\controllerPanel@sector')->name('filtroSector');
