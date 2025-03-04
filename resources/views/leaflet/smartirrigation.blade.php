@extends('layouts.dashboard-volt')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
                    <div class="card-header">Smart Irrigation</div>
                    <div class="card-body">
                        <div id="map"></div>
                        <hr>
                        <h5>Data Irrigation</h5>
                        <table border="3" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Curah Hujan</th>
                                    <th>Liquid Volume</th>
                                    <th>Timestamp</th>
                                    <th>Longitude</th>
                                    <th>Latitude</th>
                                    <th>Flow Rate</th>
                                    <th>Jarak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($postIrrigation as $irrigation)
                                    <tr>
                                        <td>{{ $irrigation->curah_hujan }}</td>
                                        <td>{{ $irrigation->liquid_volume }}</td>
                                        <td>{{ $irrigation->timestamp }}</td>
                                        <td>{{ $irrigation->longitude }}</td>
                                        <td>{{ $irrigation->latitude }}</td>
                                        <td>{{ $irrigation->flow_rate }}</td>
                                        <td>{{ $irrigation->jarak }}</td>
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
        }).addTo(map);

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

        // Custom marker icon
        var iconMarker = L.icon({
            iconUrl: '{{ asset("iconMarkers/map2.png") }}',
            iconSize: [50, 50],
            iconAnchor: [25, 50],
            popupAnchor: [0, -50]
        });

        @foreach($postIrrigation as $irrigation)
        
        var popup = L.popup()
        .setLatLng([-7.276370, 112.793750])
        .setContent("<b>Lokasi:</b> Surabaya<br></br><u><b>ZOOM & Klik marker untuk detail.!!!</b></u>")
        .openOn(map);

            L.marker([{{ $irrigation->latitude }}, {{ $irrigation->longitude }}], { icon: iconMarker })
                .addTo(map)
                .bindPopup(`
                    <div style="font-family: Arial, sans-serif; font-size: 13px; padding: 5px; max-width: 400px;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td><i class="fas fa-tint"></i></td>
                                <td><strong>Curah Hujan</strong></td>
                                <td>: {{ $irrigation->curah_hujan }}mm</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-bolt"></i></td>
                                <td><strong>Liquid Volume</strong></td>
                                <td>: {{ $irrigation->liquid_volume }}L</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-clock"></i></td>
                                <td><strong>Timestamp</strong></td>
                                <td>: {{ $irrigation->timestamp }}</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-map-marker-alt"></i></td>
                                <td><strong>Longitude</strong></td>
                                <td>: {{ $irrigation->longitude }}°</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-map-marker-alt"></i></td>
                                <td><strong>Latitude</strong></td>
                                <td>: {{ $irrigation->latitude }}°</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-vial"></i></td>
                                <td><strong>Flow Rate</strong></td>
                                <td>: {{ $irrigation->flow_rate }}L/s</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-ruler"></i></td>
                                <td><strong>Jarak</strong></td>
                                <td>: {{ $irrigation->jarak }}M</td>
                            </tr>
                        </table>
                    </div>
                `, { maxWidth: 250 });
        @endforeach
    </script>
@endpush
