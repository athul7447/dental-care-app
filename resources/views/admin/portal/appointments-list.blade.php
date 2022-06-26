@extends('admin.layout')
@section('content')
@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <style>
       .verify .form-check-input:checked, .form-check-input[type=checkbox]:indeterminate {
    background-color: #047a35 !important;
    border-color: #047a35!important;
}
        </style>
@endpush
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Doctors /</span>   Appointments </h4>
    <div class="row">
        <div class="card">

            <div class="table-head p-3">
                <div class="col-md-2">
                    <a href="{{ route('admin.portal.doctors.calendar',$doctorId) }}">
                    <button type="button" class="btn rounded-pill btn-warning">View Calendar</button>
                    </a>
                </div>
                @if (session('message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                </a>
            </div>
            <div class="table-responsive text-nowrap ">
              <table class="table table-striped datatable">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date/Time</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->name }}</td>
                        <td>{{ $appointment->email }}</td>
                        <td>{{ $appointment->phone }}</td>
                        <td>{{ $appointment->date."/".$appointment->time }}</td>
                        <td >{{ $appointment->note }}</td>
                        <td>
                            @if($appointment->date >= date('Y-m-d'))
                                @if($appointment->is_declined == 1)
                                <a href="{{ route('admin.portal.doctors.appointments.decline',[$doctorId,$appointment->id]) }}">
                                    <button class="btn btn-warning btn-sm">Declined</button>
                                </a>
                                @else
                                    @if($appointment->status == 0)
                                        <a href="{{ route('admin.portal.doctors.appointments.approve',[$doctorId,$appointment->id]) }}">
                                            <button class="btn btn-primary btn-sm" >Approve</button>
                                        </a>
                                        <a href="{{ route('admin.portal.doctors.appointments.decline',[$doctorId,$appointment->id]) }}">
                                            <button class="btn btn-danger btn-sm">Decline</button>
                                        </a>
                                    @else
                                    <a href="{{ route('admin.portal.doctors.appointments.approve',[$doctorId,$appointment->id]) }}">
                                        <button class="btn btn-success btn-sm" >Approved</button>
                                    @endif
                                @endif
                            @else
                                <span class="badge rounded-pill bg-danger">Expired</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.portal.doctors.appointments.edit',[$doctorId,$appointment->id]) }}" class="btn btn-sm btn-primary">
                                <i class="bx bx-edit"></i>
                            </a>
                            <a href="{{ route('admin.portal.doctors.appointments.delete',[$doctorId,$appointment->id]) }}" class="btn btn-sm btn-danger">
                                <i class="bx bx-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
    </div>
</div>

@push('scripts')
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('.datatable').DataTable();
        } );
    </script>
@endpush


@endsection
