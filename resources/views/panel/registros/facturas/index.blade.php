@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app" v-cloak>
    <div class="col-sm-12">
        <div class="box box-info" style="">
            <div class="box-header">
                <p style="font-size: 15px">
                    <strong>&nbsp;&nbsp;</strong>
                </p>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="error">@{{ error }}</p>
                        <p class="decode-result">Last result: <b>@{{ result }}</b></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 camera">
                        <qrcode-stream @decode="onDecode" @init="onInit"/>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
{!!Html::script('js/factura.js')!!}
@endsection
@stop
