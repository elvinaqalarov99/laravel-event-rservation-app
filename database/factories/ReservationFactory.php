<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = \App\Models\Reservation::class;

    public function definition()
    {
        return [
            'event_id' => \App\Models\Event::factory(),
            'user_name' => $this->faker->name(),
            'seat_number' => 1,
        ];
    }
}
