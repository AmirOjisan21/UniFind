<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Unifind</title>

    {{-- Sini kena letak  manually script dia cok --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('comp.menu')

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script src="/node_modules/leaflet-rotate/leaflet.rotate.js"></script>
    <link rel="stylesheet" href="/node_modules/leaflet-rotate/leaflet.rotate.css"> 
</head>

<body class="antialiased ">
    <div class="pt-10 text-center font-mono text-2xl font-medium">
        <h1>UPSI EVENTS</h1>
    </div>
    <div class=" ">
        <div id="calendar" class="h-96 px-10"></div>
    </div>
    <div class="py-10 px-10">
        <div class="pt-10 text-center font-mono text-2xl font-medium">
            <h1>UPCOMING AND CURENT UPSI EVENTS</h1>
        </div>
        <div class="grid-cols-3 grid gap-6 font-mono py-8">
            @foreach ($events as $event)
            <div
                class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                    <img class="rounded-t-lg w-full h-72 object-cover" src="{{ asset("images/{$event->image}") }}" alt="" />
                <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $event->name }}</h5>
                    <p class="mb-3 font-normal text-gray-700">Start:{{ $event->start_date }}</p>
                    <p class="mb-3 font-normal text-gray-700">End:{{ $event->end_date }}</p>
                    <a href="{{ route('eventlocation', $event->id) }}"
                        id="location-{{ $event->id }}"class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Details
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
                            aria-hidden="true"xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                    <a href="{{ route('eventnav', $event->id) }}"
                        id="location-{{ $event->id }}"class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        See Directions
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
                            aria-hidden="true"xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
<script>
    // var calendar = new FullCalendar.Calendar(calendarEl, {
    //     initialView: 'timeGrid',
    //     visibleRange: {
    //         start: '2024-04-17',
    //         end: '2024-04-19'
    //     }
    // });

    document.addEventListener('DOMContentLoaded', function() {
        var events = @json($cevents);
        const calendarEl = document.getElementById('calendar')
        // const calendar = new FullCalendar.Calendar(calendarEl, {
        //     initialView: 'dayGridMonth'
        // })
        // calendar.render()
        console.log(events)
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: events
        });
        calendar.render()
    })
</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
