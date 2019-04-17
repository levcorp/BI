@component('mail::message')
# Creación de Articulos ABM

Datos de usuario que realizo el registro:
@component('mail::table')
| Nombre :      | {{$usuario->nombre." ".$usuario->apellido}} | 
|:-------------:|:-------------:|

@endcomponent
@component('mail::table')
| Fabricante  | Proveedor | Especialidad | Familia      | Sub Familia  | Unidad Medida |  Cod. Venta  | Cod. Compra  | Descripcion  |
|:-----------:|:---------:|:------------:|:------------:|:------------:|:-------------:|:------------:|:------------:|:------------:|
@foreach($articulos as $a)
|{{$a->fabricante}}|{{$a->proveedor}}|{{$a->especialidad}}|{{$a->familia == NULL ? "Sin Familia" : $a->familia}}|{{$a->subfamilia == NULL ? "Sin Subfamilia" : $a->subfamilia}}|{{$a->medida}}|{{$a->cod_venta}}|{{$a->cod_compra}}|{{$a->descripcion}}|
@endforeach
@endcomponent

Este es un mensaje fue enviado automaticamente, no es necesario que responda.
@endcomponent   




