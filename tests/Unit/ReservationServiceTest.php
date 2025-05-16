<?php

namespace Tests\Unit;

use App\Models\{Event, Reservation};

use App\Services\ReservationService;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

use RuntimeException;

class ReservationServiceTest extends TestCase
{
    use RefreshDatabase;

    protected ReservationService $reservationService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->reservationService = new ReservationService();
    }

    /** @test */
    public function it_reserves_a_seat_successfully()
    {
        $event = Event::factory()->create([
            'total_seats' => 3,
            'available_seats' => 3,
        ]);

        $reservation = $this->reservationService->reserveSeat($event, 'John');

        $this->assertInstanceOf(Reservation::class, $reservation);
        $this->assertEquals(1, $reservation->seat_number);
        $this->assertEquals('John', $reservation->user_name);

        $event->refresh();
        $this->assertEquals(2, $event->available_seats);
    }

    /** @test */
    public function it_throws_exception_if_no_seats_available()
    {
        $event = Event::factory()->create([
            'total_seats' => 1,
            'available_seats' => 0,
        ]);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Sorry, this event is fully booked.');

        $this->reservationService->reserveSeat($event, 'John');
    }
}
