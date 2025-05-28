@extends('layouts.dashboard-volt')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" crossorigin="" />
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        .popup-content {
            font-family: Arial, sans-serif;
            font-size: 14px;
            max-width: 250px;
        }
        .popup-content img {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
            margin-top: 8px;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Sebaran Lahan Sawah</div>
                <div class="card-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('javascript')
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script>

<script>
    var map = L.map('map').setView([-7.2365, 112.5533], 15);

    var baseMaps = {
        "OpenStreetMap": L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }),
        "Google Streets": L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }),
        "Google Hybrid": L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        })
    };

    baseMaps["Google Hybrid"].addTo(map);
    L.control.layers(baseMaps).addTo(map);

    var popup = L.popup()
        .setLatLng([-7.236395, 112.554105])
        .setContent("<b>Lokasi:</b> Gresik<br><u><b>Zoom & klik marker untuk lihat info lahan!</b></u>")
        .openOn(map);

    var lahanIcon = L.icon({
        iconUrl: '{{ asset("iconMarkers/sawah.png") }}',
        iconSize: [40, 40],
        iconAnchor: [20, 40],
        popupAnchor: [0, -40]
    });

    var lahanData = [
        {
            lat: -7.237819,
            lng: 112.553038,
            nama: 'Lahan Sawah A',
            keterangan: 'Lahan dalam kondisi subur dan tanaman tumbuh hijau merata. Pemantauan dilakukan untuk mencegah serangan hama penggerek batang.',
            gambar: '{{ asset("hama/lahan1.jpg") }}'
        },
        {
            lat: -7.233379,
            lng: 112.553753,
            nama: 'Lahan Sawah B',
            keterangan: 'Pertumbuhan padi optimal dan tanah subur. Terpantau adanya indikasi awal walang sangit, namun masih dalam batas aman.',
            gambar: '{{ asset("hama/lahan2.jpg") }}'
        },
        {
            lat: -7.236874,
            lng: 112.554612,
            nama: 'Lahan Sawah C',
            keterangan: 'Lahan hijau dan subur dengan sistem irigasi lancar. Pemantauan rutin dilakukan untuk mendeteksi kemunculan wereng coklat secara dini.',
            gambar: '{{ asset("hama/lahan3.jpg") }}'
        }
    ];

    lahanData.forEach(function(lahan) {
        var popupContent = `
            <div class="popup-content">
                <strong>${lahan.nama}</strong><br>
                <p>${lahan.keterangan}</p>
                <img src="${lahan.gambar}" alt="${lahan.nama}">
            </div>
        `;

        L.marker([lahan.lat, lahan.lng], { icon: lahanIcon })
            .addTo(map)
            .bindPopup(popupContent);
    });
</script>
@endpush
