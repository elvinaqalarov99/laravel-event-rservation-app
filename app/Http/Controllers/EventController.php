<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the upcoming events.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $events = Event::orderBy('created_at', 'desc')->paginate(10);

        return view('event.events', ['events' => $events]);
    }
}
