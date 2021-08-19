@extends('panel.dashboard.layout')
@section('opciones')
@endsection
@section('body')
<div class="row" id="app" v-cloak>
  <input type="text" hidden :value="registro.usuario_id={{Auth::user()->id}}">
  <div class="col-md-12">
    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12 text-center" style="padding-bottom:15px">
          <el-card>
          <h4 class="text-center" style="padding:0px;margin:0px;">
            <strong>
              <img src="{{asset('/images/LevcorpPDF.png')}}" style="width: 150px;display: block;margin:auto;height:56px;">
            </strong>
          </h4>
          </el-card>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-6 text-center" style="padding-bottom:15px">
          <el-card>
          <h4 class="text-center" style="padding:0px;margin:0px;">
            <strong>
              Saldo de Levcoins
            </strong><br>
            <el-tag style="margin-top:5px;"
             effect="plain">
             <strong>
               LCVs @{{data.usuario.LCVs}}
             </strong>
           </el-tag>
          </h4>
          </el-card>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-6 text-center" style="padding-bottom:15px">
          <el-card :body-style="{ padding: '5px' }">
            <div class="row">
              <div class="col-sm-6">
                <div style="margin-top:30px;" class="text-center">
                  <strong>
                    DONAR LCVs :
                  </strong>
                </div>
              </div>
              <div class="col-sm-6">
                <img src="{{asset('/images/Moneda.png')}}" style="width: 86px;display: block;height:86px;" @click="handleShowDonarLCV()">
              </div>
            </div>
          </el-card>
      </div>
    </div>
    <el-card >
      <div class="col-md-3 col-sm-6 col-xs-12 text-center" style="padding-bottom:15px">
        <el-card :body-style="{ padding: '0px' }">
          <img src="{{asset('/images/Entrada.jpg')}}" class="image" style="width: 100%;display: block;height:220px;">
          <div style="padding: 10px;">
            <span>Entrada</span>
            <div v-if="!entrada" class="bottom clearfix">
                <time  class="time">@{{time}}</time>
                <el-button v-if="estado.entrada==='Autorizado'"  type="primary"  size="small" round class="button" @click="handleStoreMarca('E')">Registar</el-button>
                <div v-if="estado.entrada==='NoAutorizado'" style="height:15px;"></div>
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
              <el-button v-if="estado.almuerzo==='Autorizado'" type="primary"  size="small" round class="button" @click="handleStoreMarca('A')">Registar</el-button>
              <div v-if="estado.almuerzo==='NoAutorizado'" style="height:15px;"></div>
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
              <el-button type="primary" v-if="estado.regreso==='Autorizado'" size="small" round class="button" @click="handleStoreMarca('R')">Registar</el-button>
              <div v-if="estado.regreso==='NoAutorizado'" style="height:15px;"></div>
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
              <el-button v-if="estado.salida==='Autorizado'" type="primary"  size="small" round class="button" @click="handleStoreMarca('S')">Registar</el-button>
              <div v-if="estado.salida==='NoAutorizado'" style="height:15px;"></div>
            </div>
            <div class="text-center bottom" v-if="salida">
              <el-tag type="primary" class="newtime">@{{salida?salida.hora:''}}</el-tag>
            </div>
          </div>
        </el-card>
      </div>
    </el-card>
  </div>
  <div class="col-md-12">
  <div class="row">
    <div class="col-md-8 text-center" style="margin-top:15px;">
      <el-card v-if="registro.usuario_id==1">
        <h4 class="text-center" style="padding:0px;margin:0px;">
          <strong>
            Descargar Registros de Asistencia
          </strong>
        </h4>
        <br>
        <el-form ref="form" :inline="true" :model="asistencia" label-width="120px">
            <el-date-picker
              v-model="asistencia.fecha1"
              type="date"
              size="small"
              placeholder="Fecha Inicio"
              format="yyyy/MM/dd"
              value-format="yyyy-MM-dd"
              style="margin:10px;">
            </el-date-picker>
            <el-date-picker
              v-model="asistencia.fecha2"
              type="date"
              size="small"
              format="yyyy/MM/dd"
              value-format="yyyy-MM-dd"
              placeholder="Fecha Fin"
              style="margin:10px;">
            </el-date-picker>
            <el-button style="margin:10px;" type="primary" @click="handleGetReporte()" size="small" round>Descargar</el-button>
        </el-form>
      </el-card>
      <el-card v-if="registro.usuario_id==26">
        <h4 class="text-center" style="padding:0px;margin:0px;">
          <strong>
            Descargar Registros de Asistencia
          </strong>
        </h4>
        <br>
        <el-form ref="form" :inline="true" :model="asistencia" label-width="120px">
            <el-date-picker
              v-model="asistencia.fecha1"
              type="date"
              size="small"
              placeholder="Fecha Inicio"
              format="yyyy/MM/dd"
              value-format="yyyy-MM-dd"
              style="margin:10px;">
            </el-date-picker>
            <el-date-picker
              v-model="asistencia.fecha2"
              type="date"
              size="small"
              format="yyyy/MM/dd"
              value-format="yyyy-MM-dd"
              placeholder="Fecha Fin"
              style="margin:10px;">
            </el-date-picker>
            <el-button style="margin:10px;" type="primary" @click="handleGetReporte()" size="small" round>Descargar</el-button>
        </el-form>
      </el-card>
      <el-card v-if="registro.usuario_id==56">
        <h4 class="text-center" style="padding:0px;margin:0px;">
          <strong>
            Descargar Registros de Asistencia
          </strong>
        </h4>
        <br>
        <el-form ref="form" :inline="true" :model="asistencia" label-width="120px">
            <el-date-picker
              v-model="asistencia.fecha1"
              type="date"
              size="small"
              placeholder="Fecha Inicio"
              format="yyyy/MM/dd"
              value-format="yyyy-MM-dd"
              style="margin:10px;">
            </el-date-picker>
            <el-date-picker
              v-model="asistencia.fecha2"
              type="date"
              size="small"
              format="yyyy/MM/dd"
              value-format="yyyy-MM-dd"
              placeholder="Fecha Fin"
              style="margin:10px;">
            </el-date-picker>
            <el-button style="margin:10px;" type="primary" @click="handleGetReporte()" size="small" round>Descargar</el-button>
        </el-form>
      </el-card>
      <el-card v-if="registro.usuario_id==3">
        <h4 class="text-center" style="padding:0px;margin:0px;">
          <strong>
            Descargar Registros de Asistencia
          </strong>
        </h4>
        <br>
        <el-form ref="form" :inline="true" :model="asistencia" label-width="120px">
            <el-date-picker
              v-model="asistencia.fecha1"
              type="date"
              size="small"
              placeholder="Fecha Inicio"
              format="yyyy/MM/dd"
              value-format="yyyy-MM-dd"
              style="margin:10px;">
            </el-date-picker>
            <el-date-picker
              v-model="asistencia.fecha2"
              type="date"
              size="small"
              format="yyyy/MM/dd"
              value-format="yyyy-MM-dd"
              placeholder="Fecha Fin"
              style="margin:10px;">
            </el-date-picker>
            <el-button style="margin:10px;" type="primary" @click="handleGetReporte()" size="small" round>Descargar</el-button>
        </el-form>
      </el-card>
    </div>
    <div class="col-md-4 text-center" style="margin-top:15px;">
      <el-card v-if="registro.usuario_id==1">
        <h4 class="text-center" style="padding:0px;margin:0px;">
          <strong>
            Descargar Registros de Levcoins
          </strong>
        </h4>
        <br>
        <el-form ref="form" :inline="true" :model="asistencia" label-width="120px">
            <el-button style="margin:10px;" type="primary" @click="handleGetReporteLCV()" size="small" round>Descargar</el-button>
        </el-form>
      </el-card>
      <el-card v-if="registro.usuario_id==26">
        <h4 class="text-center" style="padding:0px;margin:0px;">
          <strong>
            Descargar Registros de Levcoins
          </strong>
        </h4>
        <br>
        <el-form ref="form" :inline="true" :model="asistencia" label-width="120px">
            <el-button style="margin:10px;" type="primary" @click="handleGetReporteLCV()" size="small" round>Descargar</el-button>
        </el-form>
      </el-card>
      <el-card v-if="registro.usuario_id==56">
        <h4 class="text-center" style="padding:0px;margin:0px;">
          <strong>
            Descargar Registros de Levcoins
          </strong>
        </h4>
        <br>
        <el-form ref="form" :inline="true" :model="asistencia" label-width="120px">
            <el-button style="margin:10px;" type="primary" @click="handleGetReporteLCV()" size="small" round>Descargar</el-button>
        </el-form>
      </el-card>
      <el-card v-if="registro.usuario_id==3">
        <h4 class="text-center" style="padding:0px;margin:0px;">
          <strong>
            Descargar Registros de Levcoins
          </strong>
        </h4>
        <br>
        <el-form ref="form" :inline="true" :model="asistencia" label-width="120px">
            <el-button style="margin:10px;" type="primary" @click="handleGetReporteLCV()" size="small" round>Descargar</el-button>
        </el-form>
      </el-card>
    </div>
  </div>
  </div>
</div>
@section('script')
{!!Html::script('js/asistencia.js')!!}
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
@endsection
@stop
