<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Unifind</title>

        @vite(['resources/css/app.css','resources/js/app.js'])

        @include('comp.menu')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Include Leaflet Routing Machine -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>

    </head>
    <body class="antialiased z-0">
        <div class="flex justify-center py-10 px-10">
            <div id="map" class="h-96 w-5/6 rounded-md z-0"></div>
        </div>
        <div class="pl-20">
            <a href="{{ route('ksaspub') }}"class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"> Back
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>
        
        

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
        <script>
            var map;
            var marker;
            var routingControl;

            var ksas = @json($ksas);
    
            function initMap() {
                // Initialize map with center at (0, 0)
                map = L.map('map').setView([0, 0], 16);
    
                var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                }).addTo(map);
    
                // Retrieve destination coordinates from URL parameters
                var urlParams = new URLSearchParams(window.location.search);
                // lah...
                // latlng kau based query string gilak
                var destinationLat = urlParams.get('lat'); 
                var destinationLng = urlParams.get('lng');
    
                // Initialize user marker (will be updated later)
                marker = L.marker([0, 0]).addTo(map)
                    .bindPopup('You are here!').openPopup();
    
                // Get the user's location
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        var userLatitude = position.coords.latitude;
                        var userLongitude = position.coords.longitude;
    
                        // Update user marker
                        marker.setLatLng([userLatitude, userLongitude]);
    
                        // Pan the map to the user's location
                        map.setView([userLatitude, userLongitude], 18);
    
                        const destLatLng = L.latLng(ksas.latitude, ksas.longitude)
                        setDestination(destLatLng); // <-- sini prob
                        updateMarkerPosition();
                        // tapi ni kau buat setiap 10 saat ah dia update
                        setInterval(updateMarkerPosition, 5000); // ni dah ada
                    },
                    function (error) {
                        console.error('Error getting user location:', error.message);
                    }
                );
    
                map.on('', function (e) {
                    setDestination(e.latlng);
                });
            }
    
            function updateMarkerPosition() {
                navigator.geolocation.getCurrentPosition(
                    function (position) { 
                        console.log(position)
                        var userLatitude = position.coords.latitude;
                        var userLongitude = position.coords.longitude;
                        console.log('User location now: ', {lat: userLatitude, lng: userLongitude})
    
                        // Update user marker
                        marker.setLatLng([userLatitude, userLongitude]);
                    },
                    function (error) {
                        console.error('Error getting user location:', error.message);
                    }
                );
            }
    
            function setDestination(latlng) {
                if (routingControl) {
                    map.removeControl(routingControl);
                }

                // console.log(latlng)
    
                routingControl = L.Routing.control({
                    waypoints: [
                        L.latLng(latlng.lat, latlng.lng),
                        L.latLng(marker.getLatLng().lat, marker.getLatLng().lng)
                    ],
                    routeWhileDragging: true
                }).addTo(map);
            }
    
        </script>
    
        <!-- Initialize the map when the page loads -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                initMap();
            });
        </script>
    </body>

</html>
