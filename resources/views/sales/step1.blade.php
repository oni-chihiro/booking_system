@extends('layouts.app')

@section('content')

<h2>Customer Information</h2>

<form action="{{ route('sales.store',1) }}" method="POST">
    @csrf

    <label>Customer Name</label>
    <input type="text" name="customer_name"
           value="{{ old('customer_name') }}">

    @error('customer_name')
        <p class="error">{{ $message }}</p>
    @enderror

    <label>Booking ID</label>
    <input type="text" name="booking_id"
           value="{{ old('booking_id') }}">

    @error('booking_id')
        <p class="error">{{ $message }}</p>
    @enderror

    <label>Room Name</label>
    <input type="text" name="room_name"
           value="{{ old('room_name') }}">

    @error('room_name')
        <p class="error">{{ $message }}</p>
    @enderror

    <label>Number of Person</label>
    <input type="number"
        name="number_of_person"
        min="1"
        max="50"
        value="{{ old('number_of_person') }}">

    @error('number_of_person')
        <p class="error">{{ $message }}</p>
    @enderror

    <button type="submit">Next</button>
</form>

@endsection