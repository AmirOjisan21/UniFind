<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-center">
                        <div class="w-full md:w-1/2">
                            @if (request('action') == 'delete' && $ksajs)
                                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                    <div class="mb-4">
                                        <div class="font-bold text-xl mb-2">{{ __('Delete Location') }}</div>
                                        <p class="text-gray-700 text-base">
                                            <span class="font-bold text-gray-900">{{ __('Name') }}:</span>
                                            {{ $ksajs->name }}
                                        </p>
                                        <div class="mt-4">
                                            @if ($ksajs->image)
                                                <img src="{{ asset('/images/' . $ksajs->image) }}"
                                                    alt="{{ $ksajs->name }}" class="w-full mb-3">
                                            @else
                                                <p>No image available.</p>
                                            @endif
                                        </div>
                                        <p class="text-gray-700 text-base">
                                            <span class="font-bold text-gray-900">{{ __('Description') }}:</span>
                                            {{ $ksajs->description }}
                                        </p>
                                        <p class="text-gray-700 text-base">
                                            <span class="font-bold text-gray-900">{{ __('Open Hours') }}:</span>
                                            {{ $ksajs->open_hours }}
                                        </p>
                                        <p class="text-gray-700 text-base">
                                            <span class="font-bold text-gray-900">{{ __('Important Details') }}:</span>
                                            {{ $ksajs->important_details }}
                                        </p>
                                        <p class="text-gray-700 text-base">
                                            <span class="font-bold text-gray-900">{{ __('Latitude') }}:</span>
                                            {{ $ksajs->latitude }}
                                        </p>
                                        <p class="text-gray-700 text-base">
                                            <span class="font-bold text-gray-900">{{ __('Longitude') }}:</span>
                                            {{ $ksajs->longitude }}
                                        </p>
                                        {!! $errors->first('ksajs_id', '<span class="text-red-500" role="alert">:message</span>') !!}
                                    </div>
                                    <hr class="my-4">
                                    <div class="text-red-600">{{ __('Are you sure you want to delete?') }}</div>
                                    <div class="mt-4">
                                        <form method="POST" action="{{ route('ksajs.destroy', $ksajs) }}"
                                            accept-charset="UTF-8"
                                            onsubmit="return confirm('{{ __('Are you sure you want to delete?') }}')"
                                            class="inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <input name="ksajs_id" type="hidden" value="{{ $ksajs->id }}">
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">{{ __('Delete') }}</button>
                                        </form>
                                        <a href="{{ route('ksajs.edit', $ksajs) }}"
                                            class="text-blue-500 hover:text-blue-700">{{ __('Cancel') }}</a>
                                    </div>
                                </div>
                            @else
                                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                    <div class="font-bold text-xl mb-2">{{ __('Edit') }}</div>
                                    <form method="POST" action="{{ route('ksajs.update', $ksajs) }}"
                                        accept-charset="UTF-8" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('patch') }}
                                        <div class="mb-4">
                                            <label for="name"
                                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Name') }}</label>
                                            <input id="name" type="text"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('name') ? ' border-red-500' : '' }}"
                                                name="name" value="{{ old('name', $ksajs->name) }}" required>
                                            {!! $errors->first('name', '<span class="text-red-500" role="alert">:message</span>') !!}
                                        </div>
                                        <div class="mb-4">
                                            <label for="image"
                                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Image') }}</label>
                                            @if ($ksajs->image)
                                                <img src="{{ asset('/images/' . $ksajs->image) }}"
                                                    alt="{{ $ksajs->name }}" class="w-full mb-3">
                                            @endif
                                            <input type="file" id="image" name="image"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('image') ? ' border-red-500' : '' }}"
                                                {{ $ksajs->image ? '' : 'required' }}>
                                            {!! $errors->first('image', '<span class="text-red-500" role="alert">:message</span>') !!}
                                        </div>
                                        <div class="mb-4">
                                            <label for="description"
                                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Description') }}</label>
                                            <textarea id="description"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('description') ? ' border-red-500' : '' }}"
                                                name="description" rows="4">{{ old('description', $ksajs->description) }}</textarea>
                                            {!! $errors->first('description', '<span class="text-red-500" role="alert">:message</span>') !!}
                                        </div>
                                        <div class="mb-4">
                                            <label for="open_hours"
                                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Open Hours') }}</label>
                                            <textarea id="open_hours"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('open_hours') ? ' border-red-500' : '' }}"
                                                name="open_hours" rows="4">{{ old('open_hours', $ksajs->open_hours) }}</textarea>
                                            {!! $errors->first('open_hours', '<span class="text-red-500" role="alert">:message</span>') !!}
                                        </div>
                                        <div class="mb-4">
                                            <label for="important_details"
                                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Important Details') }}</label>
                                            <textarea id="important_details"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('important_details') ? ' border-red-500' : '' }}"
                                                name="important_details" rows="4">{{ old('important_details', $ksajs->important_details) }}</textarea>
                                            {!! $errors->first('important_details', '<span class="text-red-500" role="alert">:message</span>') !!}
                                        </div>
                                        <div class="mb-4">
                                            <div class="flex">
                                                <div class="w-1/2 pr-3">
                                                    <label for="longitude"
                                                        class="block text-gray-700 text-sm font-bold mb-2">{{ __('Longitude') }}</label>
                                                    <input id="longitude" type="text"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('longitude') ? ' border-red-500' : '' }}"
                                                        name="longitude"
                                                        value="{{ old('longitude', $ksajs->longitude) }}" required>
                                                    {!! $errors->first('longitude', '<span class="text-red-500" role="alert">:message</span>') !!}
                                                </div>
                                                <div class="w-1/2 pl-3">
                                                    <label for="latitude"
                                                        class="block text-gray-700 text-sm font-bold mb-2">{{ __('Latitude') }}</label>
                                                    <input id="latitude" type="text"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('latitude') ? ' border-red-500' : '' }}"
                                                        name="latitude"
                                                        value="{{ old('latitude', $ksajs->latitude) }}" required>
                                                    {!! $errors->first('latitude', '<span class="text-red-500" role="alert">:message</span>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" object-center justify-center">
                                            <div class="h-80 mb-4" id="map"></div>
                                            </div>
                                </div>
                                
                                <div class="mb-4">
                                    <input type="submit" value="{{ __('Update') }}"
                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    <a href="{{ route('ksajs.show', $ksajs) }}"
                                        class="text-blue-500 hover:text-blue-700">{{ __('Cancel') }}</a>
                                    <a href="{{ route('ksajs.edit', [$ksajs, 'action' => 'delete']) }}"
                                        id="del-ksajs-{{ $ksajs->id }}"
                                        class="text-red-500 hover:text-red-700 float-right">{{ __('Delete') }}</a>
                                </div>
                                </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        var map = L.map('map').setView([3.685557262740878, 101.52449845877337], 16);

        // Add a tile layer to the map
        var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

        var marker; // Declare a variable to hold the marker

        // Function to create a marker and popup with button
        function onMapClick(e) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker(e.latlng).addTo(map);

            // Ensure a valid popup content string is constructed
            var popupContent = "You clicked the map at " + e.latlng.toString() +
                "<br><button type='button' class='addCoordsButton'>Add Coordinates</button>";
            var popup = L.popup().setLatLng(e.latlng).setContent(popupContent);

            // Verify popup opens successfully
            popup.openOn(map);

            // Add click event listener to the button inside the popup
            document.querySelectorAll('.addCoordsButton').forEach(btn => {
                btn.addEventListener('click', function() {
                    // Double-check element references and value assignment
                    document.getElementById('latitude').value = e.latlng.lat.toFixed(
                    6); // Use toFixed for more precise values
                    document.getElementById('longitude').value = e.latlng.lng.toFixed(6);
                    // popup.close();
                });
            })
        }


        // Prevent default behavior on map double-click
        map.on('dblclick', function(e) {
            //   e.stopPropagation();
        });

        // Add click event listener to the map
        map.on('click', onMapClick);
    </script>
</x-app-layout>
