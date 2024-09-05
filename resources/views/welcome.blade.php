<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div
        class="flex justify-center items-center min-h-screen bg-gray-100 bg-dots-lighter bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="justify-center mt-10 items-center">
            <x-chatgo-logo class="h-64 justify-center " />

            @if (Route::has('login'))
                <livewire:welcome.navigation />
            @endif
            
            <div class="text-center text-sm text-gray-500 text-gray-400">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>
    </div>
    </div>
</body>

</html>
