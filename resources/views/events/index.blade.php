@extends('layouts.app')

@section('content')

<h2>Services / Rooms</h2>

<a href="{{ route('events.create') }}">
    <button>Add Service</button>
</a>

<br><br>

<table border="1" cellpadding="10" width="100%" style="border-collapse:collapse;">

    <tr style="background:#2c6e63; color:white;">
        <!-- <th>ID</th> -->
        <th>Service</th>
        <th>Location</th>
        <th>Date</th>
        <th>Capacity</th>
        <th>Actions</th>
    </tr>

    @foreach($events as $event)

    <tr>
        <!-- <td>{{ $event->id }}</td> -->
        <td>{{ $event->event_name }}</td>
        <td>{{ $event->location }}</td>
        <td>{{ $event->event_date }}</td>
        <td>{{ $event->capacity }}</td>

        <td>

            <a href="{{ route('events.edit',$event) }}">
                <button>Edit</button>
            </a>

            <form action="{{ route('events.destroy',$event) }}"
                  method="POST"
                  style="display:inline;">

                @csrf
                @method('DELETE')

                <button onclick="return confirm('Delete this event?')">
                    Delete
                </button>

            </form>

        </td>

    </tr>

    @endforeach

</table>

@endsection