<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Event::create([
            'name' => 'Laravel Conference 2025',
            'total_seats' => 100,
            'available_seats' => 100,
        ]);
    }
}
