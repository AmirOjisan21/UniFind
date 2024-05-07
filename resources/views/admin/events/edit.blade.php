<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-center">
                        <div class="w-full md:w-1/2">
                            @if (request('action') == 'delete' && $event)
                                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                    <div class="mb-4">
                                        <div class="font-bold text-xl mb-2">{{ __('Delete Location') }}</div>
                                        <p class="text-gray-700 text-base">
                                            <span class="font-bold text-gray-900">{{ __('Name') }}:</span>
                                            {{ $event->name }}
                                        </p>
                                        <div class="mt-4">
                                            @if ($event->image)
                                                <img src="{{ asset('/images/' . $event->image) }}"
                                                    alt="{{ $event->name }}" class="w-full mb-3">
                                            @else
                                                <p>No image available.</p>
                                            @endif
                                        </div>
                                        <p class="text-gray-700 text-base">
                                            <span class="font-bold text-gray-900">{{ __('Description') }}:</span>
                                            {{ $event->description }}
                                        </p>
                                        <p class="text-gray-700 text-base">
                                            <span class="font-bold text-gray-900">{{ __('Start Date') }}:</span>
                                            {{ $event->start_date }}
                                        </p>
                                        <p class="text-gray-700 text-base">
                                            <span class="font-bold text-gray-900">{{ __('End Date') }}:</span>
                                            {{ $event->end_date }}
                                        </p>
                                        <p class="text-gray-700 text-base">
                                            <span class="font-bold text-gray-900">{{ __('Latitude') }}:</span>
                                            {{ $event->latitude }}
                                        </p>
                                        <p class="text-gray-700 text-base">
                                            <span class="font-bold text-gray-900">{{ __('Longitude') }}:</span>
                                            {{ $event->longitude }}
                                        </p>
                                        {!! $errors->first('event_id', '<span class="text-red-500" role="alert">:message</span>') !!}
                                    </div>
                                    <hr class="my-4">
                                    <div class="text-red-600">{{ __('Are you sure you want to delete?') }}</div>
                                    <div class="mt-4">
                                        <form method="POST" action="{{ route('events.destroy', $event) }}"
                                            accept-charset="UTF-8"
                                            onsubmit="return confirm('{{ __('Are you sure you want to delete?') }}')"
                                            class="inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <input name="event_id" type="hidden" value="{{ $event->id }}">
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">{{ __('Delete') }}</button>
                                        </form>
                                        <a href="{{ route('events.edit', $event) }}"
                                            class="text-blue-500 hover:text-blue-700">{{ __('Cancel') }}</a>
                                    </div>
                                </div>
                            @else
                                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                    <div class="font-bold text-xl mb-2">{{ __('Edit') }}</div>
                                    <form method="POST" action="{{ route('events.update', $event) }}"
                                        accept-charset="UTF-8" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('patch') }}
                                        <div class="mb-4">
                                            <label for="name"
                                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Name') }}</label>
                                            <input id="name" type="text"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('name') ? ' border-red-500' : '' }}"
                                                name="name" value="{{ old('name', $event->name) }}" required>
                                            {!! $errors->first('name', '<span class="text-red-500" role="alert">:message</span>') !!}
                                        </div>
                                        <div class="mb-4">
                                            <label for="image"
                                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Image') }}</label>
                                            @if ($event->image)
                                                <img src="{{ asset('/images/' . $event->image) }}"
                                                    alt="{{ $event->name }}" class="w-full mb-3">
                                            @endif
                                            <input type="file" id="image" name="image"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('image') ? ' border-red-500' : '' }}"
                                                {{ $event->image ? '' : 'required' }}>
                                            {!! $errors->first('image', '<span class="text-red-500" role="alert">:message</span>') !!}
                                        </div>
                                        <div class="mb-4">
                                            <label for="description"
                                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Description') }}</label>
                                            <textarea id="description"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('description') ? ' border-red-500' : '' }}"
                                                name="description" rows="4">{{ old('description', $event->description) }}</textarea>
                                            {!! $errors->first('description', '<span class="text-red-500" role="alert">:message</span>') !!}
                                        </div>
                                        <div class="mb-4">
                                            <div class="flex">
                                                <div class="w-1/2 pr-3">
                                                 <div class="startdate">
                                                     <label for="startdate">Start Date</label>
                                                      <input type="datetime-local" name="start_date" id="startdate">
                                            <div class="flex">
                                                <div class="startdate">
                                                <label for="startdate">End Date</label>
                                                <input type="datetime-local" name="end_date" id="enddate">
                                            </div>
                                        </div>
                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <div class="flex">
                                                <div class="w-1/2 pr-3">
                                                    <label for="longitude"
                                                        class="block text-gray-700 text-sm font-bold mb-2">{{ __('Longitude') }}</label>
                                                    <input id="longitude" type="text"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('longitude') ? ' border-red-500' : '' }}"
                                                        name="longitude"
                                                        value="{{ old('longitude', $event->longitude) }}" required>
                                                    {!! $errors->first('longitude', '<span class="text-red-500" role="alert">:message</span>') !!}
                                                </div>
                                                <div class="w-1/2 pl-3">
                                                    <label for="latitude"
                                                        class="block text-gray-700 text-sm font-bold mb-2">{{ __('Latitude') }}</label>
                                                    <input id="latitude" type="text"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('latitude') ? ' border-red-500' : '' }}"
                                                        name="latitude"
                                                        value="{{ old('latitude', $event->latitude) }}" required>
                                                    {!! $errors->first('latitude', '<span class="text-red-500" role="alert">:message</span>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="grid-cols-2">
                                            <div><P>KSAS</P></div>
                                          <div id="map1" class="h-80 py-6"></div>
                                          <div><P>KSAJS</P></div>
                                          <div id="map2" class="h-80 py-6"></div>
                                          </div>
                                        
                                </div>
                                
                                
                                <div class="mb-4">
                                    <input type="submit" value="{{ __('Update') }}"
                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    <a href="{{ route('events.show', $event) }}"
                                        class="text-blue-500 hover:text-blue-700">{{ __('Cancel') }}</a>
                                    <a href="{{ route('events.edit', [$event, 'action' => 'delete']) }}"
                                        id="del-event-{{ $event->id }}"
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
