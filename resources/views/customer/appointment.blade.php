@extends('customer.layout')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.18/sweetalert2.css" integrity="sha512-p06JAs/zQhPp/dk821RoSDTtxZ71yaznVju7IHe85CPn9gKpQVzvOXwTkfqCyWRdwo+e6DOkEKOWPmn8VE9Ekg=="
crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .timepicker .form-control:disabled, .form-control[readonly] {
    background-color: #ffffff !important;
    opacity: 1;
    }
    .error{
        color: red !important;
    }
</style>
@endpush
@section('content')
<div class="site-blocks-cover inner-page" style="background-image: url({{asset('user_assets/images/hero_bg_1.jpg')}});" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-7">
          <span class="sub-text">book your appointment now !</span>
          <h1><strong>Book</strong> Appointment</h1>
        </div>
    </div>
</div>
</div>
<a name="appointment-form"></a>
  <div class="site-section bg-light">
    <div class="container">
        <h2 class="site-heading text-black mb-5"><strong>Appointment</strong></h2>
        <div class="col">
          <form action="{{ route('customer.submit-appointment') }}" class="p-5 bg-white mb-5 mb-lg-0" method="post" id="appointment_form">
            @csrf
            <div class="row form-group">

              <div class="col mb-md-0 date-container">
                <label class="font-weight-bold" for="date">Date</label>
                <input type="date" id="date" class="form-control datepicker px-2 datepicker-input" name="date" placeholder="Date of visit"
                value="{{ old('date') }}" >
                @error('date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col doctor-container d-none">
                <label class="font-weight-bold" for="treatment">Select Doctor</label>
                <select name="doctor_name" id="doctor_name" class="form-control doctor-name">
                  <option value="">select</option>
                  @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}" @if(old('doctor_name')==$doctor->id) selected @endif>{{ $doctor->name }}</option>
                  @endforeach
                </select>
                @error('doctor_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
            <div class="col timepicker-container d-none">
                <label class="font-weight-bold timepicker" for="time">Time</label>
                <input type="text" readonly id="time" class="form-control timepicker timepicker-input" name="time" placeholder="Time" value="{{ old('time') }}">
                @error('time')
                <div class="text-danger">{{ $message }}</div>
            @enderror
              </div>


            </div>
            <div class="appointment-form-container d-none">
            <div class="row form-group">
                <div class="col ">
                    <label class="font-weight-bold" for="fname">Name</label>
                    <input type="text" id="fname" class="form-control" name="name" placeholder="Enter your name" value="{{ old('name') }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col">
                    <label class="font-weight-bold" for="email">Email</label>
                    <input type="email" id="email" class="form-control" name="email" placeholder="Enter your email" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                <div class="col">
                    <label class="font-weight-bold" for="lname">Phone</label>
                    <input type="text" id="lname" class="form-control" name="phone" placeholder="Enter your phone" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" for="note">Notes</label>
                <textarea name="note" id="note" cols="30" rows="5" class="form-control" placeholder="Write your notes or questions here...">{{ old('note') }}</textarea>
                @error('note')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <button type="submit" value="Send" class="btn btn-primary" id="submit">Submit</button>
              </div>
            </div>
        </div>
          </form>
      </div>
    </div>
  </div>
  @endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.18/sweetalert2.min.js" integrity="sha512-98hK38IvWQC069FFbq/la6NaBj4TGplZ118B+bFVOxsBQQL4EqKUWw9JkNh8Lem7FCGkLCxgr81q+/hRIemJCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js">
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>

<script>
$(document).ready(function(){

    $("#date").flatpickr({
    minDate: "today",
    maxDate: `{{ date('Y-m-d', strtotime(date("Y-m-d"). ' + 30 days')); }}`,
    dateFormat: "Y-m-d",
    "disable": [
        function(date) {
           return (date.getDay() === 3 || date.getDay() === 4);  // disable weekends
        }
    ],
    "locale": {
        "firstDayOfWeek": 1 // set start day of week to Monday
    }
});
    $('#time').timepicker({
        interval: 30,
        minTime: '09:00',
        maxTime: '18:00',
        startTime: '09:00',
        change: timeOnChange,
    });

    if ($("#appointment_form").length > 0) {
        $("#appointment_form").validate({
        rules: {
            name: {
                required: true,
                maxlength: 50
            },
            email: {
                required: true,
                maxlength: 50,
                email: true,
            },
            phone: {
                required: true,
                maxlength: 10,
                minlength: 10,
                digits: true,
            },
            date: {
                required: true,
                min: '{{ date("Y-m-d") }}',
                max: '{{ date("Y-m-d", strtotime(date("Y-m-d"). ' + 30 days')); }}',
            },
            time: {
                required: true,
            },
            doctor_name: {
                required: true,
            },
            note: {
                required: true,
                maxlength: 500,
            },
        },
        messages: {
            name: {
                required: "Please enter name",
                maxlength: "Your name maxlength should be 50 characters long."
            },
            email: {
                required: "Please enter valid email",
                email: "Please enter valid email",
                maxlength: "The email name should less than or equal to 50 characters",
            },
            phone: {
                required: "Please enter phone number",
                maxlength: "The phone number should less than or equal to 10 characters",
                minlength: "The phone number should less than or equal to 10 characters",
                digits: "The phone number should be digits",
            },
            date: {
                required: "Please enter date",
                min: "Please enter valid date",
                max: "Please enter valid date",
            },
            time: {
                required: "Please enter time",
            },
            doctor_name: {
                required: "Please select doctor",
            },
            note: {
                required: "Please enter note",
                maxlength: "The note should less than or equal to 500 characters",
            },

        },
        submitHandler: function(form) {
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var forms=$('#appointment_form');
            $('#submit').html('Please Wait...');
            $("#submit"). attr("disabled", true);
            $.ajax({
                url: forms.attr('action'),
                type: forms.attr('method'),
                data: forms.serialize(),
                success: function( response ) {
                    $('#submit').html('Submit');
                    $("#submit"). attr("disabled", false);
                    if(response.success){
                        Swal.fire(
                            'Success!',
                            response.success,
                            'success'
                        ).then(function(){
                            window.location.href = "";
                        });
                        $('#appointment_form')[0].reset();
                    }else{
                        Swal.fire(
                            'Error!',
                            response.message,
                            'error'
                        );
                    }
                }
            });
        }
    })
    }

    $(document).on('change','.datepicker-input',function(){
        $('.doctor-container').removeClass('d-none');
    });
    $(document).on('change','.doctor-name',function(){
        $('.timepicker-container').removeClass('d-none');
    });
    function timeOnChange()
    {
        $.ajax({
                url: "{{ route('customer.doctor-availability') }}",
                type: 'GET',
                data: {
                    'date': $('#date').val(),
                    'doctor_id': $('#doctor_name').val(),
                    'time': $('#time').val(),
                },
                success: function( response ) {
                    if(response.status=='success'){
                        $('.appointment-form-container').removeClass('d-none');
                    }else{
                        Swal.fire(
                            'Error!',
                            'Time slot not available',
                            'error'
                        );
                    }
                }
            });
    }
});
</script>
@endpush
