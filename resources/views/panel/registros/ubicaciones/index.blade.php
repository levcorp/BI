@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app" v-cloak>
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                        <h3 class="box-title">Ubicaciones</h3>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                        <div class="pull-right" style="margin-right: 10px">
                            <el-button size="mini" type="primary" icon="el-icon-plus">Crear Lista</el-button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body">
            
            </div>
        </div>
    </div>
    @include('panel.registros.ubicaciones.create')
</div>
@section('script')
{!!Html::script('js/ubicaciones.js')!!}
@endsection
@stop