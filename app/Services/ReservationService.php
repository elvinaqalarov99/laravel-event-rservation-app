<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Throwable;
use RuntimeException;

class ReservationService
{
    /**
     * Reserve a seat for a user at a specific event.
     *
     * @param Event $event
     * @param string $userName
     * @return Reservation
     * @throws Throwable
     */
    public function reserveSeat(Event $event, string $userName): Reservation
    {
        return DB::transaction(function () use ($event, $userName) {
            // Lock event row for update to avoid race conditions
            $lockedEvent = Event::where('id', $event->id)->lockForUpdate()->firstOrFail();

            if ($lockedEvent->available_seats <= 0) {
                throw new RuntimeException('Sorry, this event is fully booked.');
            }

            $lastSeatNumber = Reservation::where('event_id', $lockedEvent->id)
                                        ->lockForUpdate()
                                        ->max('seat_number');
            $nextSeatNumber = $lastSeatNumber ? $lastSeatNumber + 1 : 1;

            if ($nextSeatNumber > $lockedEvent->total_seats) {
                throw new RuntimeException('Sorry, this event is fully booked.');
            }

            $reservation = Reservation::create([
                'event_id' => $lockedEvent->id,
                'user_name' => $userName,
                'seat_number' => $nextSeatNumber,
            ]);

            $lockedEvent->decrement('available_seats');

            return $reservation;
        });
    }
}
