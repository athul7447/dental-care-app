@extends('portal.layout')
@push('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<style>
    .time{
        background-color: #fff !important;
    }
</style>
@endpush
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Reschedule Appointment</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('portal.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Reschedule Appointment</div>
      </div>
    </div>
</section>
<div class="container-xxl ">

    <div class="row">
        <div class="col-md-12">
              @if (session('error'))
                <div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                      <button class="close" data-dismiss="alert">
                        <span>×</span>
                      </button>
                      {{ session('error') }}
                    </div>
                  </div>
            @endif
            <div class="card mb-4">

                <!-- Account -->
            <form  method="POST" action="{{ route('portal.appointments.reschedule.update',$appointment->id) }}"  enctype="multipart/form-data">
                @csrf
              <hr class="my-0">
              <div class="card-body">
                  <div class="row">
                    <div class="mb-3 col-md-6">
                      <label for="name" class="form-label">Name</label>
                      <input class="form-control" type="text" id="name" name="name" value="{{ $appointment->name }}"  placeholder="enter name" readonly>
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="email" class="form-label">Email</label>
                      <input class="form-control" type="text" name="email" id="email" value="{{ $appointment->email }}" placeholder="enter email" readonly>
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="phone" class="form-label">Phone</label>
                      <input class="form-control" type="text" id="phone" name="phone" value="{{ $appointment->phone }}" placeholder="enter phone" readonly>
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="date" class="form-label">Date</label>
                      <input type="date" class="form-control" id="date" name="date"
                      value="{{ $appointment->date }}" placeholder="enter date" min="{{ date("Y-m-d") }}" max="{{ date('Y-m-d', strtotime(date("Y-m-d"). ' + 30 days')); }}">
                        @error('date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="phone">Time</label>
                        <input type="text" id="time" name="time" class="form-control time" value="{{{ $appointment->time }}}" readonly placeholder="enter time ">
                        @error('time')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="address" class="form-label">Doctor name</label>
                      <input type="text" id="doctor_name" name="doctor_name" class="form-control " value="{{ Auth::user()->name }}" readonly placeholder="enter time ">
                    </div>
                    <div class="mb-3 col-md-12">
                      <label for="password" class="form-label">Note</label>
                      <textarea name="note" id="note" cols="30" rows="5"  readonly class="form-control" placeholder="Write your notes or questions here...">{{ $appointment->note }}</textarea>
                    </div>
                  </div>
                  <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Reschedule</button>
                  </div>
                </form>
              </div>
              <!-- /Account -->
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
    $(document).ready(function(){
        $('#time').timepicker({
            interval: 30,
            minTime: '09:00',
            maxTime: '18:00',
            startTime: '09:00',
        });
    });
</script>
@endpush

