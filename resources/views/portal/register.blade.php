@extends('portal.auth-layout')

    <style>
        .error{
            color: red !important;
        }
    </style>

@section('content')
<div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="{{asset('admin_assets/img/favicon/fav_icon.png')}}" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
                <form method="POST" action="{{ route('portal.register.submit') }}" id="register_form">
                    @csrf
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="name">Name</label>
                      <input id="name" type="name" class="form-control" name="name" autofocus value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                      <label for="username">Username</label>
                      <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}">
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                        <label for="email">Email</label>
                        <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    <div class="form-group col-6">
                      <label for="qualification">Qualification</label>
                      <input id="qualification" type="text" class="form-control" name="qualification" value="{{ old('qualification') }}">
                        @error('qualification')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="phone">Phone</label>
                      <input id="phone" type="phone" class="form-control" name="phone" autofocus value="{{ old('phone') }}">
                         @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                      <label for="address">Address</label>
                      <textarea class="form-control" name="address" style="resize: none;">{{ old('address') }}</textarea>
                      @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                      @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Password Confirmation</label>
                      <input id="password2" type="password" class="form-control" name="password_confirmation">
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  @endsection
