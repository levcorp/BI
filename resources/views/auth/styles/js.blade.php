{{Html::script('plugins/jQuery/jquery-2.2.3.min.js')}}
<!-- Bootstrap 3.3.6 -->
{{Html::script('bootstrap/js/bootstrap.min.js')}}
<!-- iCheck -->
{{Html::script('plugins/iCheck/icheck.min.js')}}
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>