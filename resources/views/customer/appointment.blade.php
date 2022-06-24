@extends('customer.layout')
@push('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.18/sweetalert2.css" integrity="sha512-p06JAs/zQhPp/dk821RoSDTtxZ71yaznVju7IHe85CPn9gKpQVzvOXwTkfqCyWRdwo+e6DOkEKOWPmn8VE9Ekg=="
crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .timepicker .form-control:disabled, .form-control[readonly] {
    background-color: #ffffff !important;
    opacity: 1;
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
              <div class="col-md-6 mb-3 mb-md-0">
                <label class="font-weight-bold" for="fname">Name</label>
                <input type="text" id="fname" class="form-control" name="name" placeholder="Enter your name" value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-6">
                <label class="font-weight-bold" for="email">Email</label>
                <input type="email" id="email" class="form-control" name="email" placeholder="Enter your email" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <label class="font-weight-bold" for="lname">Phone</label>
                    <input type="text" id="lname" class="form-control" name="phone" placeholder="Enter your phone" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
              <div class="col-md-6 mb-3 mb-md-0">
                <label class="font-weight-bold" for="date">Date</label>
                <input type="date" id="date" class="form-control datepicker px-2" name="date" placeholder="Date of visit" value="{{ old('date') }}" min="<?php echo date("Y-m-d"); ?>">
                @error('date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <label class="font-weight-bold timepicker" for="time">Time</label>
                    <input type="text" readonly id="time" class="form-control timepicker" name="time" placeholder="Time" value="{{ old('time') }}">
                    @error('time')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                  </div>
              <div class="col-md-6 mb-3 mb-md-0">
                <label class="font-weight-bold" for="treatment">Select Doctor</label>
                <select name="doctor_name" id="doctor_name" class="form-control">
                  <option value="">select</option>
                  @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}" @if(old('doctor_name')==$doctor->id) selected @endif>{{ $doctor->name }}</option>
                  @endforeach
                </select>
                @error('doctor_name')
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
                <input type="submit" value="Send" class="btn btn-primary">
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>
  @endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.18/sweetalert2.min.js" integrity="sha512-98hK38IvWQC069FFbq/la6NaBj4TGplZ118B+bFVOxsBQQL4EqKUWw9JkNh8Lem7FCGkLCxgr81q+/hRIemJCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js">
</script>
<script>
    $(document).ready(function(){
    $('#time').timepicker({
        interval: 30,
        minTime: '09:00',
        maxTime: '18:00',
        startTime: '09:00',
    });
    @if(session('success'))
    Swal.fire(
            'Success!',
            'Appointment has been submitted successfully',
            'success'
            );
    @endif
    @if(session('error'))
    Swal.fire(
            'Error!',
            '{{ session("error") }}',
            'error'
            );
    @endif

});
window.onload = (event) => {
  window.location.href = '{{route("customer.appointment")  }}'+'#appointment-form';
};
    </script>
@endpush
