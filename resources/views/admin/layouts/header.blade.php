<nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
    <div class="container">
      <a href="{{route('user.dashboard')}}" class="navbar-brand">
        <img src="{{ asset('images/logo1.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">

        <li class="nav-item active">
            <a class="nav-link" href="{{route('admin.dashboard')}}">Dashboard <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item dropdown active">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">SSN/DOB</a>

            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{route('admin.ssn.records')}}" class="dropdown-item">All SSN Records</a></li>
              <li><a href="{{route('admin.ssn.create')}}" class="dropdown-item">Add New SSN</a></li>
              <li><a href="{{route('admin.ssn-import')}}" class="dropdown-item">Add Bulk SSN</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown active">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Driver License</a>

            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{route('admin.dl.records')}}" class="dropdown-item">All DL Records</a></li>
              <li><a href="{{route('admin.dl.create')}}" class="dropdown-item">Add New DL</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown active">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Other Services</a>

            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="#" class="dropdown-item">Shipping Label</a></li>
              <li><a href="#" class="dropdown-item">Mail Flooding</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown active">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">News</a>

            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{route('admin.news.posts')}}" class="dropdown-item">All News</a></li>
              <li><a href="{{route('admin.news.create')}}" class="dropdown-item">Add News</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown active">
            <a href="{{route('admin.tickets')}}" class="nav-link">Ticket</a>
          </li>

          <li class="nav-item dropdown active">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Settings/Transactions</a>

            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{route('admin.all-payments')}}" class="dropdown-item">Payments</a></li>
              <li><a href="{{route('admin.all-users')}}" class="dropdown-item">Users</a></li>
              <li><a href="{{route('admin.all-admins')}}" class="dropdown-item">Admins</a></li>
            </ul>
        </li>

        <li class="nav-item dropdown active">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle"><i class="fa fa-user-circle" aria-hidden="true"></i> {{ Auth::guard('admin')->user()->name }}</a>

            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{route('admin.logout')}}" class="dropdown-item"><i class="fa fa-lock" aria-hidden="true"></i> Logout</a></li>
            </ul>
        </li>

        </ul>
      </div>

      <!-- Right navbar links -->
    </div>
  </nav>
