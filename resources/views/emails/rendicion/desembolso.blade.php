@component('mail::message')
<h1 style="position: absolute; text-align: center">
    <strong>
      Desembolso Solicitud de Fondos
    </strong>
</h1>
## Estimado(a) {{$solicitante}}
La solicitud de fondos Nº {{$solicitud_id}} sera desembolsada el <strong>{{date('Y-m-d', strtotime($fecha))}}</strong>.

<div style="position: absolute; text-align: center;">
    <span style="color: darkgray; font-size: 12px;">
      Este mensaje fue enviado automaticamente, no es necesario que responda.
    </span>
</div>
@endcomponent
