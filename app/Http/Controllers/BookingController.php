<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /* -------------------------
        ADMIN CHECK
    --------------------------*/
    private function isAdmin()
    {
        return Auth::check() && Auth::user()->role === 'admin';
    }

    /* -------------------------
        INDEX (ADMIN + USER VIEW)
    --------------------------*/
    public function index()
    {
        $bookings = Booking::with('event')->latest()->get();

        return view('bookings.index', compact('bookings'));
    }

    /* -------------------------
        CREATE FORM
    --------------------------*/
    public function create()
    {
        $events = Event::all();

        $bookedDates = Booking::pluck('booking_time')
            ->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('Y-m-d H:i');
            })
            ->toArray();

        return view('bookings.create', compact(
            'events',
            'bookedDates'
        ));
    }

    /* -------------------------
        STORE BOOKING (USER)
    --------------------------*/
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|min:3',
            'booking_id' => 'required|alpha_num|size:8|unique:bookings',
            'event_id' => 'required|exists:events,id',
            'number_of_persons' => 'required|integer|min:1',
            'booking_time' => 'required|date',
            'confirmation_file' => 'required|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        // prevent double booking
        $exists = Booking::where('event_id', $request->event_id)
            ->where('booking_time', $request->booking_time)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Already booked at this time.');
        }

        // upload file
        $file = $request->file('confirmation_file');
        $filename = time() . '_' . $file->getClientOriginalName();

        $path = $file->storeAs('bookings', $filename, 'public');

        Booking::create([
            'customer_name' => $request->customer_name,
            'booking_id' => $request->booking_id,
            'event_id' => $request->event_id,
            'number_of_persons' => $request->number_of_persons,
            'booking_time' => $request->booking_time,
            'confirmation_file' => $path
        ]);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking created.');
    }

    /* -------------------------
        EDIT (ADMIN ONLY)
        --------------------------*/
    public function edit(Booking $booking)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Admin only');
        }

        $events = Event::all();

        return view('bookings.edit', compact('booking', 'events'));
    }
    /* -------------------------
        UPDATE (ADMIN ONLY)
    --------------------------*/
    public function update(Request $request, Booking $booking)
    {
        if (!$this->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'customer_name' => 'required|min:3',
            'booking_id' => 'required|alpha_num|size:8',
            'event_id' => 'required|exists:events,id',
            'number_of_persons' => 'required|integer|min:1'
        ]);

        $booking->update([
            'customer_name' => $request->customer_name,
            'booking_id' => $request->booking_id,
            'event_id' => $request->event_id,
            'number_of_persons' => $request->number_of_persons,
        ]);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking updated.');
    }

    /* -------------------------
        DELETE (ADMIN ONLY)
    --------------------------*/
    public function destroy(Booking $booking)
    {
        if (!$this->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        if (Storage::disk('public')->exists($booking->confirmation_file)) {
            Storage::disk('public')->delete($booking->confirmation_file);
        }

        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Booking deleted.');
    }

    /* -------------------------
        SUMMARY
    --------------------------*/
    public function summary()
    {
        $totalBookings = Booking::count();
        $totalEvents = Event::count();
        $totalPersons = Booking::sum('number_of_persons');

        $latestBookings = Booking::with('event')
            ->latest()
            ->take(10)
            ->get();

        return view('bookings.summary', compact(
            'totalBookings',
            'totalEvents',
            'totalPersons',
            'latestBookings'
        ));
    }

    /* -------------------------
        SHOW
    --------------------------*/
    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }
}