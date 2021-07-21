
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper login-page">

    <!-- Main content -->
    <div class="content">
      <div class="container">

        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-danger">
                <div class="card-header">
                    <h3>Admin Login</h3>
                </div>
              <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                @if(Session::has('flash_message'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('flash_message') }}
                </div>
                @endif

                <form action="{{ route('admin.authenticate') }}" method="post">
                    @csrf
                  <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                    <div class="col-12">
                        <span style="font-size: 12px; color:red;">{{ $errors->first('email') }}</span>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                    <div class="col-12">
                        <span style="font-size: 12px; color:red;">{{ $errors->first('password') }}</span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-8">
                      <div class="icheck-primary">
                        <input type="checkbox" name="remember_me" id="remember">
                        <label for="remember">
                          Remember Me
                        </label>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                      <button type="submit" class="btn btn-danger btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
