<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Styles -->

        <style>
            [x-cloak] { display: none !important; }
        </style>
        @livewireStyles
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="">
    <div class="container flex flex-col justify-center mx-auto px-8 pt-16" x-data="{isEdit:false}">
        <h2 class="text-2xl lg:text-3xl font-bold mb-9 text-center text-gray-900">
            Patients Data
        </h2>
        <div class="flex flex-col md:flex-row px-3 py-3 bg-gray-100 mb-3 justify-between rounded shadow-inner">
            <button class="text-gray-900 mb-1 md:mb-0 hover:text-white hover:bg-gray-900 border-solid
                           border border-gray-700 font-semibold py-2 px-4 rounded">Export</button>
            <button class="text-blue-600 hover:text-white hover:bg-blue-600 border-solid
                           border border-gray-700 font-semibold py-2 px-4 rounded">Create New Patient</button>
        </div>
        <livewire:patient-table />
    </div>

        @livewireScripts
    </body>
</html>
