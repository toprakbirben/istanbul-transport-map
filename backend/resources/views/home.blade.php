<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Istanbul Transport Map</title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>

    <!-- Tailwind (CDN for now) -->
    <script src='https://cdn.tailwindcss.com'></script>

    <!-- TomTom Maps SDK -->
    <link
        rel='stylesheet'
        href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.23.0/maps/maps.css'
    />
    <script
        src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.23.0/maps/maps-web.min.js'
        defer
    ></script>

    <!-- Inject TomTom API key (server → client) -->
    <script>
        window.TOMTOM_API_KEY = '{{ config('services.tomtom.key') }}';
    </script>

    <!-- App scripts -->
    <script src='{{ asset('js/map.js') }}' defer></script>
    <script src='{{ asset('js/iett-buses.js') }}' defer></script>

    <style>
        #map {
            height: 520px;
        }
    </style>
</head>

<body class='min-h-screen bg-slate-900 text-slate-200 font-sans'>

    <div class='max-w-6xl mx-auto p-8'>
        <h1 class='text-4xl font-bold mb-4 text-sky-400 text-center'>
            Istanbul Transport Map
        </h1>

        <p class='text-lg leading-relaxed mb-8 text-indigo-200 text-center'>
            A visual exploration of Istanbul's public transport network using
            GTFS data and live IETT vehicles.
        </p>

        <p class="text-lg leading-relaxed mb-4 text-indigo-200 text-center">
            Filter by bus line:
        </p>

        <!-- Filter input -->
        <div class="flex justify-center mb-8">
            <input
                type="text"
                id="lineFilter"
                placeholder="Enter line (e.g., 48L)"
                class="px-4 py-2 rounded-lg border border-slate-700 text-slate-900"
            />
            <button
                id="applyFilter"
                class="ml-2 px-4 py-2 rounded-lg bg-sky-400 text-slate-900 hover:bg-sky-500"
            >
                Apply
            </button>
        </div>


        <!-- Map -->
        <div
            id='map'
            class='rounded-xl border border-slate-700 shadow-lg'
        ></div>

        <footer class='mt-8 text-sm text-slate-400 text-center'>
            Built with Laravel · TomTom · GTFS · Open Data
        </footer>
    </div>

</body>
</html>