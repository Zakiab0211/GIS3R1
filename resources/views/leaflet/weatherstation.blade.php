@extends('layouts.dashboard-volt')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" crossorigin="" />
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Weather Station</div>
                    <div class="card-body">
                        <div id="map"></div>
                        <hr>
                        <h5>Data Stasiun Cuaca</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Timestamp</th>
                                    <th>Kota</th>
                                    <th>Temperature (°C)</th>
                                    <th>Humidity (%)</th>
                                    <th>Pressure (hPa)</th>
                                    <th>Wind Speed (km/h)</th>
                                    <th>Weather</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($weatherData as $weather)
                                    <tr>
                                        <td>{{ $weather['timestamp'] ?? '-' }}</td>
                                        <td>{{ $weather['city'] ?? '-' }}</td>
                                        <td>{{ isset($weather['temperature']) ? number_format($weather['temperature'], 2) : '-' }}</td>
                                        <td>{{ $weather['humidity'] ?? '-' }}</td>
                                        <td>{{ $weather['pressure'] ?? '-' }}</td>
                                        <td>{{ isset($weather['wind_speed']) ? number_format($weather['wind_speed'], 2) : '-' }}</td>
                                        <td>{{ $weather['weather_description'] ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No weather data available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script>
    <script>
        var map = L.map('map').setView([-7.4478, 112.7183], 10);

        var baseMaps = {
            "Google Streets": L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20, subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            "OpenStreetMap": L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19, attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }),
            "Google Hybrid": L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
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

        @foreach($weatherData as $weather)
        var popup = L.popup()
        .setLatLng([-7.445574, 112.718960])
        .setContent("<b>Lokasi:</b> Sidoarjo<br></br><u><b>ZOOM & Klik Awan untuk detail cuaca.!!!</b></u>")
        .openOn(map); 

            var marker = L.marker([-7.4478, 112.7183], { icon: iconMarker })
                .addTo(map)
                .bindPopup(`
                    <div style="font-family: Arial, sans-serif; font-size: 12px; padding: 5px; max-width: 200px;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr><td><i class="fas fa-clock"></i></td><td><strong>Timestamp</strong></td><td>: {{ $weather['timestamp'] }}</td></tr>
                            <tr><td><i class="fas fa-map-marker-alt"></i></td><td><strong>City</strong></td><td>: {{ $weather['city'] }}</td></tr>
                            <tr><td><i class="fas fa-thermometer-half"></i></td><td><strong>Temperature</strong></td><td>: {{ number_format($weather['temperature'], 2) }}°C</td></tr>
                            <tr><td><i class="fas fa-tint"></i></td><td><strong>Humidity</strong></td><td>: {{ $weather['humidity'] }}%</td></tr>
                            <tr><td><i class="fas fa-tachometer-alt"></i></td><td><strong>Pressure</strong></td><td>: {{ $weather['pressure'] }} hPa</td></tr>
                            <tr><td><i class="fas fa-wind"></i></td><td><strong>Wind Speed</strong></td><td>: {{ number_format($weather['wind_speed'], 2) }} km/h</td></tr>
                            <tr><td><i class="fas fa-cloud"></i></td><td><strong>Weather</strong></td><td>: {{ $weather['weather_description'] }}</td></tr>
                        </table>
                    </div>
                `, { maxWidth: 250 });
        @endforeach
    </script>
@endpush
