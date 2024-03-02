<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Đăng nhập</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset("")}}/adm/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="{{asset("")}}/adm/css/sb-admin.css" rel="stylesheet">
  <link href="{{asset("")}}/adm/css/admin.css" rel="stylesheet">
</head>
<body class="bg-dark">
  <div class="container">
    @include('admin.layout.message')
    <div class="card card-login mx-auto mt-5">
      <div class="card-header card-header-login">
        <img src="{{asset("")}}/images/logo.jpg">
      </div>
      <div class="card-body">
        <form action="{{route('admin.login')}}" method="POST">
          @csrf
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="username" name="username" class="form-control" placeholder="Tài khoản" required="required" autofocus="autofocus">
              <label for="username">Tài khoản</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="password" name="password" class="form-control" placeholder="Mật khẩu" required="required" name="password">
              <label for="password">Mật khẩu</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me" name="remember-me">
                Nhớ mật khẩu
              </label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset("")}}/adm/vendor/jquery/jquery.min.js"></script>
  <script src="{{asset("")}}/adm/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset("")}}/adm/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>
