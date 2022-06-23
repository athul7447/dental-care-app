<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Dente | Portal</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('doctor_assets/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('doctor_assets/modules/fontawesome/css/all.min.css')}}">


  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('doctor_assets/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('doctor_assets/css/components.css')}}">
  <link rel="icon" type="image/x-icon" href="{{asset('admin_assets/img/favicon/fav_icon.png')}}" />
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
@stack('css')
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset('doctor_assets/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="{{ route('portal.profile') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item has-icon text-danger" href="{{ route('portal.logout') }}"
                onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
                <form id="logout-form" action="{{ route('portal.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{route('portal.dashboard')}}"> <img src="{{asset('admin_assets/img/favicon/fav_icon.png')}}" alt="logo" style="height: 30px;">  Dente Portal</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('portal.dashboard')}}"> <img src="{{asset('admin_assets/img/favicon/fav_icon.png')}}" alt="logo" style="height: 30px;"></a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Route::is('portal.dashboard')? 'active' : '' }}">
                <a class="nav-link" href="{{route('portal.dashboard')}}"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
            </li>
            <li class="{{ Route::is('portal.appointments')? 'active' : '' }}">
                <a class="nav-link" href="{{route('portal.appointments')}}"><i class="fas fa-th"></i> <span>Appointments</span></a>
            </li>
            <li class="{{ Route::is('portal.appointments.calendar')? 'active' : '' }}">
                <a class="nav-link" href="{{route('portal.appointments.calendar')}}"><i class="fas fa-calendar"></i> <span>Appointments Calendar</span></a>
            </li>
          </ul>
         </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
      <footer class="main-footer">

        <div class="footer-right">

        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('doctor_assets/modules/jquery.min.js')}}"></script>
  <script src="{{ asset('doctor_assets/modules/popper.js')}}"></script>
  <script src="{{ asset('doctor_assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('doctor_assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{ asset('doctor_assets/modules/moment.min.js')}}"></script>
  <script src="{{ asset('doctor_assets/js/stisla.js')}}"></script>

  <!-- JS Libraies -->



  <!-- Page Specific JS File -->
  {{-- <script src="{{ asset('doctor_assets/js/page/index-0.js')}}"></script> --}}

  <!-- Template JS File -->
  <script src="{{ asset('doctor_assets/js/scripts.js')}}"></script>
  <script src="{{ asset('doctor_assets/js/custom.js')}}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @stack('scripts')
</body>
</html>
