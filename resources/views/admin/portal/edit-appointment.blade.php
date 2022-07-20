@extends('admin.layout')
@section('content')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endpush
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Doctors /Appointments/</span> Edit </h4>
    <div class="row">
        <div class="col-md-12">
              @if (session('error'))
              <div class="alert alert-danger alert-dismissible" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card mb-4">

                <!-- Account -->
            <form  method="POST" action="{{ route('admin.portal.doctors.appointments.update',[request()->route('doctor_id'),request()->route('appointment_id')]) }}"  enctype="multipart/form-data">
                @csrf
              <hr class="my-0">
              <div class="card-body">
                  <div class="row">
                    <div class="mb-3 col-md-6">
                      <label for="name" class="form-label">Name</label>
                      <input class="form-control" type="text" id="name" name="name" value="{{ $appointment->name }}" autofocus="" placeholder="enter name">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="email" class="form-label">Email</label>
                      <input class="form-control" type="text" name="email" id="email" value="{{ $appointment->email }}" placeholder="enter email">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="phone" class="form-label">Phone</label>
                      <input class="form-control" type="text" id="phone" name="phone" value="{{ $appointment->phone }}" placeholder="enter phone">
                      @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="date" class="form-label">Date</label>
                      <input type="date" class="form-control" id="date" name="date"
                      value="{{ $appointment->date }}" placeholder="enter date">
                        @error('date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="phone">Time</label>
                        <input type="text" id="time" name="time" class="form-control" value="{{{ $appointment->time }}}" readonly placeholder="enter time number">
                        @error('time')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="address" class="form-label">Doctor Name</label>
                      <select name="doctor_name" id="doctor_name" class="form-control">
                        <option value="">select</option>
                        @foreach ($doctors as $doctor)
                          <option value="{{ $doctor->id }}" @if($appointment->doctor_id==$doctor->id) selected @endif>{{ $doctor->name }}</option>
                        @endforeach
                      </select>
                      @error('doctor_name')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3 col-md-12">
                      <label for="password" class="form-label">Note</label>
                      <textarea name="note" id="note" cols="30" rows="5" class="form-control" placeholder="Write your notes or questions here...">{{ $appointment->note }}</textarea>
                        @error('note')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                  <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                  </div>
                </form>
              </div>
              <!-- /Account -->
            </div>
        </div>
    </div>
</div>
@push('scripts')
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
        });
    });

    </script>
</script>
@endpush
@endsection
