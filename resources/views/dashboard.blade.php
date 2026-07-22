@extends('layouts.app')

@section('content')

<div style="max-width:1200px;margin:40px auto;">

    <h2 style="color:#2c6e63;font-size:30px;font-weight:bold;">
        Welcome, {{ Auth::user()->name }}
    </h2>

    <p style="color:#666;margin-bottom:30px;">
        Book your preferred spa schedule using the calendar below.
    </p>

    <div style="display:grid;
                grid-template-columns:300px 1fr;
                gap:25px;">

        <!-- Statistics -->
        <div style="background:white;
                    border-radius:12px;
                    padding:25px;
                    box-shadow:0 5px 15px rgba(0,0,0,.08);">

            <h3 style="margin-bottom:20px;color:#2c6e63;">
                Statistics
            </h3>

            <div style="margin-bottom:20px;">
                <h1 style="font-size:42px;color:#2c6e63;">
                    {{ $totalBookings }}
                </h1>

                <small>Total Bookings</small>
            </div>

            <div>
                <h1 style="font-size:42px;color:#2c6e63;">
                    {{ $totalUsers }}
                </h1>

                <small>Total Users</small>
            </div>

        </div>

        <!-- Calendar -->
        <div style="background:white;
                    border-radius:12px;
                    padding:20px;
                    box-shadow:0 5px 15px rgba(0,0,0,.08);">

            <h3 style="margin-bottom:20px;color:#2c6e63;">
                Booking Calendar
            </h3>

            <div id="calendar"></div>

        </div>

    </div>

</div>

@endsection
@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',

        height: 650,

        selectable: true,

        events: [
            @foreach($bookings as $booking)
            {
                title: 'BOOKED',
                start: '{{ \Carbon\Carbon::parse($booking->booking_time)->format("Y-m-d") }}',
                color: '#dc3545'
            },
            @endforeach
        ],

        dateClick: function(info){

            window.location.href =
                "/bookings/create?date=" + info.dateStr;

        }

    });

    calendar.render();

});

</script>


@endpush