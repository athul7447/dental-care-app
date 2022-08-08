@extends('portal.layout')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.css" >
    <style>
        #calendar .fc-day-wed, #calendar .fc-day-thu {
    background-color: rgb(0, 0, 0,0.07);
}
.fc-day-today {
    background: rgba(255, 220, 40, 0.15) !important;
    border: none !important;

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
    <div class="section-body">
          <div class="col">
            <div id='calendar'></div>
          </div>
    </div>
</section>
<div id="calendarModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="modalTitle" class="modal-title">Appointment Details</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
            </div>
            <div id="modalBody" class="modal-body">
                <table class="table table-hover table-striped">
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
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
                $('#status').html('<span class="badge badge-danger">Declined</span>');
            }else{
                if(status == 0){
                        $('#status').html('<span class="badge badge-warning">Pending</span>');
                }else{
                    $('#status').html('<span class="badge badge-success">Approved</span>');
                }
            }
            $('#calendarModal').modal();
        }
        });
        calendar.render();
      });
        </script>
@endpush
