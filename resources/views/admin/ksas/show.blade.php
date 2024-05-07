<x-app-layout>
    <x-slot name="ksas">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ksas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg justify-center">
                <div class="p-6 text-gray-900 justify-center">
                    <div class="flex justify-center">
                        <div class="w-full md:w-6/12">
                            <div class="bg-white shadow-md rounded-lg">
                                <div class="bg-gray-200 px-4 py-2">{{ __('Ksas Location') }}</div>
                                <div class="px-4 py-4">
                                    <table class="table-auto">
                                        <tbody>
                                            <tr>
                                                <td class="font-semibold">{{ __('name') }}</td>
                                                <td>{{ $ksas->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-semibold">{{ __('description') }}</td>
                                                <td>{{ $ksas->description }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-semibold">{{ __('latitude') }}</td>
                                                <td>{{ $ksas->latitude }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-semibold">{{ __('longitude') }}</td>
                                                <td>{{ $ksas->longitude }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-semibold">{{ __('open hours') }}</td>
                                            
                                                <td>{{ $ksas->open_hours }}</td>
                                                
                                            </tr>
                                            <tr>
                                                <td class="font-semibold">{{ __('important details') }}</td>
                                                
                                                <td>{{ $ksas->important_details }}</td>
                                          
                                            </tr>
                                            <tr>
                                                <td class="font-semibold">{{ __('image') }}</td>
                                                @if ($ksas->image)
                                                    <td><img src="{{ asset('/images/' . $ksas->image) }}"
                                                            alt="{{ $ksas->name }}"
                                                            class="w-20 h-20 rounded-mb mb-2 object-cover"></td>
                                                @else
                                                    <td>
                                                        <input type="file" name="image"
                                                            class="px-3 py-2 border border-gray-300 rounded-md w-full focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                                    </td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="px-4 py-2 flex justify-between">

                                    <a href="{{ route('ksas.edit', $ksas) }}" id="edit-ksas-{{ $ksas->id }}"
                                        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 cursor-pointer">{{ __('edit') }}</a>


                                    <a href="{{ route('ksas.index') }}"
                                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 cursor-pointer">{{ __('Return') }}</a>

                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-6/12">
                            <div class="bg-white shadow-md rounded-lg mt-4 md:mt-0">
                                <div class="bg-gray-200 px-4 py-2">{{ trans('ksas location') }}</div>
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
            // Assuming you have latitude and longitude values stored in variables `ksasLatitude` and `ksasLongitude`
            var ksasLatitude = {{ $ksas->latitude }}; // Replace with actual variable name
            var ksasLongitude = {{ $ksas->longitude }}; // Replace with actual variable name
            // const balls = {{ config('leaflet.zoom_level') }}; <-- ni pebende gila...patutnya aku nak dia zoom kat marker tu aku dapat dari stackoverflow, bruh kau nak load dari file ke? tadi dia dah load en
            // console.log(balls   )

            // debugger;

            // Initialize the map centered on the Ksas location
            map = L.map('map').setView([ksasLatitude, ksasLongitude], 18 /*{{ config('leaflet.zoom_level') }}*/);

            // Add a marker at the Ksas location
            var marker = L.marker([ksasLatitude, ksasLongitude]).addTo(map);
            marker.bindPopup("{{ $ksas->name }}").openPopup();

            //   var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            //     maxZoom: 20,
            //     subdomains: ['mt0', 'mt1', 'mt2', 'mt3']    
            //   }).addTo(map);
            // Add a tile layer to the map
            var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map);
        }
        initMap()
    </script>
</x-app-layout>
