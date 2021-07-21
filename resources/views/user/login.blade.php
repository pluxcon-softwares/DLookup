
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

<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
    <div class="container">
      <a href="../../index3.html" class="navbar-brand">
        <img src="{{asset('images/logo1.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      </a>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item active">
          <a class="nav-link" href="{{ url()->current() }}?lang=ru">
            <img src="{{ asset('images/russia.png') }}" style="width: 16px;" />
            RU
          </a>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item active">
          <a class="nav-link" href="{{ url()->current()}}?lang=us">
            <img src="{{ asset('images/united-states.png') }}" style="width: 16px;">
            EN
          </a>
        </li>
      </ul>
    </div>
  </nav>

<!-- ./Navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper login-page">

    <!-- Main content -->
    <div class="content">
      <div class="container">

        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-danger">
                <div class="card-header text-center">
                    <a href="#" class="h1"><b>CHECK</b>-LITE</a>
                </div>
              <div class="card-body">
                <p class="login-box-msg">{{ __('Login to your session') }}</p>

                @if(Session::has('flash_message'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('flash_message') }}
                </div>
                @endif

                <form action="{{ route('user.authenticate') }}" method="post">
                    @csrf
                  <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="{{__('Email')}}">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                    <div class="col-12">
                        <span style="font-size: 12px; color:red;">{{ $errors->first(__('email')) }}</span>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                    <div class="col-12">
                        <span style="font-size: 12px; color:red;">{{ $errors->first(__('password')) }}</span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-8">
                      <div class="icheck-primary">
                        <input type="checkbox" name="remember_me" id="remember">
                        <label for="remember">
                          {{__('Remember Me')}}
                        </label>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                      <button type="submit" class="btn btn-danger btn-block">{{ __('Sign In') }}</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>

                <div class="social-auth-links text-center mt-2 mb-3">
                  <a href="{{ route('user.create') }}" class="btn btn-block btn-primary">
                    <i class="fa fa-user mr-2"></i> {{ __('Register') }}
                  </a>
                </div>
                <!-- /.social-auth-links -->

                <p class="mb-1">
                  <a href="forgot-password.html">{{__('I forgot my password')}}</a>
                </p>
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
