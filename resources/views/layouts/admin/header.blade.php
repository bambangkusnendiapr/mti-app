<header>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    <!-- SEARCH FORM -->
    {{-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">


        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <span class="d-none d-md-inline mr-2">{{\Auth::user()->name}}</span>
              <img src="{{asset('images/')}}/{{\Auth::user()->image}}" class="user-image img-circle elevation-2" alt="User Image">
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header bg-dark">
              <img src="{{asset('images/')}}/{{\Auth::user()->image}}" class="img-circle elevation-2" alt="User Image">

              <p>
                {{\Auth::user()->name}}
              </p>
            </li>
            <!-- Menu Body -->

            <!-- Menu Footer-->
            <li class="user-footer">
              <a href="/profile" class="btn btn-default btn-flat"><span class="fas fa-user"></span> Profile</a>
              <a href="/logout" class="btn btn-default btn-flat float-right"><span class="fas fa-sign-out-alt"></span> Sign out</a>
            </li>
          </ul>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li> --}}
      </ul>
  </nav>
  <!-- /.navbar -->
</header>
