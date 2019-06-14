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
  <h4 class="login-box-msg">{{\Session::get('success')}}</h4>
    <!-- /.social-auth-links -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('auth.styles.js')

<script src="{{asset('js/login.js')}}"></script>
</body>
</html>
