
@extends('layouts.dashboard-volt')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Smart Soil</div>
                    <div class="card-body">
                        <div id="map"></div>
                        <hr>
                        <h5>Data Soil</h5>
                        <table border="3" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Moisture</th>
                                    <th>Conductivity</th>
                                    <th>Fosfor</th>
                                    <th>Longitude</th>
                                    <th>Latitude</th>
                                    <th>pH</th>
                                    <th>Kalium</th>
                                    <th>Nitrogen</th>
                                    <th>Temperature</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($postsoil as $soil)
                                <tr>
                                    <td>{{ $soil->moisture }}</td>
                                    <td>{{ $soil->conductivity }}</td>
                                    <td>{{ $soil->fosfor }}</td>
                                    <td>{{ $soil->longitude }}</td>
                                    <td>{{ $soil->latitude }}</td>
                                    <td>{{ $soil->ph }}</td>
                                    <td>{{ $soil->kalium }}</td>
                                    <td>{{ $soil->nitrogen }}</td>
                                    <td>{{ $soil->temperature }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <script>
        var map = L.map('map').setView([-7.279090, 112.792796], 7);

        var googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });

        var googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });

        var openStreetMap = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        });

        var baseMaps = {
            "Google Streets": googleStreets,
            "OpenStreetMap": openStreetMap,
            "Google Hybrid": googleHybrid
        };

        L.control.layers(baseMaps).addTo(map);
        googleHybrid.addTo(map);
        // Custom marker icon
var iconMarker = L.icon({
    iconUrl: '{{ asset("iconMarkers/estate.png") }}', // Pastikan file ada di /public/iconMarkers/map1.png
    iconSize: [50, 50], // Sesuaikan ukuran ikon
    iconAnchor: [25, 50], // Posisi titik anchor ikon
    popupAnchor: [0, -50] // Posisi popup relatif terhadap ikon
});

        @foreach($postsoil as $soil)
        // ini 2 parameter
            //L.marker([{{ $soil->latitude }}, {{ $soil->longitude }}]).addTo(map)
                //.bindPopup("Moisture: {{ $soil->moisture }}<br>pH: {{ $soil->ph }}");

            // ini full semua
    //         L.marker([{{ $soil->latitude }}, {{ $soil->longitude }}]).addTo(map)
    // .bindPopup(`
    var popup = L.popup()
        .setLatLng([-7.233379, 112.553753])
        .setContent("<b>Lokasi:</b> Gresik<br></br><u><b>ZOOM & Klik marker untuk detail.!!!</b></u>")
        .openOn(map);

    L.marker([{{ $soil->latitude }}, {{ $soil->longitude }}], {
    icon: iconMarker
}).addTo(map)
.bindPopup(`
        <div style="font-family: Arial, sans-serif; font-size: 13px; padding: 5px; max-width: 400px;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td><i class="fas fa-tint"></i></td>
                    <td><strong>Moisture</strong></td>
                    <td>:{{ $soil->moisture }}%</td>
                </tr>
                <tr>
                    <td><i class="fas fa-bolt"></i></td>
                    <td><strong>Conductivity</strong></td>
                    <td>:{{ $soil->conductivity }} µS/cm</td>
                </tr>
                <tr>
                    <td><i class="fas fa-seedling"></i></td>
                    <td><strong>Fosfor</strong></td>
                    <td>:{{ $soil->fosfor }} mg/kg</td>
                </tr>
                <tr>
                    <td><i class="fas fa-map-marker-alt"></i></td>
                    <td><strong>Longitude</strong></td>
                    <td>:{{ $soil->longitude }}</td>
                </tr>
                <tr>
                    <td><i class="fas fa-map-marker-alt"></i></td>
                    <td><strong>Latitude</strong></td>
                    <td>:{{ $soil->latitude }}</td>
                </tr>
                <tr>
                    <td><i class="fas fa-vial"></i></td>
                    <td><strong>pH</strong></td>
                    <td>:{{ $soil->ph }}</td>
                </tr>
                <tr>
                    <td><i class="fas fa-leaf"></i></td>
                    <td><strong>Kalium</strong></td>
                    <td>:{{ $soil->kalium }} mg/kg</td>
                </tr>
                <tr>
                    <td><i class="fas fa-flask"></i></td>
                    <td><strong>Nitrogen</strong></td>
                    <td>:{{ $soil->nitrogen }} mg/kg</td>
                </tr>
                <tr>
                    <td><i class="fas fa-thermometer-half"></i></td>
                    <td><strong>Temperature</strong></td>
                    <td>:{{ $soil->temperature }}°C</td>
                </tr>
            </table>
        </div>
    `, { maxWidth: 250 });
        @endforeach
    </script>
@endpush
