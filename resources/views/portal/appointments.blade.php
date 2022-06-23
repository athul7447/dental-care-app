@extends('portal.layout')
@push('css')
<link rel="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.18/sweetalert2.css"
integrity="sha512-p06JAs/zQhPp/dk821RoSDTtxZ71yaznVju7IHe85CPn9gKpQVzvOXwTkfqCyWRdwo+e6DOkEKOWPmn8VE9Ekg=="
crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .dataTables_filter{
        text-align: end !important;
    }
    .pagination{
        justify-content: end !important;
    }
    </style>
@endpush
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Appointments</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('portal.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Appointments</div>
      </div>
    </div>
    <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-striped" id="sortable-table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Date & Time</th>
                      <th>Note</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="ui-sortable">
                    @foreach ($appointments as $appointment)
                    <tr>
                      <td>
                        {{$appointment->name}}
                      </td>
                      <td>{{$appointment->email}}</td>
                      <td>
                        {{$appointment->phone}}
                      </td>
                      <td>{{$appointment->date.'/'.$appointment->time}}</td>
                      <td>{{$appointment->note}}</td>
                      <td>
                        @if($appointment->date >= date('Y-m-d'))
                            @if($appointment->is_declined == 1)
                                <span class="badge badge-danger">Declined</span>
                            @else
                                @if($appointment->status == 0)
                                    <a href="{{ route('portal.appointments.approve',$appointment->id) }}">
                                        <button class="btn btn-primary btn-sm" >Approve</button>
                                    </a>
                                    <a href="{{ route('portal.appointments.decline',$appointment->id) }}"><button class="btn btn-danger btn-sm">Decline</button></a>
                                @else
                                    <span class="badge badge-success" >Approved</span>
                                @endif
                            @endif
                        @else
                            <span class="badge badge-danger">Expired</span>
                        @endif

                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

</section>
@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.18/sweetalert2.min.js"
integrity="sha512-98hK38IvWQC069FFbq/la6NaBj4TGplZ118B+bFVOxsBQQL4EqKUWw9JkNh8Lem7FCGkLCxgr81q+/hRIemJCw=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('.table').DataTable();
        @if(session('success'))
            Swal.fire(
                    'Success!',
                    '{{ session("success") }}',
                    'success'
                    );
        @elseif(session('error'))
        Swal.fire(
                'Error!',
                '{{ session("error") }}',
                'error'
                );
        @endif
    } );
    </script>
@endpush
