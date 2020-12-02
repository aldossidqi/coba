
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Daftar Akun Baru</title>
   <style>
    body{
      background-image: url(/background/screen-3.jpg);
      background-size: cover;
    }

  </style>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/assets/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body >
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>Dress</b>Code</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Daftar akun baru</p>

    <form action="/register" method="post">
        {{ csrf_field() }}
      <div class="form-group has-feedback {{ $errors->has('nama') ? ' has-error' : '' }}" >
        <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" >
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('nama'))
            <span class="help-block">
                <strong>{{ $errors->first('nama') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}" >
        <input type="text" class="form-control" placeholder="Username" name="username" >
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('username'))
              <span class="help-block">
                  <strong>{{ $errors->first('username') }}</strong>
              </span>
          @endif
      </div>
      
      <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" class="form-control" placeholder="Password" name="password" >

        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
         @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
      </div>
      <div class="form-group has-feedback ">
        <input id="password-confirm" type="password" placeholder="Tulis ulang password" class="form-control" name="password_confirmation" >
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
      </div>
      <div class="row">
       
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Daftar</button>
        </div>
         <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
      </div>
    </form>

   
    <br>
    <a href="/login" class="text-center">Sudah punya akun !</a> 
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="/assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
