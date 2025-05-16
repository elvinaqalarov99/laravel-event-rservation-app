@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-xl mt-10">
        <h1 class="text-2xl font-bold text-green-600 mb-4">
            Reservation Successful for: {{ $reservation->event->name }}
        </h1>

        <p class="mb-4 text-gray-700">Thank you for reserving a seat!</p>

        <div class="mb-4">
            <h2 class="text-lg font-semibold mb-2">Your Reservation Details:</h2>
            <ul class="list-disc list-inside text-gray-800 space-y-1">
                <li><span class="font-medium">Event Name:</span> {{ $reservation->event->name }}</li>
                <li><span class="font-medium">Reserved by:</span> {{ $reservation->user_name }}</li>
                <li><span class="font-medium">Reservation ID:</span> {{ $reservation->id }}</li>
                <li><span class="font-medium">Reserved Seat Number:</span> {{ $reservation->seat_number }}</li>
                <li><span class="font-medium">Reservation Date:</span> {{ $reservation->created_at->format('F j, Y, g:i a') }}</li>
            </ul>
        </div>

        <a href="{{ route('events.index') }}"
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
            ← Back to Events
        </a>

        <p class="mt-6 text-gray-500 text-sm">
            We look forward to seeing you at the event!
        </p>
    </div>
@endsection
