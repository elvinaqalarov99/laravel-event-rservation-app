@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Reserve a Seat for: <span class="text-blue-600">{{ $event->name }}</span></h1>
        <p class="text-gray-600 mb-4">Available seats: <span class="font-medium">{{ $event->available_seats }}</span></p>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('reservation.reserve', $event) }}" class="space-y-4">
            @csrf
            <div>
                <label for="user_name" class="block text-sm font-medium text-gray-700">Your Name:</label>
                <input type="text" id="user_name" name="user_name" required
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition">
                Reserve Seat
            </button>
        </form>

        <div class="mt-6">
            @if(count($reservedSeats) > 0)
                <p class="font-semibold text-gray-700 mb-2">Reserved Seats:</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($reservedSeats as $seat)
                        <span class="inline-block bg-gray-200 text-sm text-gray-800 px-3 py-1 rounded-full">
                            Seat #{{ $seat }}
                        </span>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 mt-4">No seats have been reserved yet.</p>
            @endif
        </div>
    </div>
@endsection
