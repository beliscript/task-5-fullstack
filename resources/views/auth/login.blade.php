@extends('layouts.auth')
@section('content')
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Masuk</p>
    <div class="alert alert-danger" style="display:none"></div>
    <form id="isLogin" method="POST">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
       
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
@endsection