<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @if (session('status'))
            <div x-data="{ show: false }"
                x-init="() => {
                setTimeout(() => show = true, 500);
                setTimeout(() => show = false, 5000);
                }">

                <div x-show="show" role="alert" class="rounded-xl border border-gray-100 bg-white p-4 max-w-80 shadow absolute top-0 right-0 mt-4 mr-4">
                    <div class="flex items-start gap-4">
                
                    <div class="flex-1">
                        <strong class="block font-medium text-gray-900"> Changes saved </strong>
                
                        <p class="mt-1 text-sm text-gray-700">{{ session('status') }}</p>
                    </div>
                    </div>
                </div>
            </div>
        @endif
    </body>
</html>
