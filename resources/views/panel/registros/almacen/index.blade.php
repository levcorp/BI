@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app" v-cloak>
    <input type="text" v-model="values.sucursal_id='{{Auth::user()->sucursal_id}}'" hidden>
    <input type="text" v-model="values.usuario_id='{{Auth::user()->id}}'" hidden>
      <template v-if="show.listas">
        <div class="col-xs-12">
          @include('panel.registros.almacen.lista')
        </div>
      </template>
      <template v-else="show.articulos">
        <div class="col-xs-12" >
          <div class="box box-info">
            <div class="box-header">
              <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                      <p style="font-size: 15px">
                          <el-button @click="handleBackList()" type="primary" size="mini" circle icon="el-icon-arrow-left"></el-button>
                          <strong>&nbsp;&nbsp;Datos de Almacen</strong>
                      </p>
                  </div>
              </div>
            </div>
            <div class="box-body">
              <el-tabs type="card" v-model="active.tab">
                <el-tab-pane label="Articulos">
                  @include('panel.registros.almacen.articulos')
                </el-tab-pane>
                <el-tab-pane label="Asignación">
                  @include('panel.registros.almacen.asignacion')
                </el-tab-pane>
              </el-tabs>
            </div>
          </div>
        </div>
      </template>
</div>
@section('script')
{!!Html::script('js/almacen.js')!!}
@endsection
@stop
