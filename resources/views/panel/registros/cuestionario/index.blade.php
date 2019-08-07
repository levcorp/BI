@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app">
  <div class="col-xs-12">
    <div class="box box-info">
        <div class="box-header">
          <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <h3 class="box-title">Mercados Registrados</h3>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <div class="pull-right" style="margin-right: 10px">
                    <el-button
                    size="mini"
                    type="primary"
                    icon="el-icon-plus"
                    @click="handleCreate()"
                    >Crear Mercado
                    </el-button>
                  </div>
              </div>
          </div>
        </div>
        <div class="box-body">

        </div>
    </div>
    @include('panel.registros.mercado.create')
    @include('panel.registros.mercado.edit')
  </div>
</div>
@section('script')
{!!Html::script('js/mercado.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop