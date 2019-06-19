@component('mail::message')
# Articulos Allen Bradley

Articulos que no cuentan con UPC
@component('mail::table')
| Fecha :      | {{$fecha}} | 
|:-------------:|:-------------:|

@endcomponent
@component('mail::table')
| Item Code  | Cod. Venta | Cod. Comp | ItemName | 
|:----------:|:----------:|:---------:|:--------:|
@foreach($articulos as $a)
|{{$a->ItemCode}}|{{$a->U_Cod_Vent}}|{{$a->U_Cod_comp}}|{{$a->ItemName}}|
@endforeach
@endcomponent

Este es un mensaje fue enviado automaticamente, no es necesario que responda.
@endcomponent   




