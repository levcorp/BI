<?php
/////////////////////Facturacion/////////////////////////////////
Route::post('facturacion/get/oportunidades/detalle','Panel\controllerFacturacion@handleGetOporunidadesDetalle');
Route::get('facturacion/get/oportunidades/year/{sector}','Panel\controllerFacturacion@handleGetOportunidadesAños');
Route::get('facturacion/get/oportunidades/meses/{sector}','Panel\controllerFacturacion@handleGetOportunidadesMeses');
Route::post('facturacion/get/oportunidades/all','Panel\controllerFacturacion@handleGetOportunidadesAll');
Route::post('facturacion/get/oportunidades/mes','Panel\controllerFacturacion@handleGetOportunidadesMes');
Route::post('facturacion/get/pedidodetalle','Panel\controllerFacturacion@handleGetPedidoDetalle');
Route::get('facturacion/get/pedidosyear/{sector}','Panel\controllerFacturacion@handleGetYear');
Route::get('facturacion/get/pedidosmes/{sector}','Panel\controllerFacturacion@handleGetMes');
Route::get('facturacion/get/pedidosall/{sector}','Panel\controllerFacturacion@handleGetPedidosAll');
Route::get('facturacion/get/pedidos/{sector}','Panel\controllerFacturacion@handleGetPedidos');
Route::get('facturacion/get/facturacion','Panel\controllerFacturacion@handleGetFacturacion');
/////////////////////OV - PO/////////////////////////////////
Route::get('seguimiento/export/{sucursal}','Panel\controllerSeguimiento@handleExport');
Route::post('seguimiento/get/detalle','Panel\controllerSeguimiento@handleGetDetalle');
Route::get('seguimiento/get/datos/{sucursal}','Panel\controllerSeguimiento@handleGetDatos');
/////////////////////Rendicion Viaticos/////////////////////////////////
Route::post('rendicion/viaticos/get/rendiciones','Panel\controllerRedicionViaticos@handleGetRendiciones');
/////////////////////ALMACEN Usuario/////////////////////////////////
Route::post('almacen/usuario/get/exportList','Panel\controllerAlmacenUsuario@handleExportLista');
Route::post('almacen/usuario/get/checkarticulo','Panel\controllerAlmacenUsuario@handleGetArticulosCheck');
Route::post('almacen/usuario/store/articulo','Panel\controllerAlmacenUsuario@handleStoreArticulos');
Route::post('almacen/usuario/get/articulos','Panel\controllerAlmacenUsuario@handleGetArticulos');
Route::post('almacen/usuario/get/fabricantes','Panel\controllerAlmacenUsuario@handleGetFabricantes');
Route::get('almacen/usuario/get/listas/{usuario_id}','Panel\controllerAlmacenUsuario@handleGetListas');
/////////////////////ALMACEN//////////////////////////////////
Route::post('almacen/export/excel','Panel\controllerAlmacen@handleExportArticulos');
Route::post('almacen/update/asignacion','Panel\controllerAlmacen@handleUpdateAsignacion');
Route::delete('almacen/delete/asignacion/{id}','Panel\controllerAlmacen@handleDeleteAsignacion');
Route::delete('almacen/delete/fabricante/{id}','Panel\controllerAlmacen@handleDeleteFabricante');
Route::get('almacen/get/asignacion/{lista_id}','Panel\controllerAlmacen@handleGetAsignacion');
Route::post('almacen/store/asignacion','Panel\controllerAlmacen@handleStoreAsignacion');
Route::post('almacen/update/lista','Panel\controllerAlmacen@handleUpdateLista');
Route::delete('almacen/delete/lista/{id}','Panel\controllerAlmacen@handleDeleteLista');
Route::post('almacen/store/lista','Panel\controllerAlmacen@handleStoreLista');
Route::post('almacen/get/listas','Panel\controllerAlmacen@handleGetListas');
Route::get('almacen/get/usuarios/{lista_id}','Panel\controllerAlmacen@handleGetUsuarios');
Route::post('almacen/get/editfabricantes','Panel\controllerAlmacen@handleGetEditFabricantes');
Route::post('almacen/get/fabricantes','Panel\controllerAlmacen@handleGetFabricantes');
Route::post('almacen/get/articulos','Panel\controllerAlmacen@handleGetArticulos');
/////////////////////Ubicacion//////////////////////////////////
Route::get('ubicacion/item/mail/{lista_id}','Panel\controllerUbicaciones@handleSend');
Route::get('ubicacion/item/export/{lista_id}','Panel\controllerUbicaciones@handleExport');
Route::post('ubicacion/item/deleteubic','Panel\controllerUbicaciones@handleDeleteUbicacion');
Route::post('ubicacion/item/update','Panel\controllerUbicaciones@handleUpdateUbicacion');
Route::delete('ubicacion/item/delete/{id}','Panel\controllerUbicaciones@handleDeleteItem');
Route::post('ubicacion/item/store','Panel\controllerUbicaciones@handleStoreItem');
Route::post('ubicacion/items','Panel\controllerUbicaciones@listaArticulos');
Route::post('ubicacion/searchcodventa','Panel\controllerUbicaciones@handleSearchCodVenta');
Route::delete('ubicacion/delete/{id}','Panel\controllerUbicaciones@handleDeleteList');
Route::post('ubicacion/chosenull','Panel\controllerUbicaciones@ChoseUbicacionesNull');
Route::post('ubicacion/null','Panel\controllerUbicaciones@UbicacionesNull');
Route::post('ubicacion/store','Panel\controllerUbicaciones@storeList');
Route::post('ubicacion/get','Panel\controllerUbicaciones@getList');
/////////////////////SSL//////////////////////////////////
Route::get('ssl/sistema','Panel\controllerSSL@sistema');
Route::get('ssl/remove','Panel\controllerSSL@remove');
Route::post('ssl/delete','Panel\controllerSSL@delete');
Route::get('ssl/get','Panel\controllerSSL@get');
Route::post('ssl/store','Panel\controllerSSL@store');
/////////////////////APICUESTIONARIORESULTADOS//////////////////////////////////
Route::get('cuestionarios/resultado/pdf/{id}','Panel\controllerCuestionarioResultado@pdf');
Route::post('cuestionarios/resultados/reporte','Panel\controllerCuestionarioResultado@reporte');
Route::post('cuestionarios/resultados/preguntas','Panel\controllerCuestionarioResultado@preguntas');
Route::post('cuestionarios/resultados/cuestionario','Panel\controllerCuestionarioResultado@cuestionario');
Route::get('cuestionarios/resultados/cuestionarios','Panel\controllerCuestionarioResultado@cuestionarios');
/////////////////////APICUESTIONARIOUSER//////////////////////////////////
Route::post('cuestionarios/usuario/listrespuestas','Panel\controllerCuestionarioUser@listRespuestas');
Route::post('cuestionarios/usuario/respuestas','Panel\controllerCuestionarioUser@respuestas');
Route::post('cuestionarios/usuario/ubicacion','Panel\controllerCuestionarioUser@storeUbicacion');
Route::post('cuestionarios/usuario/cuestionarios','Panel\controllerCuestionarioUser@cuestionarios');
Route::post('cuestionarios/usuario/countpreguntas','Panel\controllerCuestionarioUser@countPreguntas');
Route::post('cuestionarios/usuario/preguntas','Panel\controllerCuestionarioUser@preguntas');
Route::post('cuestionarios/usuario/getpreguntas','Panel\controllerCuestionarioUser@preguntasGet');
/////////////////////API//////////////////////////////////
Route::post('grupos/asigdelete','Panel\controllerGrupo@removeAssignment');
Route::post('grupos/asignaciones','Panel\controllerGrupo@assignments');
Route::post('grupos/asignacion','Panel\controllerGrupo@assignment');
Route::get('grupos/usuarios/{id}','Panel\controllerGrupo@usuarios');
Route::resource('grupos','Panel\controllerGrupo')->except(['show']);
/////////////////////CUESTIONARIO//////////////////////////////////
Route::post('cuestionarios/caracteristicascount','Panel\controllerCuestionarios@showCaracteristicasCount');
Route::post('cuestionarios/deletecaracteristicas','Panel\controllerCuestionarios@deleteCaracteristicas');
Route::post('cuestionarios/opciones','Panel\controllerCuestionarios@showOpciones');
Route::post('cuestionarios/caracteristicas','Panel\controllerCuestionarios@showCaracteristicas');
Route::post('cuestionarios/estadochange','Panel\controllerCuestionarios@estadoChange');
Route::post('cuestionarios/grupouser','Panel\controllerCuestionarios@grupoUsers');
Route::post('cuestionarios/assignaciongrupo','Panel\controllerCuestionarios@assignacionGrupo');
Route::post('cuestionarios/toolpregunta','Panel\controllerCuestionarios@toolPregunta');
Route::delete('cuestionarios/preguntadelete/{id}','Panel\controllerCuestionarios@deletePregunta');
Route::post('cuestionarios/preguntas','Panel\controllerCuestionarios@getPreguntas');
Route::post('cuestionarios/changeestado','Panel\controllerCuestionarios@changeEstado');
Route::put('cuestionarios/updatepregunta','Panel\controllerCuestionarios@updatePregunta');
Route::post('cuestionarios/createpregunta','Panel\controllerCuestionarios@createPregunta');
Route::get('cuestionarios/grupos','Panel\controllerCuestionarios@grupos');
Route::post('cuestionarios/get','Panel\controllerCuestionarios@index');
Route::resource('cuestionarios','Panel\controllerCuestionarios')->except('index');
/////////////////////MERCADOS//////////////////////////////////
Route::resource('mercados','Panel\controllerMercado');
/////////////////////ESTADOS//////////////////////////////////
Route::put('estados/accion/edit','Panel\controllerEstadoTareaAccion@updateEstadoAccion');
Route::put('estados/tarea/edit','Panel\controllerEstadoTareaAccion@updateEstadoTarea');
Route::delete('estados/accion/{id}','Panel\controllerEstadoTareaAccion@deleteEstadoAccion');
Route::delete('estados/tarea/{id}','Panel\controllerEstadoTareaAccion@deleteEstadoTarea');
Route::post('estados/tarea','Panel\controllerEstadoTareaAccion@storeEstadoTarea');
Route::post('estados/accion','Panel\controllerEstadoTareaAccion@storeEstadoAccion');
Route::get('estados/tarea','Panel\controllerEstadoTareaAccion@estadoTarea');
Route::get('estados/accion','Panel\controllerEstadoTareaAccion@estadoAccion');
/////////////////////Tareas//////////////////////////////////
Route::post('tareas/data','Panel\controllerTareas@data');
Route::put('tareas/descripcionresultado','Panel\controllerTareas@descripcionResultado');
Route::post('tareas/accion','Panel\controllerTareas@storeAccion');
Route::get('tareas/estadoaccion','Panel\controllerTareas@estadoAccion');
Route::post('tareas/acciones','Panel\controllerTareas@acciones');
Route::post('tareas/asignacionestadotarea','Panel\controllerTareas@asignacionEstadoTarea');
Route::get('tareas/estadotarea','Panel\controllerTareas@estadoTarea');
Route::post('tareas/asignacion','Panel\controllerTareas@asignacion');
Route::get('tareas/users','Panel\controllerTareas@users');
Route::post('tareas/clientes','Panel\controllerTareas@clientes');
Route::resource('tareas','Panel\controllerTareas');

/////////////////////Stock//////////////////////////////////
Route::post('stock','Panel\controllerStock@stock');
Route::post('stock/detalle','Panel\controllerStock@stockDetalle');
Route::get('stock/fabricantes','Panel\controllerStock@fabricantes');
Route::resource('sucursales', 'Panel\controllerSucursal')->except(['show','create','edit']);
/////////////////////Proyecto//////////////////////////////////
Route::post('perfiles/userremove', 'Panel\controllerPerfil@userRemove')->name('userRemove');
Route::post('perfiles/useradd', 'Panel\controllerPerfil@userAdd')->name('userAdd');
Route::get('perfiles/useraddlist/{perfil_id}', 'Panel\controllerPerfil@userAddList')->name('userAddList');
Route::get('perfiles/userremovelist/{perfil_id}', 'Panel\controllerPerfil@userRemoveList')->name('userRemoveList');

Route::get('perfiles/remove/{perfil_id}/{modulo_id}', 'Panel\controllerPerfil@remove')->name('perfilremove');
Route::get('perfiles/add/{perfil_id}/{modulo_id}', 'Panel\controllerPerfil@add')->name('perfiladd');
Route::resource('perfiles', 'Panel\controllerPerfil')->except(['create']);
/////////////////////Proyecto//////////////////////////////////
//Route::resource('equipos', 'Panel\Proyecto\controllerEquipo')->except(['show','create','edit']);
/////////////////////Proyecto//////////////////////////////////
Route::resource('proyectos', 'Panel\Proyecto\controllerProyectos')->except(['show','create','edit']);
/////////////////////ROLES//////////////////////////////////
Route::resource('modulos', 'Panel\controllerModulo')->except(['show','create','edit']);
/////////////////////GPOS//////////////////////////////////
//Route::get('gpos/dates','controllerGPOS@dates');
Route::get('gpos/download/{city}/{name}','controllerGPOS@download');
Route::get('gpos/doc/generar/{city}/{start}/{end}','controllerGPOS@gpos');
Route::get('gpos/{city}','controllerGPOS@archivos');
/////////////////////EDI//////////////////////////////////
Route::get('edi/download/{city}/{name}','controllerEDI@download');
Route::get('edi/generar/{city}/{date}','controllerEDI@edis');
Route::get('edi/datos/{city}/{name}','controllerEDI@datos');
Route::get('edi/{city}','controllerEDI@archivos');
//////////////////////////////////////////////////////////////

/////////////////////USUARIOS//////////////////////////////////
Route::post('login/reset','Login\controllerLogin@emailReset');
//////////////////////////////////////////////////////////////

/////////////////////USUARIOS//////////////////////////////////
Route::get('usuarios/change/{gui}', 'Panel\controllerUsuario@change');
Route::get('usuarios/mostrar/{gui}', 'Panel\controllerUsuario@mostrar');
Route::resource('usuarios', 'Panel\controllerUsuario');
///////////////////////////////////////////////////////////////

/////////////////////ARTICULOS ABM/////////////////////////////////////////
Route::post('solicitud/getlist','Panel\controllerABMSolicitud@getListABM');
Route::get('solicitud/fecha','Panel\controllerABMSolicitud@fecha');
Route::get('solicitud/mail/{id}/{fecha}','Panel\controllerABMSolicitud@sendMail');
Route::get('solicitud/{id}/{paginacion}/detalles','Panel\controllerDetalleSolicitud@detalles');
Route::post('solicitud/detalle/items','Panel\controllerDetalleSolicitud@items');
Route::get('solicitud/detalle/codvent','Panel\controllerDetalleSolicitud@codVent');
Route::get('solicitud/detalle/codcomp','Panel\controllerDetalleSolicitud@codComp');
Route::get('solicitud/detalle/datos/{opcion}/{fabricante?}/{especialidad?}/{familia?}','Panel\controllerDetalleSolicitud@datos');
Route::resource('solicitud/detalle','Panel\controllerDetalleSolicitud')->except(['index','create']);
Route::get('solicitud/numero/{id}','Panel\controllerABMSolicitud@numero');
Route::get('solicitud/datos/{paginacion}/{id}/{tipo}','Panel\controllerABMSolicitud@datos');
Route::resource('solicitud','Panel\controllerABMSolicitud')->except(['index','create','edit']);

//new routes ABM
Route::post('solicitud/detalle/cod_venta','Panel\controllerDetalleSolicitud@cVenta');
Route::post('solicitud/detalle/cod_compra','Panel\controllerDetalleSolicitud@cCompra');
Route::post('solicitud/detalle/proveedores','Panel\controllerDetalleSolicitud@proveedores');
Route::post('solicitud/detalle/fabricantes','Panel\controllerDetalleSolicitud@fabricantes');
Route::post('solicitud/detalle/storeitem','Panel\controllerDetalleSolicitud@storeItem');
Route::post('solicitud/detalle/precod','Panel\controllerDetalleSolicitud@preCod');
///////////////////////////////////////////////////////////////
