@extends('admin.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <!--/ Total Revenue -->
      <div class="col">
        <div class="row">
          <div class="col-3 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <i class="fa fa-calendar fa-2x text-info" aria-hidden="true"></i>
                  </div>
                </div>
                <span class="d-block mb-1">Total Appointments</span>
                <h3 class="card-title text-nowrap mb-2">{{ $allAppointmentsCount }}</h3>
              </div>
            </div>
          </div>


          <div class="col-3 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <i class="fas fa-user-md fa-2x text-warning"></i>
                  </div>
                </div>
                <span class="d-block mb-1">Total Doctors</span>
                <h3 class="card-title text-nowrap mb-2">{{ $allDoctorsCount }}</h3>
              </div>
            </div>
          </div>


          <div class="col-3 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <i class="far fa-bell fa-2x text-success"></i>
                  </div>
                </div>
                <span class="d-block mb-1 w-100">Today's Appointment</span>
                <h3 class="card-title text-nowrap mb-2">{{ $todaysAppointmentCount }}</h3>
              </div>
            </div>
          </div>


          <div class="col-3 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <i class="fas fa-user-clock fa-2x text-danger"></i>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Total Declined Appointments</span>
                <h3 class="card-title mb-2">{{ $totalDeclinedAppointmentCount }}</h3>
              </div>
            </div>
          </div>
          <!-- </div> -->
        </div>
      </div>
    </div>
  </div>
  @endsection
