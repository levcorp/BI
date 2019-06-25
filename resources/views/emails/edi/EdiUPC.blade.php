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
<div style="position: absolute; text-align: center;">
    <span style="color: darkgray; font-size: 10px;">
        Este mensaje fue enviado automaticamente, no es necesario que responda.
    </span>
</div>
@endcomponent   




