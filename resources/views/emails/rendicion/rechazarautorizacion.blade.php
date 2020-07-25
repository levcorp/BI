@component('mail::message')
<h1 style="position: absolute; text-align: center">
    <strong>
      Rechazo Solicitud de Fondos
    </strong>
</h1>
## Estimado(a) {{$solicitante}}
La solicitud de fondos Nº {{$solicitud_id}} se rechazo por <strong>{{$motivo}}</strong>

<div style="position: absolute; text-align: center;">
    <span style="color: darkgray; font-size: 12px;">
      Este mensaje fue enviado automaticamente, no es necesario que responda.
    </span>
</div>
@endcomponent
