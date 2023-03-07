<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('frontend.index') }}" class="nav-link">Trang chủ</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
                <span class="user-name">Hello {{ Auth::user()->name }} !</span>
                <i class="fas fa-caret-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              {{-- <a href="{{ route('profiles.index') }}" class="dropdown-item">
                <i class="fas fa-user mr-2"></i> Profile
              </a> --}}
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}" class="dropdown-item">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
              </a>
            </div>
        </li>
    </ul>
</nav>
