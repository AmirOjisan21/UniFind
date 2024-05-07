<x-app-layout>
    <x-slot name="event">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg justify-center">
                <div class="p-6 text-gray-900 justify-center">
                    <div class="flex justify-center">
                        <div class="w-full md:w-6/12">
                            <div class="bg-white shadow-md rounded-lg">
                                <div class="bg-gray-200 px-4 py-2">{{ __('Events') }}</div>
                                <div class="px-4 py-4">
                                    <table class="table-auto">
                                        <tbody>
                                            <tr>
                                                <td class="font-semibold">{{ __('name') }}</td>
                                                <td>{{ $event->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-semibold">{{ __('description') }}</td>
                                                <td>{{ $event->description }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-semibold">{{ __('Start Date') }}</td>
                                                
                                                <td>{{ $event->start_date }}</td>
                                           
                                            </tr>
                                            <tr>
                                                <td class="font-semibold">{{ __('End Date') }}</td>

                                                <td>{{ $event->end_date }}</td>
                                                
                                            </tr>
                                            <tr>
                                                <td class="font-semibold">{{ __('latitude') }}</td>
                                                <td>{{ $event->latitude }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-semibold">{{ __('longitude') }}</td>
                                                <td>{{ $event->longitude }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-semibold">{{ __('image') }}</td>
                                                @if ($event->image)
                                                    <td><img src="{{ asset('/images/' . $event->image) }}"
                                                            alt="{{ $event->name }}"
                                                            class="w-20 h-20 rounded-mb mb-2 object-cover"></td>
                                                @else
                                                    <td>
                                                        No Image
                                                    </td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="px-4 py-2 flex justify-between">

                                    <a href="{{ route('events.edit', $event) }}" id="edit-events-{{ $event->id }}"
                                        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 cursor-pointer">{{ __('edit') }}</a>


                                    <a href="{{ route('events.index') }}"
                                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 cursor-pointer">{{ __('Return') }}</a>

                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-6/12">
                            <div class="bg-white shadow-md rounded-lg mt-4 md:mt-0">
                                <div class="bg-gray-200 px-4 py-2">{{ trans('events location') }}</div>
                                <div class="h-96 px-4 py-4" id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        var map;

        function initMap() {
           
            var eventLatitude = {{ $event->latitude }}; // Replace with actual variable name
            var eventLongitude = {{ $event->longitude }}; // Replace with actual variable name
    
            map = L.map('map').setView([eventLatitude, eventLongitude], 18 /*{{ config('leaflet.zoom_level') }}*/);

      
            var marker = L.marker([eventLatitude, eventLongitude]).addTo(map);
            marker.bindPopup("{{ $event->name }}").openPopup();

           
            var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map);
        }
        initMap()
    </script>
</x-app-layout>
