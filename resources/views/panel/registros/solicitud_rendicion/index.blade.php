@extends('panel.dashboard.layout')
@section('opciones')
@endsection
@section('body')
<div class="row" id="app" v-cloak>

  <input type="text" v-model="values.sucursal_id='{{Auth::user()->sucursal_id}}'" hidden>
  <input type="text" v-model="values.usuario_id='{{Auth::user()->id}}'" hidden>
  <input type="text" v-model="values.objectguid='{{Auth::user()->objectguid}}'" hidden>
  <input type="text" v-model="values.cuenta='{{Auth::user()->cuenta_bancaria}}'" hidden>
  <div class="col-sm-12" v-if="view.solicitudes">
    @include('panel.registros.solicitud_rendicion.registros')
  </div>
  <div class="col-sm-12" v-if="view.detalle">
    @include('panel.registros.solicitud_rendicion.ciclo')
  </div>
</div>
@section('script')
{!!Html::script('js/solicitud_rendicion.js')!!}
<link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
@endsection
@stop
