@extends('layouts.dashboard-volt')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
<!-- awal kode -->

 <!-- awal kode untuk card -->
<div class="container-fluid">
    <div class="row">
        @foreach($postIrrigation as $irrigation)
            @php
                $parameters = [
                    ['label' => 'Curah Hujan ( /mm)', 'value' => $irrigation->curah_hujan, 'icon' => 'fas fa-tint', 'color' => 'primary'],
                    ['label' => 'Liquid Volume ( /ℓ)', 'value' => $irrigation->liquid_volume, 'icon' => 'fas fa-bolt', 'color' => 'secondary'],
                    ['label' => 'Timestamp (dd/mm/yyyy)', 'value' => $irrigation->timestamp, 'icon' => 'fas fa-clock', 'color' => 'info'],
                    ['label' => 'Flow Rate ( L/s)', 'value' => $irrigation->flow_rate, 'icon' => 'fas fa-vial', 'color' => 'success'],
                    ['label' => 'Jarak ( /M)', 'value' => $irrigation->jarak, 'icon' => 'fas fa-ruler', 'color' => 'danger']
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
        <!-- @endforeach
    </div>
</div> -->
<!-- bataskode -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Smart Irrigation</div>
                <div class="card-body">
                    <div id="map"></div>
                    <hr>
                    <h5>Data Irrigation</h5>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Tabel Irrigasi</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
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
                                            <td>{{ $irrigation->curah_hujan }}mm</td>
                                            <td>{{ $irrigation->liquid_volume }}L</td>
                                            <td>{{ $irrigation->timestamp }}</td>
                                            <td>{{ $irrigation->longitude }}</td>
                                            <td>{{ $irrigation->latitude }}</td>
                                            <td>{{ $irrigation->flow_rate }}L/s</td>
                                            <td>{{ $irrigation->jarak }}M</td>
                                        </tr>
                                    @endforeach
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
                        <tr>flow
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
