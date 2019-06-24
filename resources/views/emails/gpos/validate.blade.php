@component('mail::message')
# Validacion de Gpos 
Articulos que no cuentan con UPC
@if($cUPC>0)
@component('mail::table')
| Campo : | U_cat_id | 
|:-------:|:--------:|
@endcomponent
@component('mail::table')
| Doc Num | Item Code | Cod. Venta | Cod. Compra | 
|:------ :|:---------:|:----------:|:-----------:|
@foreach($UPC as $dato )
|{{$dato->DocNum}}|{{$dato->ItemName}}|{{$dato->U_Cod_Vent}}|{{$dato->U_Cod_comp}}|
@endforeach
@endcomponent
@else
<br>
No existen articulos sin UPC
@endif
<br>
Facturas que no cuentan con Fecha de Orden de Compra
@if($cFeOCClie>0)
@component('mail::table')
| Campo : | FeOCClie | 
|:-------:|:--------:|
@endcomponent
@component('mail::table')
| Doc Date | Doc Num | Card Name | 
|:--------:|:--------:|:--------:|
@foreach($FeOCClie as $dato )
|{{$dato->DocDate}}|{{$dato->DocNum}}|{{$dato->CardName}}|
@endforeach
@endcomponent
@else
<br>
No existen facturas sin Fecha de Orden de Compra
@endif
<br>
Articulos que no cuentan con lista de precio
@if($cPrice>0)
@component('mail::table')
| Campo : | Lista de Precios | 
|:-------:|:--------:|
@endcomponent
@component('mail::table')
| Doc Date | Item Code | Item Name | 
|:--------:|:--------:|:--------:|
@foreach($Price as $dato )
|{{$dato->DocDate}}|{{$dato->ItemCode}}|{{$dato->ItemName}}|
@endforeach
@endcomponent
@else
<br>
No existen articulos sin Precio
@endif
<br>
Facturas de anticipo donde el campo TrackNo es vacio
@if($cTrack>0)
@component('mail::table')
| Campo : | TrackNo | 
|:-------:|:--------:|
@endcomponent
@component('mail::table')
| Doc Date | Doc Num | Card Name | 
|:--------:|:--------:|:--------:|
@foreach($Track as $dato )
|{{$dato->DocDate}}|{{$dato->DocNum}}|{{$dato->CardName}}|
@endforeach
@endcomponent
@else
<br>
No existen Facturas donde el campo TrackNo es vacio
@endif
<br>
Este es un mensaje fue enviado automaticamente, no es necesario que responda.
@endcomponent   




