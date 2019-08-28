@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app">
  <div class="col-xs-12" v-cloak>
    <div class="box box-info">
        <transition name="el-fade-in-linear">
        <div class="box-header" v-if="!showPreguntas">
            <h4 ><strong>Buscar Cuestionario</strong></h4>
        </div>
        </transition>
        <div class="box-body">
            <transition name="el-fade-in-linear">
            <div class="text-center" v-if="!showPreguntas">
                <el-form :inline="true" size="mini">
                    <el-form-item>
                        <el-select style="width: 200px;" v-model="cuestionario_id" placeholder="Elija un cuestionario" clearable>
                            <el-option
                                v-for="item in cuestionarios"
                                :key="item.id"
                                :label="item.TITULO"
                                :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item>
                        <transition name="el-fade-in-linear">
                        <el-button v-if="cuestionario_id" type="primary" circle icon="el-icon-search" @click="handleGetPreguntas()"></el-button>
                        </transition>
                    </el-form-item>
                </el-form>
            </div>
            </transition>
            <br>
            <transition name="el-fade-in-linear">
            <div v-loading="loading" v-if="showPreguntas">
                <div class="row">
                    <div class="col-sm-1">
                        <el-button @click="handleBack"  icon="el-icon-back" type="primary" size="mini"></el-button>
                    </div>
                    <div class="col-sm-10">
                        <div class="text-center">
                            <h4><strong>@{{cuestionario.TITULO}}</strong></h4>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <el-button @click="handleReporte" icon="el-icon-document-checked" type="success" size="mini"></el-button>
                    </div>
                </div>
                <div style="margin: 15px;" >
                    <el-collapse v-model="activeNames" >
                        <el-collapse-item v-for="(item,index) in preguntas" :name="index">
                            <template slot="title">
                                <strong>
                                    @{{item.PREGUNTA}}
                                </strong>
                            </template>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row" v-for="data in item.vresp">
                                        <div class="col-sm-6 text-center">
                                            <p><strong>Respuesta : </strong><el-tag effect="dark" size="mini">@{{data.VALOR}}</el-tag></p>
                                        </div>
                                        <div class="col-sm-6 text-center">
                                            <p><strong>Cantidad : </strong><el-tag effect="dark" type="warning" size="mini">@{{data.CONTADOR}}</el-tag></p>    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!--<apexchart type=bar height=350 :options="chartOptions" :series="series" />-->
                                </div>
                            </div>
                        </el-collapse-item>
                    </el-collapse>
                </div>
            </div>
            </transition>
        </div>
    </div>
  </div>
</div>
@section('script')
{!!Html::script('js/cuestionarioResultado.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop