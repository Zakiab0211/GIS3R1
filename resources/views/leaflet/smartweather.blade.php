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
                    <div class="card-header">Smart Weather</div>
                    <div class="card-body">
                        <div id="map"></div>
                        <hr>
                        <h5>Data Cuaca</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>TimeStamp</th>
                                    <th>Humidity</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Pressure</th>
                                    <th>Rainfall</th>
                                    <th>Temperature</th>
                                    <th>UV</th>
                                    <th>WindDirection</th>
                                    <th>WindSpeed</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($postWeather as $weather)
                                    <tr>
                                        <td>{{ $weather->TimeStamp }}</td>
                                        <td>{{ $weather->Humidity }}%</td>
                                        <td>{{ $weather->Latitude }}</td>
                                        <td>{{ $weather->Longitude }}</td>
                                        <td>{{ $weather->Pressure }} hPa</td>
                                        <td>{{ $weather->Rainfall }} mm</td>
                                        <td>{{ $weather->Temperature }} °C</td>
                                        <td>{{ $weather->UV }}</td>
                                        <td>{{ $weather->WindDirection }}°</td>
                                        <td>{{ $weather->WindSpeed }} km/h</td>
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
        
        var baseMaps = {
            "Google Streets": L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20, subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            "OpenStreetMap": L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19, attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }),
            "Google Hybrid": L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                maxZoom: 20, subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            })
        };
        
        L.control.layers(baseMaps).addTo(map);
        baseMaps["Google Hybrid"].addTo(map);
        
        var iconMarker = L.icon({
            iconUrl: '{{ asset("iconMarkers/cloudy.png") }}',
            iconSize: [50, 50],
            iconAnchor: [25, 50],
            popupAnchor: [0, -50]
        });
        
        @foreach($postWeather as $weather)
        var popup = L.popup()
        .setLatLng([-7.235664, 112.553034])
        .setContent("<b>Lokasi:</b> Gresik<br></br><u><b>ZOOM & Klik icon awan untuk detail.!!!</b></u>")
        .openOn(map);

            L.marker([{{ $weather->Latitude }}, {{ $weather->Longitude }}], { icon: iconMarker })
                .addTo(map)
                .bindPopup(`
                    <div style="font-family: Arial, sans-serif; font-size: 12px; padding: 5px; max-width: 200px;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr><td><i class="fas fa-clock"></i></td><td><strong>Timestamp</strong></td><td>: {{ $weather->TimeStamp }}</td></tr>
                            <tr><td><i class="fas fa-tint"></i></td><td><strong>Humidity</strong></td><td>: {{ $weather->Humidity }}%</td></tr>
                            <tr><td><i class="fas fa-map-marker-alt"></i></td><td><strong>Latitude</strong></td><td>: {{ $weather->Latitude }}</td></tr>
                            <tr><td><i class="fas fa-map-marker-alt"></i></td><td><strong>Longitude</strong></td><td>: {{ $weather->Longitude }}</td></tr>
                            <tr><td><i class="fas fa-tachometer-alt"></i></td><td><strong>Pressure</strong></td><td>: {{ $weather->Pressure }}hPa</td></tr>
                            <tr><td><i class="fas fa-cloud-showers-heavy"></i></td><td><strong>Rainfall</strong></td><td>: {{ $weather->Rainfall }}mm</td></tr>
                            <tr><td><i class="fas fa-thermometer-half"></i></td><td><strong>Temperature</strong></td><td>: {{ $weather->Temperature }}°C</td></tr>
                            <tr><td><i class="fas fa-sun"></i></td><td><strong>UV Index</strong></td><td>: {{ $weather->UV }}</td></tr>
                            <tr><td><i class="fas fa-compass"></i></td><td><strong>Wind Direction</strong></td><td>: {{ $weather->WindDirection }}°</td></tr>
                            <tr><td><i class="fas fa-wind"></i></td><td><strong>Wind Speed</strong></td><td>: {{ $weather->WindSpeed }}km/h</td></tr>
                        </table>
                    </div>
                `, { maxWidth: 250 });
        @endforeach
    </script>
@endpush
