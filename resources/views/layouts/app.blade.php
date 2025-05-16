<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Event Reservation') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Tailwind + Laravel Vite -->
</head>
<body class="bg-gray-100 text-gray-900 font-sans">

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">
                <a href="{{ route('events.index') }}">{{ config('app.name', 'Event Reservation') }}</a>
            </h1>
        </div>
    </header>

    <main class="py-8 px-4 max-w-4xl mx-auto">
        @if(session('message'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('message') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-white text-center py-4 border-t mt-12">
        <p class="text-sm text-gray-500">© {{ date('Y') }} Event Reservation App. All rights reserved.</p>
    </footer>

</body>
</html>
