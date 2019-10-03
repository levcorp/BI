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
| Fabricante  | Proveedor | Especialidad | Unidad Medida |  Cod. Venta  | Cod. Compra  | Descripcion  |      UPC     |
|:-----------:|:---------:|:------------:|:-------------:|:------------:|:------------:|:------------:|:------------:|
@foreach($articulos as $a)
|{{$a->fabricante}}|{{$a->proveedor}}|{{$a->especialidad}}|{{$a->medida}}|{{$a->cod_venta}}|{{$a->cod_compra}}|{{$a->descripcion}}|{{$a->upc==null?'Sin UPC':$a->upc}}|
@endforeach
@endcomponent

<div style="position: absolute; text-align: center;">
    <span style="color: darkgray; font-size: 10px;">
            Este mensaje fue enviado automaticamente, no es necesario que responda.
    </span>
</div>
@endcomponent   




