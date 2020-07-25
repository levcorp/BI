@component('mail::message')
<h1 style="position: absolute; text-align: center">
    <strong>
      Rendicion Solicitud de Fondos
    </strong>
</h1>
## Estimados
La rendicion de la solicitud Nº {{$solicitud_id}} fue enviada por <strong>{{$solicitante}}</strong>

<div style="position: absolute; text-align: center;">
    <span style="color: darkgray; font-size: 12px;">
      Este mensaje fue enviado automaticamente, no es necesario que responda.
    </span>
</div>
@endcomponent
