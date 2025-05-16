@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6 text-gray-800">All Events</h1>

    @if($events->isEmpty())
        <p class="text-gray-600">No events available.</p>
    @else
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-gray-700 text-left">
                    <tr>
                        <th class="px-6 py-3 text-sm font-semibold">Event Name</th>
                        <th class="px-6 py-3 text-sm font-semibold">Total Seats</th>
                        <th class="px-6 py-3 text-sm font-semibold">Available Seats</th>
                        <th class="px-6 py-3 text-sm font-semibold"></th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-200">
                    @foreach($events as $event)
                        <tr>
                            <td class="px-6 py-4">{{ $event->name }}</td>
                            <td class="px-6 py-4">{{ $event->total_seats }}</td>
                            <td class="px-6 py-4">{{ $event->available_seats }}</td>
                            <td class="px-6 py-4">
                                @if($event->available_seats > 0)
                                    <a href="{{ route('reservation.form', $event) }}"
                                       class="inline-block bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700 transition">
                                        Reserve Seat
                                    </a>
                                @else
                                    <span class="text-red-500 font-semibold">Fully Booked</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
