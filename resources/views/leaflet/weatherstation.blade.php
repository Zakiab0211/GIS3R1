@extends('layouts.dashboard-volt')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" crossorigin="" />
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        .weather-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }
        .weather-card {
            flex: 1 1 150px;
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .weather-card i {
            font-size: 24px;
            margin-bottom: 8px;
            color: #4e73df;
        }
        .weather-card h6 {
            margin: 0;
            font-size: 14px;
            color: #6c757d;
        }
        .weather-card p {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
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

                        @if (!empty($weatherData) && isset($weatherData[0]))
                            @php
                                $weather = $weatherData[0];
                            @endphp
                            <div class="weather-cards">
                                <div class="weather-card">
                                    <i class="fas fa-temperature-high"></i>
                                    <h6>Temperature</h6>
                                    <p>{{ number_format($weather['temperature'], 2) }} °C</p>
                                </div>
                                <div class="weather-card">
                                    <i class="fas fa-tint"></i>
                                    <h6>Humidity</h6>
                                    <p>{{ $weather['humidity'] }}%</p>
                                </div>
                                <div class="weather-card">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <h6>Pressure</h6>
                                    <p>{{ $weather['pressure'] }} hPa</p>
                                </div>
                                <div class="weather-card">
                                    <i class="fas fa-wind"></i>
                                    <h6>Wind Speed</h6>
                                    <p>{{ number_format($weather['wind_speed'], 2) }} km/h</p>
                                </div>
                                <div class="weather-card">
                                    <i class="fas fa-cloud"></i>
                                    <h6>Weather</h6>
                                    <p>{{ $weather['weather_description'] }}</p>
                                </div>
                            </div>
                        @endif

                        <div id="map"></div>

                        <hr>
                        <h5>Data Stasiun Cuaca</h5>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Informasi Tabel Cuaca</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
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
        </div>
    </div>
@endsection

@push('javascript')
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example1').DataTable();
        });

        var map = L.map('map').setView([-7.4478, 112.7183], 8);

        var baseMaps = {
            "Google Streets": L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            "OpenStreetMap": L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }),
            "Google Hybrid": L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
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
                .setContent("<b>Lokasi:</b> Sidoarjo<br><br><u><b>ZOOM & Klik Awan untuk detail cuaca.!!!</b></u>")
                .openOn(map);

            var marker = L.marker([-7.4478, 112.7183], { icon: iconMarker })
                .addTo(map)
                .bindPopup(`
                    <div style="font-family: Arial, sans-serif; font-size: 12px; padding: 5px; max-width: 200px;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr><td><i class='fas fa-clock'></i></td><td><strong>Timestamp</strong></td><td>: {{ $weather['timestamp'] }}</td></tr>
                            <tr><td><i class='fas fa-map-marker-alt'></i></td><td><strong>City</strong></td><td>: {{ $weather['city'] }}</td></tr>
                            <tr><td><i class='fas fa-thermometer-half'></i></td><td><strong>Temperature</strong></td><td>: {{ number_format($weather['temperature'], 2) }}°C</td></tr>
                            <tr><td><i class='fas fa-tint'></i></td><td><strong>Humidity</strong></td><td>: {{ $weather['humidity'] }}%</td></tr>
                            <tr><td><i class='fas fa-tachometer-alt'></i></td><td><strong>Pressure</strong></td><td>: {{ $weather['pressure'] }} hPa</td></tr>
                            <tr><td><i class='fas fa-wind'></i></td><td><strong>Wind Speed</strong></td><td>: {{ number_format($weather['wind_speed'], 2) }} km/h</td></tr>
                            <tr><td><i class='fas fa-cloud'></i></td><td><strong>Weather</strong></td><td>: {{ $weather['weather_description'] }}</td></tr>
                        </table>
                    </div>
                `);
        @endforeach
    </script>
@endpush

<!-- ini kode lama -->