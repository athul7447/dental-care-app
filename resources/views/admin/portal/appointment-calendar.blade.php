@extends('admin.layout')
@section('content')
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.css" >
@endpush
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Doctors/Appointments/</span>Calendar  </h4>
    <div class="row">
        <div class="card">
            <div class="col">
                <div id='calendar'></div>
              </div>
          </div>
    </div>
</div>
<div class="modal fade" id="calendarModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Appointment Status  </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <tbody>
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
                        <td id="note"></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td id="status"></td>
                    </tr>
                </tbody>
           </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
          </button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment-with-locales.min.js" integrity="sha512-vFABRuf5oGUaztndx4KoAEUVQnOvAIFs59y4tO0DILGWhQiFnFHiR+ZJfxLDyJlXgeut9Z07Svuvm+1Jv89w5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {

          initialView: 'dayGridMonth',
          dayMaxEvents: 3, // Can also be set as a boolean
          events: [
            @foreach ($appointments as $appointment)
                {
                    title: '{{ $appointment->name." / ".$appointment->email }}',
                    name:'{{ $appointment->name }}',
                    email:'{{ $appointment->email }}',
                    phone:'{{ $appointment->phone }}',
                    start:'{{ $appointment->date }}',
                    time:'{{ $appointment->time }}',
                    note:'{{ $appointment->note }}',
                    status:'{{ $appointment->status }}',
                    is_declined:'{{ $appointment->is_declined }}',
                    date:'{{ $appointment->date }}'
                },

            @endforeach

        ],
        eventClick: function(info) {
            var title = info.event.title;
            var name = info.event.extendedProps.name;
            var email = info.event.extendedProps.email;
            var phone = info.event.extendedProps.phone;
            var date = info.event.start;
            var time = info.event.extendedProps.time;
            var note = info.event.extendedProps.note;
            var status = info.event.extendedProps.status;
            var tempDate = new Date(date);
            var formattedDate = moment(tempDate).format('DD-MM-YYYY');
            $('#name').html(name);
            $('#email').html(email);
            $('#phone').html(phone);
            $('#date').html(formattedDate);
            $('#time').html(time);
            $('#note').html(note);
            if(info.event.extendedProps.is_declined == 1){
                $('#status').html('<span class="badge rounded-pill bg-danger">Declined</span>');
            }else{
                if(status == 0){
                        $('#status').html('<span class="badge rounded-pill bg-warning">Pending</span>');
                }else{
                    $('#status').html('<span class="badge rounded-pill bg-success">Approved</span>');
                }
            }
            $('#calendarModal').modal('show');
        }
        });
        calendar.render();
      });
    </script>
@endpush


@endsection
