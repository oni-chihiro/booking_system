@extends('layouts.app')

@section('content')

<style>

body{
    background:#f4f7fb;
    font-family:'Segoe UI',sans-serif;
}

.page-container{
    max-width:1100px;
    margin:40px auto;
    padding:20px;
}

.hero{
    background:linear-gradient(135deg,#2c6e63,#58b09c);
    color:white;
    border-radius:22px;
    padding:45px;
    margin-bottom:35px;
    box-shadow:0 15px 35px rgba(0,0,0,.15);
}

.hero h1{
    font-size:42px;
    margin:0;
    font-weight:700;
}

.hero p{
    margin-top:10px;
    font-size:18px;
    opacity:.9;
}

.form-card{
    background:#fff;
    border-radius:22px;
    padding:40px;
    box-shadow:0 15px 35px rgba(0,0,0,.08);
}

.form-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:25px;
}

.form-group{
    display:flex;
    flex-direction:column;
}

.form-group label{
    margin-bottom:8px;
    font-weight:600;
    color:#374151;
}

.form-group input,
.form-group select{
    width:100%;
    padding:14px 16px;
    border:1px solid #d1d5db;
    border-radius:12px;
    font-size:15px;
    transition:.25s;
}

.form-group input:focus,
.form-group select:focus{
    outline:none;
    border-color:#2c6e63;
    box-shadow:0 0 0 4px rgba(44,110,99,.12);
}

.error{
    color:#dc2626;
    margin-top:6px;
    font-size:14px;
}

.button-group{
    display:flex;
    justify-content:flex-end;
    gap:15px;
    margin-top:35px;
}

.btn{
    padding:14px 30px;
    border:none;
    border-radius:12px;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
    text-decoration:none;
    transition:.25s;
}

.btn-update{
    background:#2c6e63;
    color:white;
}

.btn-update:hover{
    background:#24584f;
}

.btn-cancel{
    background:#e5e7eb;
    color:#374151;
}

.btn-cancel:hover{
    background:#d1d5db;
}

@media(max-width:768px){

.form-grid{
    grid-template-columns:1fr;
}

.hero h1{
    font-size:32px;
}

.button-group{
    flex-direction:column;
}

.btn{
    width:100%;
}

}

</style>

<div class="page-container">

    <div class="hero">

        <h1>✏️ Edit Booking</h1>

        <p>
            Update your reservation information below.
        </p>

    </div>

    <div class="form-card">

        <form action="{{ route('bookings.update',$booking) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="form-group">

                    <label>Customer Name</label>

                    <input
                        type="text"
                        name="customer_name"
                        value="{{ old('customer_name',$booking->customer_name) }}">

                    @error('customer_name')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">

                    <label>Booking ID</label>

                    <input
                        type="text"
                        name="booking_id"
                        value="{{ old('booking_id',$booking->booking_id) }}">

                    @error('booking_id')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">

                    <label>Select Event</label>

                    <select name="event_id">

                        @foreach($events as $event)

                            <option
                                value="{{ $event->id }}"
                                {{ $booking->event_id == $event->id ? 'selected' : '' }}>

                                {{ $event->event_name }}

                            </option>

                        @endforeach

                    </select>

                    @error('event_id')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">

                    <label>Number of Persons</label>

                    <input
                        type="number"
                        min="1"
                        name="number_of_persons"
                        value="{{ old('number_of_persons',$booking->number_of_persons) }}">

                    @error('number_of_persons')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>

            </div>

            <div class="button-group">

                <a href="{{ route('bookings.index') }}" class="btn btn-cancel">
                    Cancel
                </a>

                <button type="submit" class="btn btn-update">
                    Update Booking
                </button>

            </div>

        </form>

    </div>

</div>

@endsection