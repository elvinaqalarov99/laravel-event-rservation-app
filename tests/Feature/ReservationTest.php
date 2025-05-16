<?php

namespace Tests\Feature;

use App\Models\{Event, Reservation};

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_view_reservation_form_with_reserved_seats_list()
    {
        $event = Event::factory()->create([
            'total_seats' => 5,
            'available_seats' => 3,
        ]);

        Reservation::factory()->create([
            'event_id' => $event->id,
            'seat_number' => 1,
            'user_name' => 'John',
        ]);

        $response = $this->get(route('reservation.form', $event));

        $response->assertStatus(200);
        $response->assertSee('Reserve a Seat for');
        $response->assertSee('Seat #1');
    }

    /** @test */
    public function user_can_reserve_a_seat_successfully()
    {
        $event = Event::factory()->create([
            'total_seats' => 2,
            'available_seats' => 2,
        ]);

        $response = $this->post(route('reservation.reserve', $event), [
            'user_name' => 'Darwin',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('reservations', [
            'event_id' => $event->id,
            'user_name' => 'Darwin',
            'seat_number' => 1,
        ]);

        $event->refresh();
        $this->assertEquals(1, $event->available_seats);
    }

    /** @test */
    public function reservation_fails_when_event_is_fully_booked()
    {
        $event = Event::factory()->create([
            'total_seats' => 1,
            'available_seats' => 0,
        ]);

        $response = $this->post(route('reservation.reserve', $event), [
            'user_name' => 'Darwin',
        ]);

        $response->assertSessionHasErrors('error');
        $this->assertDatabaseMissing('reservations', [
            'user_name' => 'Darwin',
        ]);
    }

    /** @test */
    public function reservation_requires_user_name()
    {
        $event = Event::factory()->create();

        $response = $this->post(route('reservation.reserve', $event), [
            'user_name' => '',
        ]);

        $response->assertSessionHasErrors('user_name');
    }
}
