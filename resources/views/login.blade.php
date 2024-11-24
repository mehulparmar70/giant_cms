<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GIA - Admin (Login)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('/')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{url('/')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/')}}/dist/css/adminlte.min.css">
<style>
.login-form {
/*    background: #835fa6;*/
    background: #0c0c0c;
  }
  .card-danger.card-outline {
/*    border-top: 3px solid #835fa6;*/
    border-top: 3px solid #0c0c0c;
}
  .login-form .login-box-msg {
    color: white;
    font-size: 21px;
  }
  .btn-primary {
    color: #fff;
    background-color: #f60;
    border-color: #f60;
    box-shadow: none;
}
.login-box, .register-box{
  width: 500px;
}
.form-rounded {
border-radius: 1rem;
}
  
.form-control{
  color: #ebeff3 !important;
}
</style>

</head>
<body class="hold-transition login-page" style="background-image: url('{{route("index")}}/admin/img/bg.jpg')">
<div class="login-box">

@if(Session::get('fail'))
        <div class="alert alert-danger">
            {{Session::get('fail')}}
        </div>
    @endif



<!-- /.card -->
  <div class="col-sm-12 col-md-12 col-lg-12 mt-5 text-center">
    <img src="{{route('index')}}/img/{{getWebsiteOptions()['website_logo']['option_value']}}" alt="" width="300px">
  </div>

  <div class="card card-outline card-danger login-form" style="background-image: url('{{route("index")}}/admin/img/login_window_bg.png');padding: 33px;">
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form action="{{route('admin.auth.check')}}" method="post">
        @csrf
        <div class="input-group mb-4">
          <input type="email" class="form-control form-rounded" 
            name="email" value="{{old('email')}}" placeholder="Email" style="background-color: #1a1a1a !important;">
          <div class="input-group-append" >
            <div class="input-group-text form-rounded" style="background-color: #1a1a1a !important;">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="my-2">
          <span class="text-light">@error('email') {{$message}} @enderror</span>
        </div>
        <div class="input-group mb-4">
          <input type="password" class="form-control form-rounded" 
            name="password"  placeholder="Password" style="background-color: #1a1a1a !important;">
          <div class="input-group-append form-rounded">
            <div class="input-group-text form-rounded" style="background-color: #1a1a1a !important;">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="my-2">
          <span class="text-light">@error('password') {{$message}} @enderror</span>
        </div>
        <div class="row justify-content-center">

          <div class="col-6 ">
            <button type="submit" class="btn btn-primary btn-block form-rounded">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
  </div>
  <div class="col-sm-12 col-md-12 col-lg-12 mt-5 text-center">
    <p style="color: #c3c4c6;">World's Most Advanced Website Management System from :</p>
    <img src="{{route('index')}}/admin/img/login-footer.png" alt="">
    <p style="color: #fbfbfb;" class="mt-3">www.thestudio5.com.au</p>
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{url('/')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{url('/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('/')}}/dist/js/adminlte.min.js"></script>
</body>
</html>
