@extends('layouts.app')

@section('content')

<div class="summary-card">
<h2>Booking Confirmation</h2>
<p>
    Thank you for choosing Serenity Spa.
    Your booking has been successfully recorded.
</p>
<p><strong>Transaction No:</strong>{{ session('transaction_no') }}</p>
<p>
    <strong>Status:</strong>
    <span style="
        background:#d4edda;
        color:#155724;
        padding:5px 10px;
        border-radius:10px;">
        Confirmed
    </span>
</p>
<p><strong>Date Submitted:</strong>{{ session('submitted_at') }}</p>

<hr>
<h3>Booking Information</h3>
<p><strong>Customer Name:</strong>{{ session('customer_name') }}</p>
<p><strong>Booking ID:</strong>{{ session('booking_id') }}</p>
<p><strong>Room Name:</strong> {{ session('room_name') }}</p>
<p><strong>Number of Person:</strong>{{ session('number_of_person') }}</p>

<hr>
<h2>Spa Service Information</h2>
<p><strong>Spa Service:</strong> {{ session('product') }}</p>
<p><strong>Quantity:</strong>{{ session('quantity') }}</p>
<p><strong>Price:</strong> ₱{{ number_format(session('price'), 2) }}</p>
<p><strong>Total:</strong> ₱{{ number_format(session('total'), 2) }}</p>
<hr>
</div>

<h3>Uploaded Files</h3>

@if(session('documents'))
    <ul>
        @foreach(session('documents') as $file)
            <li>
                <a href="{{ asset('storage/'.$file) }}" target="_blank">
                    {{ basename($file) }}
                </a>

                @if(in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg','jpeg','png']))
                    <br>
                    <img src="{{ asset('storage/'.$file) }}"
                    style="
                        width:200px;
                        border-radius:15px;
                        margin-top:10px;
                        box-shadow:0 4px 10px rgba(0,0,0,0.2);
                        object-fit:cover;
                    ">
                @endif
            </li>
            <br>
        @endforeach
    </ul>
@endif

<form action="/" method="GET">
    <button type="submit">
        Create New Booking
    </button>
</form>

@endsection