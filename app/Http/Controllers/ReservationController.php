<?php

namespace App\Http\Controllers;

use App\Models\{Event, Reservation};

use App\Services\ReservationService;

use App\Http\Requests\ReserveSeatRequest;

use Illuminate\Http\{Request, RedirectResponse};
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

use Throwable;

class ReservationController extends Controller
{
    public function __construct(private ReservationService $reservationService) {}

    /**
     * Show the form for reserving a seat for the given event.
     *
     * @param  Event $event
     * @return View
     */
    public function show(Event $event)
    {
        $reservedSeats = $event->reservations()
                           ->orderBy('seat_number')
                           ->pluck('seat_number')
                           ->toArray();

        return view('reservation.form', compact('event', 'reservedSeats'));
    }

    /**
     * Handle the reservation request.
     *
     * @param ReserveSeatRequest $request
     * @param  Event $event
     * @return RedirectResponse
     */
    public function reserve(ReserveSeatRequest $request, Event $event)
    {
        $validated = $request->validated();

        try {
            $reservation = $this->reservationService->reserveSeat($event, $validated['user_name']);

            return redirect()->route('reservation.success', ['reservation' => $reservation]);
        } catch (Throwable $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the reservation success page.
     *
     * @param  Reservation $reservation
     * @return View
     */
    public function success(Reservation $reservation)
    {
        $reservation->load('event');
        return view('reservation.success', ['reservation' => $reservation]);
    }
}

