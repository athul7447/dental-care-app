@extends('portal.layout')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.css" >
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
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 id="modalTitle" class="modal-title"></h4>
            </div>
            <div id="modalBody" class="modal-body"> </div>
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
            { // this object will be "parsed" into an Event Object
            title: 'Booking1', // a property!
            start: '2022-06-01', // a property!
            end: '2018-06-01' // a property! ** see important note below about 'end' **
            },
            { // this object will be "parsed" into an Event Object
            title: 'Booking2', // a property!
            start: '2022-06-01', // a property!
            end: '2018-06-01' // a property! ** see important note below about 'end' **
            },
            { // this object will be "parsed" into an Event Object
            title: 'Booking3', // a property!
            start: '2022-06-01', // a property!
            end: '2018-06-01' // a property! ** see important note below about 'end' **
            },
            { // this object will be "parsed" into an Event Object
            title: 'Booking4', // a property!
            start: '2022-06-01', // a property!
            end: '2018-06-01' // a property! ** see important note below about 'end' **
            },
            { // this object will be "parsed" into an Event Object
            title: 'Booking5', // a property!
            start: '2022-06-01', // a property!
            end: '2018-06-01' // a property! ** see important note below about 'end' **
            },
            { // this object will be "parsed" into an Event Object
            title: 'Booking6', // a property!
            start: '2022-06-01', // a property!
            end: '2018-06-01' // a property! ** see important note below about 'end' **
            },
        ],
        eventClick: function(info) {
            $('#modalTitle').html(info.event.title);
            $('#modalBody').html(info.event.title);
            $('#eventUrl').attr('href',info.event.title);
            $('#calendarModal').modal();
        }
        });
        calendar.render();
      });
        </script>
@endpush
