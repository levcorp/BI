@extends('layouts.table')
@section('titulo','')
@section('contenido')
<div class="row" id="stock" v-cloak>
  <div class="col-xs-12">
    <div class="box box-info">
       <div class="box-header">
          <h3 class="box-title">Datos de Inventario</h3>
        </div>
        <div class="box-body">
            <div class="text-center"> 
                <el-collapse-transition>
                  <div v-if="show=='desc'">
                    <el-form :inline="true" :model="inputs" :rules="rulesDesc" ref="descForm">
                      <el-form-item>
                        <el-dropdown @command="handleSearchFor">
                          <el-button type="primary" round size="mini">
                            @{{dropdownName}}<i class="el-icon-arrow-down el-icon--right"></i>
                          </el-button>
                          <el-dropdown-menu slot="dropdown">
                            <el-dropdown-item command="cod" icon="el-icon-edit-outline">Codigo Venta</el-dropdown-item>
                            <el-dropdown-item command="fab" icon="el-icon-edit-outline">Fabricante</el-dropdown-item>
                          </el-dropdown-menu>
                        </el-dropdown> 
                      </el-form-item>
                      <el-form-item prop="ItemName">
                          <el-input autofocus type="text" size="mini" placeholder="Descripcion" v-model="inputs.ItemName" @keydown.native.enter.prevent="handleGet('descForm')"></el-input>
                      </el-form-item>
                      <el-form-item>
                          <el-button round type="primary" size="mini" @click="handleGet('descForm')" @keydown.native.enter.prevent="handleGet('descForm')"  icon="el-icon-search"> </el-button>
                      </el-form-item>
                    </el-form>
                  </div>
                </el-collapse-transition>
                <el-collapse-transition>
                  <div v-if="show=='cod'">
                    <el-form :inline="true" :model="inputs" :rules="rulesCod" ref="codForm">
                        <el-form-item>
                            <el-dropdown @command="handleSearchFor">
                              <el-button type="primary" round size="mini">
                                @{{dropdownName}}<i class="el-icon-arrow-down el-icon--right"></i>
                              </el-button>
                              <el-dropdown-menu slot="dropdown">
                                <el-dropdown-item command="desc" icon="el-icon-edit-outline">Descripcion</el-dropdown-item>
                                <el-dropdown-item command="fab" icon="el-icon-edit-outline">Fabricante</el-dropdown-item>
                              </el-dropdown-menu>
                            </el-dropdown> 
                          </el-form-item>
                      <el-form-item prop="U_Cod_Vent">
                          <el-input autofocus type="text" size="mini" placeholder="Codigo de Venta" v-model="inputs.U_Cod_Vent" @keydown.native.enter.prevent="handleGet('codForm')"></el-input>
                      </el-form-item>
                      <el-form-item>
                          <el-button round type="primary" size="mini" @click="handleGet('codForm')" @keydown.native.enter.prevent="handleGet('codForm')" autofocus icon="el-icon-search"> </el-button>
                      </el-form-item>
                    </el-form>
                  </div>
                </el-collapse-transition>
                <el-collapse-transition>
                  <div v-if="show=='fab'">
                    <el-form :inline="true" :model="inputs" :rules="rulesFab" ref="fabForm">
                        <el-form-item>
                            <el-dropdown @command="handleSearchFor">
                              <el-button type="primary" round size="mini">
                                @{{dropdownName}}<i class="el-icon-arrow-down el-icon--right"></i>
                              </el-button>
                              <el-dropdown-menu slot="dropdown">
                                <el-dropdown-item command="desc" icon="el-icon-edit-outline">Descripcion</el-dropdown-item>
                                <el-dropdown-item command="cod" icon="el-icon-edit-outline">Codigo Venta</el-dropdown-item>
                              </el-dropdown-menu>
                            </el-dropdown> 
                          </el-form-item>
                      <el-form-item prop="FirmName">
                          <el-select v-model="inputs.FirmName" filterable placeholder="Selección Fabricante" size="mini">
                            <el-option
                              v-for="item in fabricantes"
                              :key="item.FirmName"
                              :label="item.FirmName"
                              :value="item.FirmName">
                            </el-option>
                          </el-select>
                      </el-form-item>
                      <el-form-item prop="ItemName">
                        <el-input autofocus type="text" size="mini" placeholder="Descripcion" v-model="inputs.ItemName" @keydown.native.enter.prevent="handleGet('fabForm')"></el-input>
                      </el-form-item>
                      <el-form-item>
                          <el-button round type="primary" size="mini" @click="handleGet('fabForm')" @keydown.native.enter.prevent="handleGet('fabForm')" autofocus icon="el-icon-search"></el-button>
                      </el-form-item>
                    </el-form>
                  </div>
                </el-collapse-transition>
              </div>
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