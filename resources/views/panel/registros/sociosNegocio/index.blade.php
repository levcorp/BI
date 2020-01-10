@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app" v-cloak>
    <input type="text" hidden :value="store.usuario_id={{Auth::user()->id}}">
    @include('panel.registros.sociosNegocio.lista')
    @include('panel.registros.sociosNegocio.create')
</div>
@section('script')
{!!Html::script('js/sociosNegocio.js')!!}
@endsection
@stop