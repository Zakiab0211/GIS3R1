{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.dashboard-volt')

@section('content')

<div class="col-12 col-sm-6 col-xl-4 mb-4">
    <div class="card border-0 shadow">
        <div class="card-body">
            <div class="row d-block d-xl-flex align-items-center">
                <div
                    class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                    <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                        <svg class="icon" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                            </path>
                        </svg>
                    </div>
                    <div class="d-sm-none">
                        <h2 class="h5">Customers</h2>
                        <h3 class="fw-extrabold mb-1">345,678</h3>
                    </div>
                </div>
                <div class="col-12 col-xl-7 px-xl-0">
                    <div class="d-none d-sm-block">
                        <h2 class="h6 text-gray-400 mb-0">Access Users</h2>
                        <h3 class="fw-extrabold mb-2">345k</h3>
                    </div>
                    <small class="d-flex align-items-center text-gray-500">
                        Feb 1 - Dec 1 2024,
                        <svg class="icon icon-xxs text-gray-500 ms-2 me-1" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z"
                                clip-rule="evenodd"></path>
                        </svg>
                        INA
                    </small>
                    <div class="small d-flex mt-1">
                        <div>Since last month <svg class="icon icon-xs text-success" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                    clip-rule="evenodd"></path>
                            </svg><span class="text-success fw-bolder">22%</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12 col-sm-6 col-xl-4 mb-4">
    <div class="card border-0 shadow">
        <div class="card-body">
            <div class="row d-block d-xl-flex align-items-center">
                <div
                    class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                    <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                        <svg class="icon" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="d-sm-none">
                        <h2 class="fw-extrabold h5">Revenue</h2>
                        <h3 class="mb-1">$25.543 M</h3>
                    </div>
                </div>
                <div class="col-12 col-xl-7 px-xl-0">
                    <div class="d-none d-sm-block">
                        <h2 class="h6 text-gray-400 mb-0">Revenue</h2>
                        <h3 class="fw-extrabold mb-2">$25.543 M</h3>
                    </div>
                    <small class="d-flex align-items-center text-gray-500">
                        Feb 1 - Dec 1 2024,
                        <svg class="icon icon-xxs text-gray-500 ms-2 me-1" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z"
                                clip-rule="evenodd"></path>
                        </svg>
                        GER
                    </small>
                    <div class="small d-flex mt-1">
                        <div>Since last month <svg class="icon icon-xs text-danger" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg><span class="text-danger fw-bolder">2%</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12 col-sm-6 col-xl-4 mb-4">
    <div class="card border-0 shadow">
        <div class="card-body">
            <div class="row d-block d-xl-flex align-items-center">
                <div
                    class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                    <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                        <svg class="icon" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="d-sm-none">
                        <h2 class="fw-extrabold h5"> Bounce Rate</h2>
                        <h3 class="mb-1">75.88%</h3>
                    </div>
                </div>
                <div class="col-12 col-xl-7 px-xl-0">
                    <div class="d-none d-sm-block">
                        <h2 class="h6 text-gray-400 mb-0"> Bounce Rate</h2>
                        <h3 class="fw-extrabold mb-2">75.88%</h3>
                    </div>
                    <small class="text-gray-500">
                        Feb 1 - Dec 1 2024
                    </small>
                    <div class="small d-flex mt-1">
                        <div>Since last month <svg class="icon icon-xs text-success" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                    clip-rule="evenodd"></path>
                            </svg><span class="text-success fw-bolder">4%</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tambahkan container untuk grafik -->
<!-- Tambahkan container untuk grafik -->
<div class="row">
    <!-- CPU Utilization Chart (Line) -->
    <div class="col-12 col-xl-6 mb-4">
        <div class="card border-0 shadow">
            <div class="card-header">
                <h5 class="mb-0">CPU Utilization (%)</h5>
            </div>
            <div class="card-body">
                <canvas id="cpuChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- Network Byte Out Chart (Bar) -->
    <div class="col-12 col-xl-6 mb-4">
        <div class="card border-0 shadow">
            <div class="card-header">
                <h5 class="mb-0">Network Byte Out (KBps)</h5>
            </div>
            <div class="card-body">
                <canvas id="networkChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- Memory Used Chart (Flot - Real Time) -->
    <div class="col-12 col-xl-6 mb-4">
        <div class="card border-0 shadow">
            <div class="card-header">
                <h5 class="mb-0">Memory Used (GB)</h5>
            </div>
            <div class="card-body">
                <div id="memoryChart" style="height: 300px;"></div>
            </div>
        </div>
    </div>

    <!-- Check Status Failed Chart (Doughnut) -->
    <div class="col-12 col-xl-6 mb-4">
        <div class="card border-0 shadow">
            <div class="card-header">
                <h5 class="mb-0">Failed Checks</h5>
            </div>
            <div class="card-body">
                <canvas id="failedChart" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Tambahkan jQuery dan Flot.js -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.0/jquery.flot.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.0/jquery.flot.time.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.0/jquery.flot.resize.min.js"></script>

<script>
    // Data real-time
    let cpuData = Array(10).fill(50); // Mulai dengan nilai 50%
    let networkData = Array(10).fill(100); // Mulai dengan nilai 100 KBps
    let failedChecksData = [5, 10, 3, 7, 8]; // Data random gagal
    let memoryData = [{ data: [], color: '#dc3545', label: 'Memory Used (GB)' }];

    // Fungsi untuk menghitung moving average agar CPU stabil
    function movingAverage(data, windowSize) {
        return data.slice(-windowSize).reduce((a, b) => a + b, 0) / windowSize;
    }

    // Inisialisasi grafik Chart.js
    let cpuChart = new Chart(document.getElementById('cpuChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: Array.from({ length: 10 }, (_, i) => `T-${i * 3}s`),
            datasets: [{
                label: 'CPU Utilization (%)',
                data: cpuData,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    let networkChart = new Chart(document.getElementById('networkChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: Array.from({ length: 10 }, (_, i) => `T-${i * 3}s`),
            datasets: [{
                label: 'Network Byte Out (KBps)',
                data: networkData,
                backgroundColor: 'rgba(255, 206, 86, 0.5)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    let failedChart = new Chart(document.getElementById('failedChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['instances 1', 'instances 2', 'instances 3', 'instances 4', 'instances 5'],
            datasets: [{
                label: 'Failed Checks',
                data: failedChecksData,
                backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(75, 192, 192, 0.6)', 'rgba(255, 206, 86, 0.6)', 'rgba(153, 102, 255, 0.6)']
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    function updateCharts() {
        let newCpu = Math.random() * 20 + 40; // Nilai antara 40-60
        cpuData.push(movingAverage([...cpuData, newCpu], 5));
        cpuData.shift();
        cpuChart.data.datasets[0].data = cpuData;
        cpuChart.update();

        let newNetwork = Math.random() * 50 + 80; // Nilai antara 80-130
        networkData.push(newNetwork);
        networkData.shift();
        networkChart.data.datasets[0].data = networkData;
        networkChart.update();

        let newFailed = Math.floor(Math.random() * 10);
        failedChecksData[Math.floor(Math.random() * 5)] = newFailed;
        failedChart.data.datasets[0].data = failedChecksData;
        failedChart.update();
    }

    function generateMemoryData() {
        var now = new Date().getTime();
        memoryData[0].data.push([now, Math.random() * 2 + 4]); // Memory antara 4-6GB
        if (memoryData[0].data.length > 10) memoryData[0].data.shift();
        $.plot('#memoryChart', memoryData, {
            series: { lines: { show: true, lineWidth: 2, fill: true } },
            xaxis: { mode: 'time', timeformat: '%H:%M:%S' },
            yaxis: { min: 4, max: 6 }
        });
    }

    // Jalankan update setiap 3 detik
    setInterval(updateCharts, 3000);
    setInterval(generateMemoryData, 3000);
</script>
@endsection