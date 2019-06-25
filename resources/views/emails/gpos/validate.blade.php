@component('mail::message')
    <h1 style="position: absolute; text-align: center">
        <strong>
            Validación de GPOS
        </strong>
    </h1>
<strong>
    Articulos que no cuentan con UPC
</strong>
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
<ul>
    <li><p>
    No existen articulos sin UPC.    
    </p></li>
</ul>
@endif
<br>
<strong>
    Facturas que no cuentan con Fecha de Orden de Compra.
</strong>
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
<ul>
    <li>
        <p>
            No existen facturas sin Fecha de Orden de Compra
        </p>
    </li>
</ul>
@endif
<br>
<strong>
    Articulos que no cuentan con lista de precio
</strong>
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
<ul>
    <li>
        <p>
            No existen articulos sin Precio
        </p>
    </li>
</ul>
@endif
<br>
<strong>
    Facturas de anticipo donde el campo TrackNo es vacio
</strong>
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
<ul>
    <li>
        <p>
            No existen Facturas donde el campo TrackNo es vacio
        </p>
    </li>
</ul>
@endif
<br>
<div style="position: absolute; text-align: center;">
    <span style="color: darkgray; font-size: 10px;">
            Este mensaje fue enviado automaticamente, no es necesario que responda.
    </span>
</div>
@endcomponent   




