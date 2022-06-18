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
                      <input id="name" type="name" class="form-control" name="name" autofocus>
                    </div>
                    <div class="form-group col-6">
                      <label for="username">Username</label>
                      <input id="username" type="username" class="form-control" name="username">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                        <label for="email">Email</label>
                        <input id="email" type="text" class="form-control" name="email">
                      </div>
                    <div class="form-group col-6">
                      <label for="qualification">Qualification</label>
                      <input id="qualification" type="text" class="form-control" name="qualification">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="phone">Phone</label>
                      <input id="phone" type="phone" class="form-control" name="phone" autofocus>
                    </div>
                    <div class="form-group col-6">
                      <label for="address">Address</label>
                      <textarea class="form-control" name="address" style="resize: none;"></textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
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
  @push('scripts')
  <script>
    if ($("#register_form").length > 0) {
     $("#register_form").validate({

     rules: {
        name: {
            required: true,
            maxlength: 255,
            minlength: 5
        },
        username: {
            required: true,
            maxlength: 255,
            minlength: 5
        },
        email: {
            required: true,
            maxlength: 50,
            email: true
        },
        qualification: {
            required: true,
            maxlength: 255
        },
        phone: {
            required: true,
            digits:true,
            minlength: 10,
            maxlength:12,
        },
        address: {
            required: true,
            maxlength: 500
        },
        password: {
            required: true,
            minlength: 8,
            maxlength: 255
        },
        password_confirmation: {
            required: true,
            minlength: 8,
            maxlength: 255,
            equalTo: "#password"
        }
     },
     messages: {

        name: {
            required: "Please enter name",
            maxlength: "Name should be 5 characters long."
        },
        username: {
            required: "Please enter username",
            maxlength: "Username should be 5 characters long."
        },
        email: {
            required: "Please enter valid email",
            email: "Please enter valid email",
            maxlength: "The email name should less than or equal to 50 characters",
        },
        qualification: {
            required: "Please enter qualification",
        },
        phone: {
            required: "Please enter phone",
            digits: "Please enter valid phone",
            minlength: "Phone should be 10 digits long",
            maxlength: "Phone should be 12 digits long",
        },
        address: {
            required: "Please enter address",
            maxlength: "Address should be 500 characters long."
        },
        password: {
            required: "Please enter password",
            minlength: "Password should be 8 characters long.",
            maxlength: "Password should be 255 characters long."
        },
        password_confirmation: {
            required: "Please enter password confirmation",
            minlength: "Password should be 8 characters long.",
            maxlength: "Password should be 255 characters long.",
            equalTo: "Password and password confirmation should be same."
        }
     },
     submitHandler: function(form) {
      $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
    //    $('#send_form').html('Sending..');
       $.ajax({
         url: "{{ route('portal.register.submit')  }}" ,
         type: "POST",
         data: $('#register_form').serialize(),
         success: function( response ) {
            Swal.fire(
                'Good job!',
                'You clicked the button!',
                'success'
            ).then((result) => {
              if (result.value) {
                window.location.href = "{{ route('portal.login') }}";
              }
            });
         }
       });
     }
   })
 }
 </script>
  @endpush
