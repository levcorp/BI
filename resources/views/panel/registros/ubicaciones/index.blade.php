@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app" v-cloak>
    <input type="text" :value="sucursal='{{Auth::user()->sucursal_id}}'" hidden>
    <input type="text" :value="usuario_id='{{Auth::user()->id}}'" hidden>
    @include('panel.registros.ubicaciones.lista')
    @include('panel.registros.ubicaciones.detalle')
    @include('panel.registros.ubicaciones.add')
    @include('panel.registros.ubicaciones.create')
</div>
@section('script')
{!!Html::script('js/ubicaciones.js')!!}
@endsection
@stop