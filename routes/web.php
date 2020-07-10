<?php

Route::get('prueba','Panel\controllerRendicionFinalizacion@handleGetCuentaContable');
Route::get('prueba2','Panel\controllerRedicionViaticos@pruebaSAP2');

////////////////////////////Solicitud de Rendicion/////////////////////////////////
Route::get('panel/rendicion/solicitud','Panel\controllerPanel@solicitud')->name('solicitudFondos');
Route::get('panel/rendicion/autorizacion','Panel\controllerPanel@autorizacion')->name('solicitudAprobacion');
Route::get('panel/rendicion/tesoreria','Panel\controllerPanel@desembolso');
Route::get('panel/rendicion/finalizada','Panel\controllerPanel@finalizada');
////////////////////////////Socios de Negocio/////////////////////////////////
Route::get('panel/socios','Panel\controllerPanel@socios')->name('sociosNegocio');
////////////////////////////OV-PO/////////////////////////////////
Route::get('panel/facturacion','Panel\controllerPanel@facturacion')->name('facturacion');
////////////////////////////OV-PO/////////////////////////////////
Route::get('panel/seguimiento','Panel\controllerPanel@seguimiento')->name('seguimiento');
////////////////////////////Marcaje/////////////////////////////////

Route::get('panel/registros_usuarios','Panel\controllerPanel@usuarioRegistros')->name('marcaje-usuarios');
////////////////////////////Rendicion Viaticos/////////////////////////////////
//Route::get('panel/rendicion/viaticos','Panel\controllerPanel@rendicionViaticos')->name('rendicionViaticos');
////////////////////////////Facturas/////////////////////////////////
Route::get('panel/facturas','Panel\controllerPanel@facturas')->name('facturas');
////////////////////////////AlmacenUser/////////////////////////////////
Route::get('panel/almacen/usuario','Panel\controllerPanel@almacenUsuario')->name('almacenUser');
////////////////////////////Almacen/////////////////////////////////
Route::get('panel/almacen','Panel\controllerPanel@almacen')->name('almacen');
////////////////////////////ABM/////////////////////////////////
Route::get('panel/articulosabm','Panel\controllerPanel@abm')->name('articulosABM');
////////////////////////////UbicacionesStock/////////////////////////////////
Route::get('panel/ubicaciones','Panel\controllerPanel@ubicaciones')->name('ubicaciones');
////////////////////////////SSL/////////////////////////////////
Route::get('.well-known/acme-challenge/{cod}','Panel\controllerSSL@ssl')->name('ssl');
Route::get('panel/ssl','Panel\controllerPanel@ssl')->name('ssl');
////////////////////////RESULTADOS/////////////////////////////////////
Route::get('panel/cuestionarios/resultado','Panel\controllerPanel@cuestionariosResultado')->name('cuestionariosResultado');
////////////////////////GRUPOS/////////////////////////////////////
Route::get('panel/grupos','Panel\controllerPanel@grupos')->name('grupos');
////////////////////////CUESTIONARIOS/////////////////////////////////////
Route::get('panel/cuestionarios/prueba','Panel\controllerPanel@prueba')->name('prueba');
Route::get('panel/cuestionarios','Panel\controllerPanel@cuestionarios')->name('cuestionarios');
Route::get('panel/cuestionarios/usuario','Panel\controllerPanel@cuestionariosUser')->name('cuestionarioUser');
////////////////////////MERCADO/////////////////////////////////////
Route::get('panel/mercados','Panel\controllerPanel@mercados')->name('mercados');
////////////////////////TAREAS/////////////////////////////////////
Route::get('panel/estados','Panel\controllerPanel@estados')->name('estadosTA');

Route::get('panel/tareas/especialidad','Panel\controllerPanel@tareasEspecialidad')->name('tareasEspecialidad');
Route::get('panel/tareas/sector','Panel\controllerPanel@tareasSector')->name('tareasSector');
Route::get('panel/tareas/cusuario','Panel\controllerPanel@tareasCusuario')->name('tareasCusuario');
Route::get('panel/tareas/usuario','Panel\controllerPanel@tareasUsuario')->name('tareasUsuario');
Route::get('panel/tareas','Panel\controllerPanel@tareas')->name('tareas');
////////////////////////MOBILE/////////////////////////////////////
Route::get('mobile','Mobile\controllerMobile@index')->name('login');
////////////////////////ARTICULOS ABM/////////////////////////////////////
Route::get('panel/solicitud/export','Panel\controllerABMSolicitud@exportCSV')->name('exportCSV');
Route::resource('panel/solicitud/detalle','Panel\controllerDetalleSolicitud')->except(['create','store','edit','update','destroy']);
Route::resource('panel/solicitud','Panel\controllerABMSolicitud')->except(['show','create','store','edit','update','destroy']);
Route::get('panel/stock','Panel\controllerPanel@stock')->name('stock');
////////////////////////PERFIL/////////////////////////////////////+

Route::get('panel/perfiles','Panel\controllerPanel@perfiles')->name('perfiles');
////////////////////////ROLES/////////////////////////////////////+
Route::get('panel/sucursales','Panel\controllerPanel@sucursales')->name('sucursales');

////////////////////////EDI/////////////////////////////////////+
Route::get('panel/gpos/datos','controllerGPOS@datos');
Route::get('panel/gpos','Panel\controllerPanel@gpos')->name('gpos');
////////////////////////EDI/////////////////////////////////////
Route::get('panel/edi','controllerEDI@index')->name('edi');
////////////////////////AUTH/////////////////////////////////////
Route::post('login/reset','Login\controllerLogin@postReset')->name('postReset');
Route::post('login/postchange','Login\controllerLogin@postChange')->name('postChange');
Route::get('login/password/{codigo}','Login\controllerLogin@reset')->name('reset');
Route::get('login/change/{codigo}','Login\controllerLogin@change')->name('change');
Route::post('login','Login\controllerLogin@login')->name('login');
Route::get('logout','Login\controllerLogin@logout')->name('logout');
Route::get('/','Login\controllerLogin@log')->name('log');
////////////////////////USUARIOS/////////////////////////////////////
Route::get('panel/usuarios','Panel\controllerPanel@usuarios')->name('usuarios');
////////////////////////PANEL/////////////////////////////////////
Route::get('panel/{sector}','Panel\controllerPanel@newSector')->name('newfiltroSector');
Route::get('panel','Panel\controllerPanel@newInicio')->name('panel');
Route::get('dashboard','Panel\controllerPanel@inicio')->name('dashboard');
////////////////////////DASHBOARD/////////////////////////////////////
Route::get('panel/dashboard/{sector}','Panel\controllerPanel@sector')->name('filtroSector');
////////////////////////TEST/////////////////////////////////////
Route::get('realizado','Login\controllerLogin@success')->name('success');
//Route::get('mobile','Login\controllerMobile@index')->name('index');

//Route::get('prueba','Panel\controllerDetalleSolicitud@cComp')->name('prueba');
