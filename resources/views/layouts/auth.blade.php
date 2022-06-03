
<!DOCTYPE html>
<html>
@include('layouts.head')
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Rendi</b>LTE</a>
  </div>
   @yield('content')
</div>
<!-- /.login-box -->
@include('layouts.script')
<!-- iCheck -->
<script src="{{ asset('dist/js/index.js') }}"></script>
<script src="{{ asset('auth/index.js') }}"></script>
<script src="{{ asset('plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
