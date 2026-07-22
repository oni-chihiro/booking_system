<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
    'customer_name',
    'booking_id',
    'event_id',
    'number_of_persons',
    'confirmation_file',
    'booking_time' // ✅ ADD THIS
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}