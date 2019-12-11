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
  <style>
    [v-cloak] {
      display: none;
    }
  </style>
</head>
<body class="hold-transition login-page" style="background:#eaebef !important">
  <div class="row">
    <div class="col-sm-12">
      <div>
        <div class="login-box" id="login" v-cloak> 
          <div class="login-logo">
            <img src="../images/logo.png" alt="" width="350" height="110">
           <!--  <a><b style="color:#3c70a4; letter-spacing: 5px">LEV</b><b style="background-color: #3c70a4; color: white; letter-spacing: 5px; padding: 1px 5px;">CORP</b></a> -->
          </div>
          <!-- /.login-logo -->
          <el-card class="box-card">
            <p class="login-box-msg" style="color: #606266;font-size: 17px">
              <strong>
                Iniciar Sesion
              </strong>
            </p>
            @if(Session::has('message'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:white"><span aria-hidden="true">&times;</span></button>
                  <strong>{{Session::get('message')}}</strong>
                </div>
            @endif
      
            <form action="{{ route('login') }}" method="post">
                @csrf
              <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <el-input placeholder="Correo Electronico" name="email" v-model="email" value="{{ old('email') }}" focus></el-input>
                @if ($errors->has('email'))
                    <span id="helpBlock2" class="help-block">{{ $errors->first('email') }}</span>
                @endif
              </div>
              <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                <el-input type="password" placeholder="Contraseña" name="password" v-model="password" value="{{ old
                ('password') }}"></el-input>
                @if ($errors->has('password'))
                    <span id="helpBlock2" class="help-block">{{ $errors->first('password') }}</span>
                @endif
              </div>
              <div class="row">
                <div class="col-xs-8">
                    <label>
                      <el-checkbox size="mini" border name="remember">Recuerdame</el-checkbox>
                    </label>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                  <el-button style="background-color: #2d3661;border-color: #2d3661" type="primary" round native-type="submit">Entrar</el-button>
                </div>
                <!-- /.col -->
              </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="text-center" style="margin:5px">
                      <el-link style="color: #2d3661;" icon="el-icon-unlock" @click="reset" type="primary">Olvide mi contraseña</el-link>
                    </div>
                  </div>
                </div>
            </form>
            <!-- /.social-auth-links -->
      
          </el-card>
          <!-- /.login-box-body -->
        </div>
      </div>
    </div>
    
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
