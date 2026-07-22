@extends('layouts.app')

@section('content')

<h2>📊 Booking Summary Report</h2>

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:15px;margin-top:20px;">

    <div style="padding:15px;background:#e8f5f2;border-radius:10px;">
        <h3>Total Bookings</h3>
        <p style="font-size:22px;">{{ $totalBookings }}</p>
    </div>

    <div style="padding:15px;background:#f2f7ff;border-radius:10px;">
        <h3>Total Events</h3>
        <p style="font-size:22px;">{{ $totalEvents }}</p>
    </div>

    <div style="padding:15px;background:#fff3e6;border-radius:10px;">
        <h3>Total Persons</h3>
        <p style="font-size:22px;">{{ $totalPersons }}</p>
    </div>

</div>

<hr style="margin:20px 0;">

<h3>Latest Bookings</h3>

<table border="1" width="100%" cellpadding="10" style="border-collapse:collapse;">
    <tr>
        <th>ID</th>
        <th>Customer</th>
        <th>Event</th>
        <th>Persons</th>
        <th>Time</th>
    </tr>

    @foreach($latestBookings as $booking)
    <tr>
        <td>{{ $booking->id }}</td>
        <td>{{ $booking->customer_name }}</td>
        <td>{{ $booking->event->event_name }}</td>
        <td>{{ $booking->number_of_persons }}</td>
        <td>{{ $booking->booking_time }}</td>
    </tr>
    @endforeach
</table>

@endsection