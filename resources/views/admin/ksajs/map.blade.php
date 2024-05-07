<div id="map" class="h-96 rounded-md z-0"></div>
{{-- <?php var_dump($ksajss);?> --}}

<script>
// Initialize the map
var map = L.map('map').setView([3.685557262740878, 101.52449845877337], 16);

// Add a tile layer to the map (consider using official Leaflet providers)
var googleSat = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
  maxZoom: 20,
  subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
}).addTo(map);

// Function to create a popup with information
function createPopupContent(ksajs) {
  // console.log('kote',)
  // bruh kau try pakai php untu js object
  var content = `
    <h2>${ksajs.name}</h2>
    ${ksajs.image ? `<img src="{{asset('/images/')}}/${ksajs.image}" alt="" class="w-20 h-20 rounded-md mb-2 object-cover">` : ''}
    <p><b>Open Hours:</b> ${ksajs.open_hours}</p>
    <p class ="text-red">${ksajs.important_details}</p>
    <a href="{{ route('ksajs.index')}}/${ksajs.id}/edit" class="text-blue-500 hover:text-blue-700">Edit</a> 
      
  `;
  return content;
}

const ksajss = [].concat(@json($ksajss));
console.log(ksajss)


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