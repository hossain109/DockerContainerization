<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Reset Password </title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{url('public/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{url('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{url('public/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="javascript:void(0)" class="h1"><b>Reset Password</b></a>
    </div>
    <div class="card-body">
        @include('flush.message')
      <form action="" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" value="{{old('password',$user->password)}}" id="password" placeholder="password">
          <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="confirm new password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
        <div class="row">
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="{{url('public/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('public/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('public/dist/js/adminlte.min.j')}}"></script>
</body>
</html>
