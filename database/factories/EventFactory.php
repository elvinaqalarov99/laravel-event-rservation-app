<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = \App\Models\Event::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'total_seats' => 100,
            'available_seats' => 100,
        ];
    }
}
