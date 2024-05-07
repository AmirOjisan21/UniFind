<x-app-layout>
    <x-slot name="ksas">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Ksas') }}
      </h2>
    </x-slot>
    <div class="py-12 font-mono">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div class="flex justify-center">
              <div class="w-full md:w-6/12">
                <div class="bg-white shadow-md rounded-lg">
                  <div class="bg-gray-200 px-4 py-2 justify-center">{{ __('create') }}</div>
                  <form method="POST" action="{{ route('ksas.store') }}" enctype="multipart/form-data" accept-charset="UTF-8" class="px-4 py-4">
                    @csrf
                    <div class="mb-4">
                      <label for="name" class="block text-gray-700">{{ __('name') }}</label>
                      <input id="name" type="text" class="form-input{{ $errors->has('name') ? ' border-red-500' : '' }}" name="name" value="{{ old('name') }}" required>
                      {!! $errors->first('name', '<span class="text-red-500 text-sm">:message</span>') !!}
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700">{{ __('description') }}</label>
                        <textarea id="description" class="form-textarea{{ $errors->has('description') ? ' border-red-500' : '' }}" name="description" rows="4">{{ old('description') }}</textarea>
                        {!! $errors->first('description', '<span class="text-red-500 text-sm">:message</span>') !!}
                      </div>
                      <div class="mb-4">
                        <label for="open_hours" class="block text-gray-700">{{ __('open hours') }}</label>
                        <input id="open_hours" type="text" class="form-input{{ $errors->has('open_hours') ? ' border-red-500' : '' }}" name="open_hours" value="{{ old('open_hours') }}">
                        {!! $errors->first('open_hours', '<span class="text-red-500 text-sm">:message</span>') !!}
                      </div>
                      <div class="mb-4">
                        <label for="important_details" class="block text-gray-700">{{ __('important details') }}</label>
                        <textarea id="important_details" class="form-textarea{{ $errors->has('important_details') ? ' border-red-500' : '' }}" name="important_details" rows="4">{{ old('important_details') }}</textarea>
                        {!! $errors->first('important_details', '<span class="text-red-500 text-sm">:message</span>') !!}
                      </div>
                    <div class="flex flex-wrap -mx-2">
                      <div class="w-full md:w-1/2 px-2 mb-4">
                        <label for="latitude" class="block text-gray-700">{{ __('latitude') }}</label>
                        <input id="latitude" type="text" class="form-input{{ $errors->has('latitude') ? ' border-red-500' : '' }}" name="latitude" value="{{ old('latitude', request('latitude')) }}" required>
                        {!! $errors->first('latitude', '<span class="text-red-500 text-sm">:message</span>') !!}
                      </div>
                      <div class="w-full md:w-1/2 px-2 mb-4">
                        <label for="longitude" class="block text-gray-700">{{ __('longitude') }}</label>
                        <input id="longitude" type="text" class="form-input{{ $errors->has('longitude') ? ' border-red-500' : '' }}" name="longitude" value="{{ old('longitude', request('latitude')) }}" required>
                        {!! $errors->first('longitude', '<span class="text-red-500 text-sm">:message</span>') !!}
                      </div>
                    </div>
                    <div class="mb-4">
                      <label for="image" class="block text-gray-700">{{ __('image') }}</label>
                      <input type="file" id="image" name="image" class="form-input{{ $errors->has('image') ? ' border-red-500' : '' }}">
                      {!! $errors->first('image', '<span class="text-red-500 text-sm">:message</span>') !!}
                    </div>
                    <div id="map" class="h-96"></div>
                    <div class="flex justify-between mt-4">
                      <input type="submit" value="{{ __('create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-6
                      <input type="submit" value="{{ __('create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 cursor-pointer">
                      <a href="{{ route('ksas.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 cursor-pointer">{{ __('cancel') }}</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
var map = L.map('map').setView([3.7231297692463383, 101.52831585844865], 15);

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
  var popupContent = "You clicked the map at " + e.latlng.toString() + "<br><button type='button' id='addCoordsButton'>Add Coordinates</button>";
  var popup = L.popup().setLatLng(e.latlng).setContent(popupContent);

  // Verify popup opens successfully
  popup.openOn(map);

  // Add click event listener to the button inside the popup
  document.getElementById('addCoordsButton').addEventListener('click', function() {
    // Double-check element references and value assignment
    document.getElementById('latitude').value = e.latlng.lat.toFixed(6);  // Use toFixed for more precise values
    document.getElementById('longitude').value = e.latlng.lng.toFixed(6);
    // popup.close();
  });
}


// Prevent default behavior on map double-click
map.on('dblclick', function(e) {
  e.stopPropagation();
});

// Add click event listener to the map
map.on('click', onMapClick);
    </script>
  </x-app-layout>
  