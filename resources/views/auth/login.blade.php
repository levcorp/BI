<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Levcorp | Entrar</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @include('auth.styles.css')
    @laravelPWA
</head>
<body class="hold-transition login-page">
<div class="login-box" id="login">
  <div class="login-logo">
    <a><b style="color:#3c8dbc; letter-spacing: 5px">LEV</b><b style="background-color: #3c8dbc; color: white; letter-spacing: 5px; padding: 1px 5px;">CORP</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Entra para comenzar la sesión</p>
    @if(Session::has('message'))
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:white"><span aria-hidden="true">&times;</span></button>
          <strong>{{Session::get('message')}}</strong>
        </div>
    @endif

    <form action="{{ route('login') }}" method="post">
        @csrf
      <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="text" class="form-control" placeholder="Correo Electronico"  name="email" value="{{ old('email') }}" autofocus>
        @if ($errors->has('email'))
            <span id="helpBlock2" class="help-block">{{ $errors->first('email') }}</span>
        @endif
      </div>
      <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" class="form-control" placeholder="Contraseña" name="password" value="{{ old('password') }}">
        @if ($errors->has('password'))
            <span id="helpBlock2" class="help-block">{{ $errors->first('password') }}</span>
        @endif
      </div>
      <div class="row">
        <div class="col-sm-6">
            <el-link icon="el-icon-unlock" @click="reset" type="primary">Olvide mi contraseña</el-link>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember"> Recuerdame
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if(Session::has('success'))
<script>
  swal("Exito!", "{{Session::get('success')}}", "success");
  </script>
@endif
@include('auth.styles.js')

<script src="{{asset('js/login.js')}}"></script>
</body>
</html>
