@extends('portal.layout')
@push('css')
<link rel="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
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
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Appointments</h4>
            </div>
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
                        <label class="custom-switch mt-2">
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                          </label></td>
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
<script>
    $(document).ready(function() {
        $('.table').DataTable();
    } );
    </script>
@endpush
