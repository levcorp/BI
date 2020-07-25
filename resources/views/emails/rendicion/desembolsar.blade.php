@component('mail::message')
<h1 style="position: absolute; text-align: center">
    <strong>
      Autorización Solicitud de Fondos
    </strong>
</h1>
## Estimados
La solicitud de fondos Nº {{$solicitud_id}} realizada por <strong>{{$solicitante}}</strong> a sido autorizada por <strong>{{$autorizante}}</strong>

<div style="position: absolute; text-align: center;">
    <span style="color: darkgray; font-size: 12px;">
      Este mensaje fue enviado automaticamente, no es necesario que responda.
    </span>
</div>
@endcomponent
