@extends('layouts.app')

@section('content')

<h2>Add Event</h2>

<form action="{{ route('events.store') }}" method="POST">

@csrf

<label>Event Name</label>

<input
type="text"
name="event_name"
value="{{ old('event_name') }}">

@error('event_name')
<p class="error">{{ $message }}</p>
@enderror

<label>Location</label>

<input
type="text"
name="location"
value="{{ old('location') }}">

@error('location')
<p class="error">{{ $message }}</p>
@enderror

<label>Date</label>

<input
type="date"
name="event_date">

@error('event_date')
<p class="error">{{ $message }}</p>
@enderror

<label>Capacity</label>

<input
type="number"
name="capacity">

@error('capacity')
<p class="error">{{ $message }}</p>
@enderror

<button>
Save Event
</button>

</form>

@endsection