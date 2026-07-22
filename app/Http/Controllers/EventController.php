<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->get();

        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|min:3',
            'location' => 'required',
            'event_date' => 'required|date',
            'capacity' => 'required|integer|min:1',
        ]);

        Event::create($request->all());

        return redirect()
            ->route('events.index')
            ->with('success', 'Event added successfully.');
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'event_name' => 'required|min:3',
            'location' => 'required',
            'event_date' => 'required|date',
            'capacity' => 'required|integer|min:1',
        ]);

        $event->update($request->all());

        return redirect()
            ->route('events.index')
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()
            ->route('events.index')
            ->with('success', 'Event deleted successfully.');
    }
}