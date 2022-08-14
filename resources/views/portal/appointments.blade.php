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
                @if (session('success'))
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                      <button class="close" data-dismiss="alert">
                        <span>×</span>
                      </button>
                      {{ session('success') }}
                    </div>
                  </div>
            @endif
              <div class="table-responsive">
                <div class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer" id="table-2_wrapper">
                    <table class="table table-striped dataTable no-footer" id="sortable-table">
                    <thead class="text-center">

                        <tr>
                            <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date & Time</th>
                        <th>Note</th>
                        <th>Created at</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="ui-sortable text-center">
                        @foreach ($appointments as $appointment)
                        <tr>
                            <td>#{{ $appointment->id }}</td>
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
                            {{ $appointment->created_at }}
                        </td>
                        <td>
                            @if ($appointment->status == 1)
                                <span class="badge badge-success">Approved</span>
                            @elseif ($appointment->is_declined == 1)
                                <span class="badge badge-warning">Declined</span>
                            @elseif ($appointment->status == 0 && $appointment->date >= date('Y-m-d'))
                                <span class="badge badge-warning">Processing</span>
                            @elseif($appointment->status == 0 && $appointment->date < date('Y-m-d'))
                                <span class="badge badge-danger">Expired</span>
                            @endif
                        </td>
                        <td>
                            @if($appointment->is_declined == 1)
                            @elseif($appointment->status ==0 && $appointment->date >= date('Y-m-d'))
                                <a href="{{ route('portal.appointments.approve',$appointment->id) }}">
                                    <button class="btn btn-primary btn-sm" >Approve</button>
                                </a>
                                <a href="{{ route('portal.appointments.decline',$appointment->id) }}">
                                    <button class="btn btn-danger btn-sm">Decline</button>
                                </a>
                                <a href="{{ route('portal.appointments.reschedule',$appointment->id) }}">
                                    <button class="btn btn-warning btn-sm">Reschedule</button>
                                </a>
                                @if($appointment->is_note_added ==1)
                                <button type="button" class="btn btn-light btn-sm view-notes" data-id="{{ $appointment->id }}" data-toggle="modal" data-target="#exampleModalCenter">
                                    View Note
                                </button>
                                @endif
                                <button type="button" class="btn btn-light btn-sm get-data" data-id="{{ $appointment->id }}" data-toggle="modal" data-target="#exampleModal">
                                    Note
                                  </button>
                            @elseif($appointment->status ==1)
                                <a href="{{ route('portal.appointments.decline',$appointment->id) }}">
                                    <button class="btn btn-danger btn-sm">Decline</button>
                                </a>
                                <a href="{{ route('portal.appointments.reschedule',$appointment->id) }}">
                                    <button class="btn btn-warning btn-sm">Reschedule</button>
                                </a>
                                @if($appointment->is_note_added ==1)
                                <button type="button" class="btn btn-light btn-sm view-notes" data-id="{{ $appointment->id }}" data-toggle="modal" data-target="#exampleModalCenter">
                                    View Note
                                </button>
                                @else
                                <button type="button" class="btn btn-light btn-sm get-data" data-id="{{ $appointment->id }}" data-toggle="modal" data-target="#exampleModal">
                                    Note
                                  </button>
                                @endif
                            @else
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
      </div>

</section>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Patient Notes</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('portal.patient.note.store') }}" method="POST" id="form_id">
        <div class="modal-body">

            @csrf
            <div class="form-group">
                <label for="note">Note</label>
                <textarea class="form-control" id="note" name="note" rows="4" required></textarea>
            </div>
            <input type="hidden" name="appointment_id" value="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Patient note view</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table table-hover table-striped">
                <tbody>
                    <tr>
                        <td>Appointment ID</td>
                        <td id="appointment_id">  </td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td id="name"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td id="email"></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td id="phone"></td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td id="date"></td>
                    </tr>
                    <tr>
                        <td>Time</td>
                        <td id="time"></td>
                    </tr>
                    <tr>
                        <td>Note</td>
                        <td id="note_view"></td>
                    </tr>
                </tbody>
           </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.18/sweetalert2.min.js"
integrity="sha512-98hK38IvWQC069FFbq/la6NaBj4TGplZ118B+bFVOxsBQQL4EqKUWw9JkNh8Lem7FCGkLCxgr81q+/hRIemJCw=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('.table').DataTable({
        order: [[6, 'desc']],
        columnDefs: [
            {
                target: 6,
                visible: false,
                searchable: false,
            },
        ],
    });
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
    $('form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
        type: 'post',
        url: "{{ route('portal.patient.note.store') }}",
        data: $('form').serialize(),
        success: function (data) {
            data.status == 'success' ? Swal.fire(
                    'Success!',
                    'Suceessfully Added',
                    'success'
                    ) : Swal.fire(
                    'Error!',
                    'something went wrong',
                    'error'
                    );
        }
        });
    });

    $('.get-data').on('click', function(){
        var appointment_id = $(this).data('id');
        $('input[name="appointment_id"]').val(appointment_id);
        $.ajax({
            type: 'get',
            url: "{{ route('portal.patient.note.get') }}",
            data: {
                appointment_id: appointment_id
            },
            success: function (data) {
                var note = data.note;
                $('input[name="appointment_id"]').val(appointment_id);
                if(note){
                $('#form_id').find('textarea[name="note"]').val(data.note.note);
                }else{
                    $('#form_id').find('textarea[name="note"]').val('');
                }
            }
        });

    });

    $('.view-notes').on('click', function(){
        var appointment_id = $(this).data('id');
        $.ajax({
            type: 'get',
            url: "{{ route('portal.patient.note.get') }}",
            data: {
                appointment_id: appointment_id
            },
            success: function (data) {
                $('#appointment_id').text('#'+data.note.appointment_id);
                $('#name').text(data.note.appointment.name);
                $('#email').text(data.note.appointment.email);
                $('#phone').text(data.note.appointment.phone);
                $('#date').text(data.note.appointment.date);
                $('#time').text(data.note.appointment.time);
                $('#note_view').text(data.note.note);
            }
        });

    });
    </script>
@endpush
