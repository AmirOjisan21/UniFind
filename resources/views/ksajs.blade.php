<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Unifind</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('comp.menu')

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script src="/node_modules/leaflet-rotate/leaflet.rotate.js"></script>
    <link rel="stylesheet" href="/node_modules/leaflet-rotate/leaflet.rotate.css" / </head>

<body class="antialiased ">
    <div class="pt-10 text-center font-mono text-2xl font-medium">
        <h1>KAMPUS SULTAN ABDUL JALIL SHAH (KSAJS)</h1>
    </div>
    <div class="flex justify-center py-10 px-10">
        <div id="map" class="h-96 w-5/6 rounded-md z-0"></div>
    </div>
    <div class="py-10 px-10">
        <div class="pt-10 text-center font-mono text-2xl font-medium">
            <h1>KSAJS LOCATIONS</h1>
        </div>
        <div class="grid-cols-3 grid gap-6 font-mono py-8">
            @foreach ($ksajss as $ksajs)
            <div
                class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                    <img class="rounded-t-lg w-full h-72 object-cover" src="{{ asset("images/{$ksajs->image}") }}" alt="" />
                <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $ksajs->name }}</h5>
                    <p class="mb-3 font-normal text-gray-700">Open Hours:{{ $ksajs->open_hours }}</p>
                    <a href="{{ route('ksajslocation', $ksajs->id) }}"
                        id="location-{{ $ksajs->id }}"class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Details
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
    </div>

    <script>
        // Initialize the map
        var map = L.map('map').setView([3.685557262740878, 101.52449845877337], 16);

        // Add a tile layer to the map
        var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map);

            function createPopupContent(ksajs) {
  
  var content =`
  
    <h2>${ksajs.name}</h2>
    ${ksajs.image ? `<img src="{{asset('/images/')}}/${ksajs.image}" alt="" class="w-20 h-20 rounded-md mb-2 object-cover">` : ''}
    <p><b>Open Hours:</b> ${ksajs.open_hours}</p>
    <p class ="text-red">${ksajs.important_details}</p>
    <a href="/navigation/${ksajs.id}" class="text-blue-500 hover:text-blue-700">Show Direction</a> 
      
  `;
  return content;
}

const ksajss = [].concat(@json($ksajss));
console.log(ksajss)

// Assuming you have $ksajss variable containing Ksajs data (passed from your controller)
if (typeof ksajss !== 'undefined' && ksajss.length > 0) {
  ksajss.forEach(function(ksajs) {
    // Check if Ksajs object has required properties (optional for debugging)
    console.log(ksajs); // Check for latitude, longitude, name, etc.

    var marker = L.marker([ksajs.latitude, ksajs.longitude]).addTo(map);

    // Create popup content
    var popupContent = createPopupContent(ksajs);

    // Add popup to marker
    marker.bindPopup(popupContent);
  });
} else {
  console.log('No Ksajs data found for markers');
}
    </script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
