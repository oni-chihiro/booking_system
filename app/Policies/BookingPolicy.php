<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Booking;

class BookingPolicy
{
    // User can view booking
    public function view(User $user, Booking $booking)
    {
        return $user->role === 'admin' || $user->id === $booking->user_id;
    }

    // User can update booking
    public function update(User $user, Booking $booking)
    {
        return $user->role === 'admin' || $user->id === $booking->user_id;
    }

    // User can delete booking
    public function delete(User $user, Booking $booking)
    {
        return $user->role === 'admin' || $user->id === $booking->user_id;
    }
}