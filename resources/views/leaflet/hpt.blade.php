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
                <div class="card-header">Peta Hama Penyakit Tanaman (HPT)</div>
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
    // Inisialisasi peta hanya SEKALI
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

    // Tambahkan popup awal lokasi
    var popup = L.popup()
        .setLatLng([-7.236395, 112.554105])
        .setContent("<b>Lokasi:</b> Gresik<br><u><b>Zoom & klik marker untuk detail!</b></u>")
        .openOn(map);

    // Icon marker khusus untuk hama
    var pestIcon = L.icon({
        iconUrl: '{{ asset("iconMarkers/pest.png") }}',
        iconSize: [40, 40],
        iconAnchor: [20, 40],
        popupAnchor: [0, -40]
    });

    // Data HPT
    var hamaData = [
        {
            lat: -7.237819,
            lng: 112.553038,
            nama: 'Wereng Coklat',
            keterangan: 'Wereng coklat adalah hama utama yang menyerang tanaman padi dan dapat menyebabkan daun menjadi kering.',
            gambar: '{{ asset("hama/wereng_coklat.jpg") }}'
        },
        {
            lat: -7.233379,
            lng: 112.553753,
            nama: 'Penggerek Batang',
            keterangan: 'Penggerek batang menyerang batang tanaman, menyebabkan tanaman menjadi layu dan mudah roboh.',
            gambar: '{{ asset("hama/penggerek_batang.jpg") }}'
        },
        {
            lat: -7.236874,
            lng: 112.554612,
            nama: 'Walang Sangit',
            keterangan: 'walang menyebabkan daun menguning dan menurunkan kualitas tanaman secara keseluruhan.',
            gambar: '{{ asset("hama/walang.jpg") }}'
        }
    ];

    // Loop marker
    hamaData.forEach(function(hama) {
        var popupContent = `
            <div class="popup-content">
                <strong>${hama.nama}</strong><br>
                <p>${hama.keterangan}</p>
                <img src="${hama.gambar}" alt="${hama.nama}">
            </div>
        `;

        L.marker([hama.lat, hama.lng], { icon: pestIcon })
            .addTo(map)
            .bindPopup(popupContent);
    });
</script>
@endpush
