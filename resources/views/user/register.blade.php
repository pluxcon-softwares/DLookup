
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
      <a href="#" class="navbar-brand">
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

        <div class="register-box">
            <div class="card card-outline card-warning">
              <div class="card-header text-center">
                <a href="/" class="h1"><b>{{config('app.name')}}</b></a>
              </div>
              <div class="card-body">

                @if(Session::has('flash_message'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('flash_message') }}
                </div>
                @endif


                <form action="{{route('user.store')}}" method="post">
                    @csrf
                  <div class="input-group mb-3">
                    <div class="col-12">
                        <span style="font-size: 12px; color:red;">{{ $errors->first('username') }}</span>
                    </div>
                    <input type="text" name="username" class="form-control" placeholder="{{__('Username')}}">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="col-12">
                        <span style="font-size: 12px; color:red;">{{ $errors->first('email') }}</span>
                    </div>
                    <input type="email" name="email" class="form-control" placeholder="{{__('Email')}}">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="col-12">
                        <span style="font-size: 12px; color:red;">{{ $errors->first('password') }}</span>
                     </div>
                    <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="{{__('Retype password')}}">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                        <input type="text" style="color: red; font-size:1.5rem; font-weight:bold;" value="{{$captcha_image}}" disabled class="form-control form-control-sm">
                        <input type="hidden" value="{{ $captcha_image }}" name="captcha_image">
                    </div>
                    <div class="col-6">
                        <input type="text" style="color: red; font-size:1.5rem; font-weight:bold;" name="captcha_value" class="form-control form-control-sm">
                    </div>
                    <div class="col-12">
                        <span style="font-size: 12px;">{{__('Please enter the numbers as they are shown in the box above.')}}</span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>

                <a href="{{ route('user.login') }}" class="text-center">{{__('I already have a account?')}}</a>
              </div>
              <!-- /.form-box -->
            </div><!-- /.card -->
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
