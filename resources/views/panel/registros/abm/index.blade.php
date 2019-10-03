@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="abm" v-cloak>
  <input type="text" hidden :value="usuario_id={{Auth::user()->id}}">
    @include('panel.registros.abm.list')
    @include('panel.registros.abm.item')
    @include('panel.registros.abm.createList')
    @include('panel.registros.abm.createItem')
</div>
@section('script')
{!!Html::script('js/articulosABM.js')!!}
@endsection
@stop