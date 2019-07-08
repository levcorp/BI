@extends('layouts.table')
@section('titulo','')
@section('contenido')
<div class="row" id="stock">
  <div class="col-xs-12">
    <div class="box box-info">
       <div class="box-header">
            <h3 class="box-title">Datos de Inventario</h3>
            <el-form :inline="true" :model="inputs" :rules="rules" ref="inputs" class="demo-form-inline">
            <br>
            <el-form-item prop="U_Cod_Vent">
                 <el-input type="text" placeholder="Codigo de Venta" v-model="inputs.U_Cod_Vent" @keyup.enter="handleGet()"></el-input>
            </el-form-item>
            <el-form-item prop="ItemName">
                 <el-input type="text" placeholder="Descripcion" v-model="inputs.ItemName" @keyup.enter="handleGet()"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="handleGet()" v-on:keyup.enter="handleGet()" autofocus>Buscar</el-button>
            </el-form-item>
            </el-form>
        </div>
        <div class="box-body">
            <el-table :data="items" style="width: 100%" height="400" highlight-current-row :default-sort="{prop: 'id', order: 'descending'}" v-loading="loading">
            <el-table-column align="center" prop="ItemCode" label="#" sortable></el-table-column>
            <el-table-column align="center" prop="ItemName" label="Descripción" sortable></el-table-column>
            <el-table-column align="center" prop="U_Cod_Vent" label="Codigo de Venta" ></el-table-column>
            <el-table-column align="center" label="Acciones">
              <template slot-scope="scope">
                <el-button
                  size="mini"
                  type="primary"
                  icon="el-icon-search"
                  @click="handleShow(scope.$index, scope.row)"
                  circle>
                </el-button>
              </template>
            </el-table-column>
        </el-table>
        </div>
    </div>
  </div>
@include('panel.registros.stock.show')
</div>
@section('script')
{!!Html::script('js/stock.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop