
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Dente | {{ ucfirst(collect(request()->segments())->last() ) }}</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('doctor_assets/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('doctor_assets/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('doctor_assets/modules/bootstrap-social/bootstrap-social.css')}}">
  <link rel="icon" type="image/x-icon" href="{{asset('admin_assets/img/favicon/fav_icon.png')}}" />
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('doctor_assets/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('doctor_assets/css/components.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.17/sweetalert2.css"
  integrity="sha512-p06JAs/zQhPp/dk821RoSDTtxZ71yaznVju7IHe85CPn9gKpQVzvOXwTkfqCyWRdwo+e6DOkEKOWPmn8VE9Ekg=="
   crossorigin="anonymous" referrerpolicy="no-referrer" />
  @stack('css')
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
    @yield('content')
  <!-- General JS Scripts -->
  <script src="{{ asset('doctor_assets/modules/jquery.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.17/sweetalert2.js"
  integrity="sha512-zL6Mk/gs8FtX6ZaN+ObOH/biB8Phx217vhCxRLzNdfHX2JlPgbmVuu948wqLYxY+QqgaLnbIbg6g5J7zszY4dg=="
   crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ asset('doctor_assets/modules/popper.js')}}"></script>
  <script src="{{ asset('doctor_assets/modules/tooltip.js')}}"></script>
  <script src="{{ asset('doctor_assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('doctor_assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{ asset('doctor_assets/modules/moment.min.js')}}"></script>
  <script src="{{ asset('doctor_assets/js/stisla.js')}}"></script>

  <!-- JS Libraies -->

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="{{ asset('doctor_assets/js/scripts.js')}}"></script>
  <script src="{{ asset('doctor_assets/js/custom.js')}}"></script>
  @stack('scripts')

</body>
</html>
