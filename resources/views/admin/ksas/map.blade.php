<div id="map" class="h-96 rounded-md z-0"></div>
{{-- <?php var_dump($ksass);?> --}}

<script>
// Initialize the map
var map = L.map('map').setView([3.7231297692463383, 101.52831585844865], 15);

// Add a tile layer to the map (consider using official Leaflet providers)
var googleSat = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
  maxZoom: 20,
  subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
}).addTo(map);

// Function to create a popup with information
function createPopupContent(ksas) {
  // console.log('kote',)
  // bruh kau try pakai php untu js object
  var content = `
    <h2>${ksas.name}</h2>
    ${ksas.image ? `<img src="{{asset('/images/')}}/${ksas.image}" alt="" class="w-20 h-20 rounded-md mb-2 object-cover">` : ''}
    <p><b>Open Hours:</b> ${ksas.open_hours}</p>
    <p class ="text-red">${ksas.important_details}</p>
    <a href="{{ route('ksas.index')}}/${ksas.id}/edit" class="text-blue-500 hover:text-blue-700">Edit</a> 
      
  `;
  return content;
}

const ksass = [].concat(@json($ksass));
console.log(ksass)

// Assuming you have $ksass variable containing Ksas data (passed from your controller)
if (typeof ksass !== 'undefined' && ksass.length > 0) {
  ksass.forEach(function(ksas) {
    // Check if Ksas object has required properties (optional for debugging)
    console.log(ksas); // Check for latitude, longitude, name, etc.

    var marker = L.marker([ksas.latitude, ksas.longitude]).addTo(map);

    // Create popup content
    var popupContent = createPopupContent(ksas);

    // Add popup to marker
    marker.bindPopup(popupContent);
  });
} else {
  console.log('No Ksas data found for markers');
}
</script>
