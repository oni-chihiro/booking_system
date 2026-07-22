<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'event_name' => fake()->randomElement([
                'Conference Room',
                'Wedding Hall',
                'Training Room',
                'Auditorium',
                'Function Hall'
            ]),
            'location' => fake()->city(),
            'event_date' => fake()->date(),
            'capacity' => fake()->numberBetween(20, 500),
        ];
    }
}