<x-app-layout>
    <x-slot name="ksajs">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ksajs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg justify-center">
                <div class="p-6 text-gray-900 justify-center">
                    <div class="flex justify-center">
                        <div class="w-full md:w-6/12">
                            <div class="bg-white shadow-md rounded-lg">
                                <div class="bg-gray-200 px-4 py-2">{{ __('Ksajs Location') }}</div>
                                <div class="px-4 py-4">
                                    <table class="table-auto ">
                                        <tbody>
                                            <tr>
                                                <td class="font-semibold">{{ __('name') }}</td>
                                                <td>{{ $ksajs->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-semibold">{{ __('description') }}</td>
                                                <td>{{ $ksajs->description }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-semibold">{{ __('latitude') }}</td>
                                                <td>{{ $ksajs->latitude }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-semibold">{{ __('longitude') }}</td>
                                                <td>{{ $ksajs->longitude }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-semibold">{{ __('open hours') }}</td>

                                                <td>{{ $ksajs->open_hours }}</td>
                                
                                            </tr>
                                            <tr>
                                                <td class="font-semibold">{{ __('important details') }}</td>
                                                
                                                <td>{{ $ksajs->important_details }}</td>
                                               
                                            </tr>
                                            <tr>
                                                <td class="font-semibold">{{ __('image') }}</td>
                                                @if ($ksajs->image)
                                                    <td><img src="{{ asset('/images/' . $ksajs->image) }}"
                                                            alt="{{ $ksajs->name }}"
                                                            class="w-20 h-20 rounded-md mb-2 object-cover"></td>
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

                                    <a href="{{ route('ksajs.edit', $ksajs) }}" id="edit-ksajs-{{ $ksajs->id }}"
                                        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 cursor-pointer">{{ __('edit') }}</a>


                                    <a href="{{ route('ksajs.index') }}"
                                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 cursor-pointer">{{ __('Return') }}</a>

                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-6/12">
                            <div class="bg-white shadow-md rounded-lg mt-4 md:mt-0">
                                <div class="bg-gray-200 px-4 py-2">{{ trans('ksajs location') }}</div>
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
            
            var ksajsLatitude = {{ $ksajs->latitude }}; // Replace with actual variable name
            var ksajsLongitude = {{ $ksajs->longitude }}; // Replace with actual variable name
        
            map = L.map('map').setView([ksajsLatitude, ksajsLongitude], 18 /*{{ config('leaflet.zoom_level') }}*/);

            // Add a marker at the Ksajs location
            var marker = L.marker([ksajsLatitude, ksajsLongitude]).addTo(map);
            marker.bindPopup("{{ $ksajs->name }}").openPopup();

            var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map);
        }
        initMap()
    </script>
</x-app-layout>
