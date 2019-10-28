@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app" v-cloak>
    <p class="error">@{{ error }}</p>
    <p class="decode-result">Last result: <b>@{{ result }}</b></p>
    <qrcode-stream @decode="onDecode" @init="onInit" />
</div>
@section('script')
{!!Html::script('js/factura.js')!!}
@endsection
@stop
