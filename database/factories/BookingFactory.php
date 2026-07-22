<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => \App\Models\Event::factory(),

            'customer_name' => fake()->name(),

            'booking_id' => strtoupper(fake()->bothify('BK####')),

            'number_of_persons' => fake()->numberBetween(1, 20),

            'confirmation_file' => 'sample.pdf',

            // ADD THIS
            'booking_time' => fake()->dateTime(),
        ];
    }
}