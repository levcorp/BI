@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="perfil">
  <div class="col-xs-12">
    <div class="box box-info">
      <div class="box-header">
          <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <h3 class="box-title">Perfiles Registrados</h3>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <div class="pull-right" style="margin-right: 10px">
                    <el-button
                    size="medium"
                    type="primary"
                    icon="el-icon-plus"
                    plain
                    >Crear Perfil
                    </el-button>
                  </div>
              </div>
          </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <el-table :data="perfiles.filter(data => !search || data.nombre.toLowerCase().includes(search.toLowerCase())|| data.descripcion.toLowerCase().includes(search.toLowerCase()))" style="width: 100%" height="450" >
            <el-table-column align="center" prop="id" label="#" ></el-table-column>
            <el-table-column align="center" prop="nombre" label="Nombre" ></el-table-column>
            <el-table-column align="center" prop="descripcion" label="Apellido" ></el-table-column>
            <!---<el-table-column align="center" prop="memberof[0]" label="Miembro" width="180"></el-table-column>-->
            <el-table-column align="center" label="Operaciones">
              <template slot="header" slot-scope="scope">
                <el-input
                  v-model="search"
                  size="mini"
                  placeholder="Buscar Perfil"/>
              </template>
              <template slot-scope="scope">
                <el-button
                  size="medium"
                  type="primary"
                  icon="el-icon-edit"
                  @click="handleEdit(scope.$index, scope.row)"
                  circle>
                </el-button>
                <el-button
                  size="medium"
                  type="danger"
                  icon="el-icon-delete"
                  @click="handleDelete(scope.$index, scope.row)"
                  circle>
                </el-button>
              </template>
            </el-table-column>
        </el-table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
<!-- /.col -->
@include('panel.registros.perfil.edit')
</div>
@section('script')
{!!Html::script('js/perfil.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop