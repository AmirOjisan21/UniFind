<x-app-layout>
    <x-slot name="events">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Events') }}
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
                  <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" accept-charset="UTF-8" class="px-4 py-4">
                    @csrf
                    @if($errors->any())
                      @json($errors->all())
                    @endif
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

                    <div class="starend items-center flex">
                      <div class="startdate">
                      <label for="startdate">Start Date</label>

                        <input type="datetime-local" name="start_date" id="startdate">
                      </div>
                      <div class="enddate">
                      <label for="enddate">End Date</label>
                        <input type="datetime-local" name="end_date" id="enddate">
                      </div>
                    </div>
                    

                    <div class="mb-4">
                      <label for="latitude" class="block text-gray-700">{{ __('latitude') }}</label>
                      <input id="latitude" type="text" class="form-input{{ $errors->has('latitude') ? ' border-red-500' : '' }}" name="latitude" value="{{ old('latitude', request('latitude')) }}" required>
                      {!! $errors->first('latitude', '<span class="text-red-500 text-sm">:message</span>') !!}
                    </div>
                    <div class="mb-4">
                      <label for="longitude" class="block text-gray-700">{{ __('longitude') }}</label>
                      <input id="longitude" type="text" class="form-input{{ $errors->has('longitude') ? ' border-red-500' : '' }}" name="longitude" value="{{ old('longitude', request('latitude')) }}" required>
                      {!! $errors->first('longitude', '<span class="text-red-500 text-sm">:message</span>') !!}
                    </div>
                    <div class="mb-4">
                      <label for="image" class="block text-gray-700">{{ __('image') }}</label>
                      <input type="file" id="image" name="image" class="form-input{{ $errors->has('image') ? ' border-red-500' : '' }}">
                      {!! $errors->first('image', '<span class="text-red-500 text-sm">:message</span>') !!}
                    </div>
                    <div class="grid-cols-2">
                      <div><P>KSAS</P></div>
                    <div id="map1" class="h-96 z-0"></div>
                    <div><P>KSAJS</P></div>
                    <div id="map2" class="h-96 z-0"></div>
                    </div>
                    <div class="flex justify-between mt-4">
                      <input type="submit" value="{{ __('create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 cursor-pointer">
                      <a href="{{ route('events.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 cursor-pointer">{{ __('cancel') }}</a>
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
var map1 = L.map('map1').setView([3.7231297692463383, 101.52831585844865], 15);

// Add a tile layer to the map
var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
  maxZoom: 20,
  subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
}).addTo(map1);

var marker; // Declare a variable to hold the marker

// Function to create a marker and popup with button sat ada orng tengah kacau aku sbbtu aku hang hang
// hahahha
function onMapClick(e) {
  if (marker) {
    map1.removeLayer(marker);
  }
  marker = L.marker(e.latlng).addTo(map1);

  // Ensure a valid popup content string is constructed
  var popupContent = "You clicked the map at " + e.latlng.toString() + "<br><button type='button' id='addCoordsButton'>Add Coordinates</button>";
  var popup = L.popup().setLatLng(e.latlng).setContent(popupContent);

  // Verify popup opens successfully
  popup.openOn(map1);

  // Add click event listener to the button inside the popup
  document.getElementById('addCoordsButton').addEventListener('click', function() {
    // Double-check element references and value assignment
    document.getElementById('latitude').value = e.latlng.lat.toFixed(6);  // Use toFixed for more precise values
    document.getElementById('longitude').value = e.latlng.lng.toFixed(6);
    // popup.close();
  });
}


// Prevent default behavior on map double-click
map1.on('dblclick', function(e) {
  e.stopPropagation();
});

// Add click event listener to the map
map1.on('click', onMapClick);
    </script>

    <script>
      var map2 = L.map('map2').setView([3.685557262740878, 101.52449845877337], 16);
      
      // Add a tile layer to the map
      var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
      }).addTo(map2);
      
      var marker; // Declare a variable to hold the marker
      
      // Function to create a marker and popup with button
      function onMapClick(e) {
        if (marker) {
          map2.removeLayer(marker);
        }
        marker = L.marker(e.latlng).addTo(map2);
      
        // Ensure a valid popup content string is constructed
        var popupContent = "You clicked the map at " + e.latlng.toString() + "<br><button type='button' id='addCoordsButton'>Add Coordinates</button>";
        var popup = L.popup().setLatLng(e.latlng).setContent(popupContent);
      
        // Verify popup opens successfully
        popup.openOn(map2);
      
        // Add click event listener to the button inside the popup
        document.getElementById('addCoordsButton').addEventListener('click', function() {
          // Double-check element references and value assignment
          document.getElementById('latitude').value = e.latlng.lat.toFixed(6);  // Use toFixed for more precise values
          document.getElementById('longitude').value = e.latlng.lng.toFixed(6);
          // popup.close();
        });
      }
      
      
      // Prevent default behavior on map double-click
      map2.on('dblclick', function(e) {
        e.stopPropagation();
      });
      
      // Add click event listener to the map
      map2.on('click', onMapClick);
          </script>
  </x-app-layout>
  