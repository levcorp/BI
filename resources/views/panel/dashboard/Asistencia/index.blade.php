@extends('panel.dashboard.layout')
@section('opciones')
@endsection
@section('body')
<div class="row" id="app" v-cloak>
  <input type="text" hidden :value="registro.usuario_id={{Auth::user()->id}}">
  <div class="col-md-12">
    <el-card>
      <div slot="header" class="clearfix" >
        <h4 class="text-center" style="padding:0px;margin:0px;">
          <strong>
            Bienvenido a Levcorp S. A.
          </strong>
        </h4>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 text-center" style="padding-bottom:15px">
        <el-card :body-style="{ padding: '0px' }">
          <img src="{{asset('/images/Entrada.jpg')}}" class="image" style="width: 100%;display: block;height:220px;">
          <div style="padding: 10px;">
            <span>Entrada</span>
            <div v-if="!entrada" class="bottom clearfix">
                <time  class="time">@{{time}}</time>
                <el-button type="primary"  size="small" round class="button" @click="handleStoreMarca('E')">Registar</el-button>
            </div>
            <div class="text-center bottom" v-if="entrada">
              <el-tag  type="primary" class="newtime">@{{entrada.hora}}</el-tag>
            </div>
          </div>
        </el-card>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 text-center " style="padding-bottom:15px">
        <el-card :body-style="{ padding: '0px' }">
          <img src="{{asset('/images/Almuerzo.jpg')}}" class="image" style="width: 100%;display: block;height:220px;">
          <div style="padding: 10px;">
            <span>Salida Almuerzo</span>
            <div v-if="!almuerzo" class="bottom clearfix">
              <time  class="time">@{{time}}</time>
              <el-button v-if="entrada" type="primary"  size="small" round class="button" @click="handleStoreMarca('A')">Registar</el-button>
              <div v-if="!entrada" style="height:15px;"></div>
            </div>
            <div class="text-center bottom" v-if="almuerzo">
              <el-tag  type="primary" class="newtime">@{{almuerzo.hora}}</el-tag>
            </div>
          </div>
        </el-card>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 text-center " style="padding-bottom:15px">
        <el-card :body-style="{ padding: '0px' }">
          <img src="{{asset('/images/Regreso.jpg')}}" class="image" style="width: 100%;display: block;height:220px;">
          <div style="padding: 10px;">
            <span>Regreso Almuerzo</span>
            <div v-if="!regreso" class="bottom clearfix">
              <time class="time">@{{time}}</time>
              <el-button type="primary" v-if="almuerzo" size="small" round class="button" @click="handleStoreMarca('R')">Registar</el-button>
              <div v-if="!almuerzo" style="height:15px;"></div>
            </div>
            <div class="text-center bottom" v-if="regreso">
              <el-tag type="primary" class="newtime">@{{regreso.hora}}</el-tag>
            </div>
          </div>
        </el-card>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 text-center" style="padding-bottom:15px">
        <el-card :body-style="{ padding: '0px' }">
          <img src="{{asset('/images/Salida.jpg')}}" class="image" style="width: 100%;display: block;height:220px;">
          <div style="padding: 10px;">
            <span>Salida</span>
            <div v-if="!salida" class="bottom clearfix">
              <time class="time">@{{time}}</time>
              <el-button v-if="regreso" type="primary"  size="small" round class="button" @click="handleStoreMarca('S')">Registar</el-button>
              <div v-if="!regreso" style="height:15px;"></div>
            </div>
            <div class="text-center bottom" v-if="salida">
              <el-tag type="primary" class="newtime">@{{salida?salida.hora:''}}</el-tag>
            </div>
          </div>
        </el-card>
      </div>
    </el-card>
  </div>
</div>
@section('script')
<style>
  .time {
    font-size: 27px;
    color: #999;
    top: 25px !important;
  }
  .newtime {
    font-size: 27px;
    top: 25px !important;
  }
  .bottom {
    margin-top: 13px;
    line-height: 12px;
  }

  .button {
    padding: 0;
    float: right;
  }

  .image {
    width: 100%;
    display: block;
  }

  .clearfix:before,
  .clearfix:after {
      display: table;
      content: "";
  }

  .clearfix:after {
      clear: both
  }
</style>
{!!Html::script('js/asistencia.js')!!}
@endsection
@stop
