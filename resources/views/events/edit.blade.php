@extends('layouts.app')

@section('content')

<h2>Edit Event</h2>

<form action="{{ route('events.update',$event) }}" method="POST">

@csrf
@method('PUT')

<label>Event Name</label>

<input
type="text"
name="event_name"
value="{{ old('event_name',$event->event_name) }}">

@error('event_name')
<p class="error">{{ $message }}</p>
@enderror

<label>Location</label>

<input
type="text"
name="location"
value="{{ old('location',$event->location) }}">

@error('location')
<p class="error">{{ $message }}</p>
@enderror

<label>Date</label>

<input
type="date"
name="event_date"
value="{{ $event->event_date }}">

@error('event_date')
<p class="error">{{ $message }}</p>
@enderror

<label>Capacity</label>

<input
type="number"
name="capacity"
value="{{ $event->capacity }}">

@error('capacity')
<p class="error">{{ $message }}</p>
@enderror

<button>
Update Event
</button>

</form>

@endsection