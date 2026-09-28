<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Sites Map</title>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 20px; }
        h1 { margin-bottom: 10px; }
        #map { height: 600px; width: 100%; border-radius: 8px; }
        .toolbar { margin-bottom: 15px; }
        .toolbar a { display: inline-block; padding: 10px 20px; background: #28a745; color: #fff; text-decoration: none; border-radius: 4px; }
        .toolbar a:hover { background: #218838; }
    </style>
</head>
<body>
    <h1>Work Sites</h1>

    <div class="toolbar">
        <a href="{{ route('site.create') }}">+ Add New Site</a>
    </div>

    <div id="map"></div>

    {{-- <script>
        function initMap() {
            const sites = @json($workSites);

            // Default center (New York) if no sites exist
            let center = { lat: 40.7128, lng: -74.0060 };

            // If we have sites, center the map on the first one
            if (sites.length > 0) {
                center = {
                    lat: parseFloat(sites[0].latitude),
                    lng: parseFloat(sites[0].longitude)
                };
            }

            const map = new google.maps.Map(document.getElementById('map'), {
                center: center,
                zoom: 12,
            });

            // Add a marker for each work site
            sites.forEach(site => {
                const position = {
                    lat: parseFloat(site.latitude),
                    lng: parseFloat(site.longitude)
                };

                const marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: site.name,
                });

                const infoWindow = new google.maps.InfoWindow({
                    content: `<div style="padding:5px;">
                        <h3 style="margin:0 0 5px 0;">${site.name}</h3>
                        <p style="margin:0; color:#555;">${site.address}</p>
                    </div>`
                });

                marker.addListener('click', () => {
                    infoWindow.open(map, marker);
                });
            });
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script> --}}


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sites = @json($workSites);

        // Default center (New York)
        let center = [40.7128, -74.0060];
        let zoomLevel = 12;

        // If we have sites, center the map on the first one
        if (sites.length > 0) {
            center = [parseFloat(sites[0].latitude), parseFloat(sites[0].longitude)];
            zoomLevel = 13;
        }

        // Initialize the map
        const map = L.map('map').setView(center, zoomLevel);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add a marker for each work site
        sites.forEach(site => {
            const marker = L.marker([parseFloat(site.latitude), parseFloat(site.longitude)]).addTo(map);
            marker.bindPopup(`<b>${site.name}</b><br>${site.address}`);
        });
    });
</script>
</body>
</html>