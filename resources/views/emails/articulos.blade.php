@component('mail::message')
<h1 style="position: absolute; text-align: center">
    <strong>
        Creación de Articulos ABM
    </strong>
</h1>
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

<div style="position: absolute; text-align: center;">
    <span style="color: darkgray; font-size: 10px;">
            Este mensaje fue enviado automaticamente, no es necesario que responda.
    </span>
</div>
@endcomponent   




