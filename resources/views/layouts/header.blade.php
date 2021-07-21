<nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
    <div class="container">
      <a href="{{route('user.dashboard')}}" class="navbar-brand">
        <img src="{{asset('images/logo1.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">

        <li class="nav-item active">
            <a class="nav-link" href="{{route('user.dashboard')}}">{{__('Home')}} <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item dropdown active">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">{{__('SSN/DL Lookup')}}</a>

            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{route('user.ssn-search-page')}}" class="dropdown-item">{{__('SSN/DOB')}}</a></li>
              <li><a href="{{route('user.dl.searchpage')}}" class="dropdown-item">{{__('Drivers License(DL)')}}</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown active">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">{{__('Services')}}</a>

            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="#" class="dropdown-item">{{__('Email Flood')}}</a></li>
              <li><a href="#" class="dropdown-item">{{__('Shipping Labels')}}</a></li>
            </ul>
          </li>

        <li class="nav-item dropdown active">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">{{__('Purchase')}}</a>

            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{route('user.view-ssn-purchase')}}" class="dropdown-item">{{__('SSN Records')}}</a></li>
              <li><a href="{{route('user.view-dl-purchase')}}" class="dropdown-item">{{__('DL Records')}}</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown active">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">{{__('Support')}}</a>

            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{route('user.tickets')}}" class="dropdown-item">{{__('Ticket')}}</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown active">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">{{__('Wallet')}} (${{Auth::user()->wallet}})</a>

            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{route('user.add-Fund')}}" class="dropdown-item">{{__('Add Funds')}}</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown active">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle"><i class="fa fa-user-circle" aria-hidden="true"></i> {{ Auth::user()->username }}</a>

            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{route('user.logout')}}" class="dropdown-item">{{__('Logout')}}</a></li>
            </ul>
          </li>

          <li class="nav-item active">
            <a class="nav-link" href="{{ url()->current() }}?lang=ru">
                <img src="{{ asset('images/russia.png') }}" style="width: 16px;" /> RU
            </a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="{{ url()->current()}}?lang=us">
                <img src="{{ asset('images/united-states.png') }}" style="width: 16px;"> EN
            </a>
        </li>

        </ul>
      </div>

      <!-- Right navbar links -->
    </div>
  </nav>
