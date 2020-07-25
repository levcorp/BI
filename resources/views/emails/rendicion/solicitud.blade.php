@component('mail::message')
<h1 style="position: absolute; text-align: center">
    <strong>
      Autorización Solicitud de Fondos
    </strong>
</h1>
## Estimado(a) {{$autorizante}}
Se adjunta la solicitud de fondos realizada por <strong>{{$solicitante}}</strong>

<div style="position: absolute; text-align: center;">
    <span style="color: darkgray; font-size: 12px;">
      Este mensaje fue enviado automaticamente, no es necesario que responda.
    </span>
</div>
@endcomponent
