@extends('layouts.app')

@section('content')

<div style="max-width:1450px;margin:40px auto;padding:20px;">

    <!-- Hero -->
    <div style="
        background:linear-gradient(135deg,#2c6e63,#4d9c88);
        color:white;
        padding:40px;
        border-radius:22px;
        box-shadow:0 20px 40px rgba(0,0,0,.12);
        margin-bottom:35px;
    ">

        <h1 style="font-size:40px;font-weight:bold;">
            My Reservations
        </h1>

        <p style="opacity:.9;font-size:18px;">
            View and manage your spa bookings.
        </p>

    </div>


    <!-- Top Bar -->

    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:30px;
    ">

        <input
            id="searchBooking"
            type="text"
            placeholder="🔍 Search booking..."
            style="
                width:320px;
                height:50px;
                border:1px solid #ddd;
                border-radius:12px;
                padding:0 18px;
                font-size:15px;
            ">

        <a href="{{ route('bookings.create') }}"
            style="
                background:#2c6e63;
                color:white;
                text-decoration:none;
                padding:14px 28px;
                border-radius:12px;
                font-weight:bold;
                box-shadow:0 8px 20px rgba(44,110,99,.25);
            ">

            + New Booking

        </a>

    </div>


    <!-- Statistics -->
<div style="
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-bottom:35px;
">

    <div class="stat-card">
        <h3>Total Bookings</h3>
        <h1>{{ $bookings->count() }}</h1>
    </div>

    <div class="stat-card">
        <h3>Pending</h3>
        <h1>{{ $bookings->where('status','pending')->count() }}</h1>
    </div>

    <div class="stat-card">
        <h3>Approved</h3>
        <h1>{{ $bookings->where('status','approved')->count() }}</h1>
    </div>

    <div class="stat-card">
        <h3>Cancelled</h3>
        <h1>{{ $bookings->where('status','cancelled')->count() }}</h1>
    </div>

</div>


    <!-- Booking Cards -->

    <div id="bookingList">

        @forelse($bookings as $booking)

        <div class="booking-card">

            <div class="booking-left">

            <h2 class="service-title">

            <i class="fa-solid fa-spa"></i>

            {{ $booking->event->event_name }}

            </h2>

                <p>

                    <strong>Booking ID</strong>

                    {{ $booking->booking_id }}

                </p>

                <p>

                    📅

                    {{ \Carbon\Carbon::parse($booking->booking_time)->format('F d, Y') }}

                </p>

                <p>

                    🕒

                    {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}

                </p>

                <p>

                    👥

                    {{ $booking->number_of_persons }}

                    Person(s)

                </p>

            </div>


            <div class="booking-right">

                @php
                    $status = strtolower($booking->status ?? 'pending');
                @endphp

                @if($status == 'approved')

                    <span class="badge approved">
                        Approved
                    </span>

                @elseif($status == 'cancelled')

                    <span class="badge cancelled">
                        Cancelled
                    </span>

                @else

                    <span class="badge pending">
                        Pending
                    </span>

                @endif

                <br><br>

                @if($booking->confirmation_file)

                <a
                    <i class="fa-solid fa-file-lines"></i>

                    Receipt
                

                </a>

                @endif

                <br><br>

                @if($status=='pending')

                <a
                    href="{{ route('bookings.edit',$booking->id) }}"
                    class="edit-btn">

                    Edit

                </a>

                @endif

            </div>

        </div>

        @empty

        <div style="
            background:white;
            padding:60px;
            text-align:center;
            border-radius:20px;
            box-shadow:0 15px 35px rgba(0,0,0,.08);
        ">

            <h2>No bookings yet.</h2>

        </div>

        @endforelse

    </div>

</div>

@endsection


@push('styles')

<style>

.stat-card{

background:white;

padding:25px;

border-radius:18px;

box-shadow:0 12px 30px rgba(0,0,0,.08);

text-align:center;

}

.stat-card h3{

color:#666;

margin-bottom:15px;

}

.stat-card h1{

font-size:45px;

color:#2c6e63;

}

.booking-card{

display:flex;

justify-content:space-between;

align-items:center;

background:white;

padding:30px;

border-radius:18px;

margin-bottom:20px;

box-shadow:0 12px 30px rgba(0,0,0,.08);

transition:.3s;

}

.booking-card:hover{

transform:translateY(-4px);

}

.booking-left h2{

color:#2c6e63;

margin-bottom:18px;

}

.booking-left p{

margin:8px 0;

color:#555;

}

.booking-right{

text-align:right;

}

.badge{

padding:8px 20px;

border-radius:25px;

font-weight:bold;

color:white;

}

.pending{

background:#f39c12;

}

.approved{

background:#27ae60;

}

.cancelled{

background:#e74c3c;

}

.action-btn{

background:#2c6e63;

color:white;

padding:10px 18px;

border-radius:10px;

text-decoration:none;

}

.edit-btn{

background:#3498db;

color:white;

padding:10px 18px;

border-radius:10px;

text-decoration:none;

}

</style>

@endpush


@push('scripts')

<script>

const search=document.getElementById('searchBooking');

search.addEventListener('keyup',function(){

let value=this.value.toLowerCase();

let cards=document.querySelectorAll('.booking-card');

cards.forEach(card=>{

card.style.display=

card.innerText.toLowerCase().includes(value)

? 'flex'

:'none';

});

});

</script>

@endpush