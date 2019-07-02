@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')

<div class="row" id="perfil">
  <div class="col-sm-6 col-xs-12" >
    <div class="box box-info">
      <div class="box-header">
          <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <h3 class="box-title">Perfiles Registrados</h3>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <div class="pull-right" style="margin-right: 10px">
                    <el-button
                    size="mini"
                    type="primary"
                    icon="el-icon-plus"
                    plain
                    @click="handleCreate()"
                    >Crear Perfil
                    </el-button>
                  </div>
              </div>
          </div>
      </div>
      @include('panel.registros.perfil.create')
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <el-table :data="perfiles.filter(data => !search || data.nombre.toLowerCase().includes(search.toLowerCase())|| data.descripcion.toLowerCase().includes(search.toLowerCase()))" style="width: 100%" height="500" highlight-current-row @current-change="handleCurrentChange" :default-sort = "{prop: 'id', order: 'descending'}" v-loading="loadingPerfil">
            <el-table-column align="center" prop="id" width="70" label="#" sortable></el-table-column>
            <el-table-column align="center" prop="nombre" label="Titulo" sortable></el-table-column>
            <el-table-column align="center" prop="descripcion" label="Descripcion" ></el-table-column>
            <el-table-column align="center" label="Operaciones">
              <template slot="header" slot-scope="scope">
                <el-input
                  v-model="search"
                  size="mini"
                  placeholder="Buscar Perfil"/>
              </template>
              <template slot-scope="scope">
                <el-button
                  size="mini"
                  type="warning"
                  icon="el-icon-plus"
                  @click="handleAddModal(scope.$index, scope.row)"
                  circle>
                </el-button>
                <el-button
                  size="mini"
                  type="primary"
                  icon="el-icon-user"
                  @click="handleUserAddModal(scope.$index, scope.row)"
                  circle>
                </el-button>
                <el-button
                  size="mini"
                  type="primary"
                  icon="el-icon-edit"
                  @click="handleEdit(scope.$index, scope.row)"
                  circle>
                </el-button>
              </template>
            </el-table-column>
        </el-table>
      </div>
      <!-- /.box-body -->
    </div>
  @include('panel.registros.perfil.addmodules')
  @include('panel.registros.perfil.edit')  
  @include('panel.registros.perfil.userAdd')  
  </div>
  <div class="col-sm-6 col-xs-12">
    <div class="col-sm-12">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">Modulos Asignados</h3>
        </div>
        <!-- /.box-header -->
          <el-table :data="modulos.filter(data => !Msearch || data.nombre.toLowerCase().includes(Msearch.toLowerCase()))" style="width: 100%" height="250" v-loading="loadingRemove">
              <el-table-column prop="id" label="#" width="50"></el-table-column>
              <el-table-column prop="nombre" label="Titulo"></el-table-column>
              <el-table-column prop="descripcion" label="Descripcion"></el-table-column>
              <el-table-column align="center" label="Operaciones">
                 <template slot="header" slot-scope="scope">
                  <el-input
                    v-model="Msearch"  
                    size="mini"
                    placeholder="Buscar Modulo"/>
                </template>
                <template slot-scope="scope">
                  <el-button
                    size="mini"
                    type="danger"
                    icon="el-icon-close"
                    @click="handleRemove(scope.$index, scope.row)"
                    circle>
                  </el-button>
                </template>
              </el-table-column>
          </el-table> 
        <!-- /.box-body -->
      </div>
    </div>
    <div class="col-sm-12">
        <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">Usuarios Asignados</h3>
        </div>
        <!-- /.box-header -->
          <el-table :data="userRemove.filter(data => !Usearch || data.nombre.toLowerCase().includes(Usearch.toLowerCase())|| data.apellido.toLowerCase().includes(Usearch.toLowerCase()))" style="width: 100%" height="250" v-loading="loadingUserRemove">
              <el-table-column prop="id" label="#" width="50"></el-table-column>
              <el-table-column prop="nombre" label="Nombre"></el-table-column>
              <el-table-column prop="apellido" label="Apellido"></el-table-column>
              <el-table-column align="center" label="Operaciones">
                <template slot="header" slot-scope="scope">
                  <el-input
                    v-model="Usearch"  
                    size="mini"
                    placeholder="Buscar Usuario"/>
                </template>
                <template slot-scope="scope">
                  <el-button
                    size="mini"
                    type="danger"
                    icon="el-icon-close"
                    @click="handleUserRemove(scope.$index, scope.row)"
                    circle>
                  </el-button>
                </template>
              </el-table-column>
          </el-table> 
        <!-- /.box-body -->
      </div>
    </div>
  
    <!-- /.box -->
  </div>

</div>
@section('script')
{!!Html::script('js/perfil.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop