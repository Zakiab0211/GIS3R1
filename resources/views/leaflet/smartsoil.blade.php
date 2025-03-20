
@extends('layouts.dashboard-volt')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">

    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
@endsection

@section('content')
<!-- awal kode untuk card -->
<div class="container-fluid">
    <div class="row">
        @foreach($postsoil as $soil)
            @php
                $parameters = [
                    ['label' => 'Moisture', 'value' => $soil->moisture, 'icon' => 'fas fa-tint', 'color' => 'primary'],
                    ['label' => 'Conductivity', 'value' => $soil->conductivity, 'icon' => 'fas fa-bolt', 'color' => 'secondary'],
                    ['label' => 'Soil pH', 'value' => $soil->ph, 'icon' => 'fas fa-flask', 'color' => 'warning'],
                    ['label' => 'Nitrogen', 'value' => $soil->nitrogen, 'icon' => 'fas fa-leaf', 'color' => 'success'],
                    ['label' => 'Phosphorus', 'value' => $soil->fosfor, 'icon' => 'fas fa-seedling', 'color' => 'danger'],
                    ['label' => 'Temperature', 'value' => $soil->temperature, 'icon' => 'fas fa-thermometer-half', 'color' => 'info']
                ];
            @endphp

            @foreach($parameters as $param)
                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-{{ $param['color'] }} rounded me-4 me-sm-0">
                                        <i class="{{ $param['icon'] }}"></i>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5">{{ $param['label'] }}</h2>
                                        <h3 class="fw-extrabold mb-1">{{ $param['value'] }}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-400 mb-0">{{ $param['label'] }}</h2>
                                        <h3 class="fw-extrabold mb-2">{{ $param['value'] }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        <!-- @endforeach -->
    <!-- </div>
</div> -->
  <!-- ini kode utama batas -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Smart Soil</div>
                    <div class="card-body">
                        <div id="map"></div>
                        <hr>
                        <h5>Data Soil</h5>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data-Soil-Sensor</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#example1").DataTable();
        });
        var map = L.map('map').setView([-7.279090, 112.792796], 8);

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
