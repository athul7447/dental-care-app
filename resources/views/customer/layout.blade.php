<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tooth Fairies</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900">
    <link rel="stylesheet" href="{{asset('user_assets/fonts/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('user_assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('user_assets/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('user_assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('user_assets/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('user_assets/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('user_assets/fonts/flaticon/font/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('user_assets/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('user_assets/css/style.css')}}">
    <link rel="icon" type="image/x-icon" href="{{asset('admin_assets/img/favicon/fav_icon.png')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @stack('css')
  </head>
  <body>

  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->


    <div class="site-navbar-wrap">
      <div class="site-navbar-top">
        <div class="container py-2">
          <div class="row align-items-center">
            <div class="col-6">
              <a href="#" class="p-2 pl-0"><span class="icon-twitter"></span></a>
              <a href="#" class="p-2 pl-0"><span class="icon-facebook"></span></a>
              <a href="#" class="p-2 pl-0"><span class="icon-linkedin"></span></a>
              <a href="#" class="p-2 pl-0"><span class="icon-instagram"></span></a>
            </div>
            <div class="col-6">
              <div class="d-flex ml-auto">
                <a href="#" class="d-flex align-items-center ml-auto mr-4">
                  <span class="icon-phone mr-2"></span>
                  <span class="d-none d-md-inline-block">toothfaires01@gmail.com</span>
                </a>

                <a href="#" class="d-flex align-items-center">
                  <span class="icon-envelope mr-2"></span>
                  <span class="d-none d-md-inline-block">+1 291 2830 302</span>
                </a>
                <a href="{{ route('login') }}" class="d-flex align-items-center" style="padding-right: 10px;padding-left: 10px;">
                    <button class="btn btn-dark btn-sm" style="padding: 3px;">
                        <i class="fa fa-lock" aria-hidden="true"></i> Admin
                      </button>
                  </a>
                  <a href="{{ route('portal.login') }}" class="d-flex align-items-center">
                    <button class="btn btn-secondary btn-sm" style="padding: 3px;">
                        <i class="fa fa-sign-in" aria-hidden="true"></i> Doctor
                      </button>
                  </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="site-navbar">
        <div class="container py-1">
          <div class="row align-items-center">
            <div class="col-4">
              <h2 class="mb-0 site-logo"><a href="index.html">Tooth Fairies</a></h2>
            </div>
            <div class="col-10">
              <nav class="site-navigation text-right" role="navigation">
                <div class="container">
                  <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

                  <ul class="site-menu js-clone-nav d-none d-lg-block">
                    <li class=" {{ Route::is('customer.index')? 'active' : '' }}">
                      <a href="{{ route('customer.index') }}">Home</a>
                    </li>
                    <li class="{{ Route::is('customer.about')? 'active' : '' }}">
                        <a href="{{ route('customer.about') }}">About Us</a></li>
                    <li class="{{ Route::is('customer.news')? 'active' : '' }}">
                        <a href="{{ route('customer.news') }}">News</a></li>
                    <li class="{{ Route::is('customer.services')? 'active' : '' }}">
                        <a href="{{ route('customer.services') }}">Services</a></li>
                    <li class="{{ Route::is('customer.appointment')? 'active' : '' }}">
                        <a href="{{ route('customer.appointment') }}">Appointment</a></li>
                  </ul>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    @yield('content')
    <footer class="site-footer border-top">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 mb-5 mb-lg-0">
              <div class="row mb-5">
                <div class="col-md-12">
                  <h3 class="footer-heading mb-4">Navigation</h3>
                </div>
                <div class="col-md-6 col-lg-6">
                  <ul class="list-unstyled">
                    <li><a href="{{ route('customer.index') }}">Home</a></li>
                    <li><a href="{{ route('customer.news') }}">Services</a></li>
                    <li><a href="{{ route('customer.news') }}">News</a></li>
                    <li><a href="{{ route('customer.appointment') }}">Appointment</a></li>
                  </ul>
                </div>
                <div class="col-md-6 col-lg-6">
                  <ul class="list-unstyled">
                    <li><a href="{{ route('customer.about') }}">About Us</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    {{-- <li><a href="#">Contact Us</a></li> --}}
                    <li><a href="#">Membership</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-5">
                <h3 class="footer-heading mb-4">Recent News</h3>
                <div class="block-25">
                  <ul class="list-unstyled">
                    <li class="mb-3">
                      <a href="#" class="d-flex">
                        <figure class="image mr-4">
                          <img src="{{asset('user_assets/images/hero_bg_1.jpg')}}" alt="" class="img-fluid">
                        </figure>
                        <div class="text">
                          <span class="small text-uppercase date">Sep 16, 2018</span>
                          <h3 class="heading font-weight-light">Lorem ipsum dolor sit amet consectetur elit</h3>
                        </div>
                      </a>
                    </li>
                    <li class="mb-3">
                      <a href="#" class="d-flex">
                        <figure class="image mr-4">
                          <img src="{{asset('user_assets/images/hero_bg_1.jpg')}}" alt="" class="img-fluid">
                        </figure>
                        <div class="text">
                          <span class="small text-uppercase date">Sep 16, 2018</span>
                          <h3 class="heading font-weight-light">Lorem ipsum dolor sit amet consectetur elit</h3>
                        </div>
                      </a>
                    </li>
                    <li class="mb-3">
                      <a href="#" class="d-flex">
                        <figure class="image mr-4">
                          <img src="{{asset('user_assets/images/hero_bg_1.jpg')}}" alt="" class="img-fluid">
                        </figure>
                        <div class="text">
                          <span class="small text-uppercase date">Sep 16, 2018</span>
                          <h3 class="heading font-weight-light">Lorem ipsum dolor sit amet consectetur elit</h3>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>

            </div>


            <div class="col-lg-4 mb-5 mb-lg-0">


              <div class="row">
                <div class="col-md-12">
                  <h3 class="footer-heading mb-4">Follow Us</h3>

                  <div>
                    <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                    <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                    <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                    <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
                  </div>
                </div>
              </div>


            </div>

          </div>
          <div class="row pt-5 mt-5 text-center">


          </div>
        </div>
      </footer>
    </div>

    <script src="{{asset('user_assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('user_assets/js/jquery-ui.js')}}"></script>
    <script src="{{asset('user_assets/js/popper.min.js')}}"></script>
    <script src="{{asset('user_assets/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('user_assets/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('user_assets/js/aos.js')}}"></script>

    <script src="{{asset('user_assets/js/main.js')}}"></script>
    @stack('scripts')

    </body>
  </html>
