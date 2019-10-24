@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app" v-cloak>
  <input type="text" v-model="values.sucursal_id='{{Auth::user()->sucursal_id}}'" hidden>
  <input type="text" v-model="values.usuario_id='{{Auth::user()->id}}'" hidden>
  <template v-if="show.listas">
    <div class="col-xs-12">
      @include('panel.registros.almacen.usuario.listas')
    </div>
  </template>
  <template v-if="show.fabricantes">
    <div class="col-xs-12">
      @include('panel.registros.almacen.usuario.fabricantes')
    </div>
  </template>
  <template v-if="show.articulos">
    <div class="col-xs-12">
      @include('panel.registros.almacen.usuario.articulos')
    </div>
  </template>
</div>
@section('script')
{!!Html::script('js/almacenUsuario.js')!!}
@endsection
@stop
