@component('mail::message')
<h1 style="position: absolute; text-align: center">
    <strong>
        Ubicaciones Actualizadas
    </strong>
</h1>
@component('mail::table')
| Realizado por :      | {{$usuario->nombre." ".$usuario->apellido}} | 
|:-------------:|:-------------:|

@endcomponent
<br>
@component('mail::table')
| UBICACION_FISICA | ITEMCODE | COD_VENTA | COD_COMPRA | ALMACEN |
|:----------------:|:--------:|:---------:|:----------:|:-------:|
@foreach($articulos as $a)
|{{$a->UBICACION_FISICA}}|{{$a->ITEMCODE}}|{{$a->COD_VENTA}}|{{$a->COD_COMPRA}}|{{$a->ALMACEN}}|
@endforeach
@endcomponent

<div style="position: absolute; text-align: center;">
    <span style="color: darkgray; font-size: 10px;">
            Este mensaje fue enviado automaticamente, no es necesario que responda.
    </span>
</div>
@endcomponent   




