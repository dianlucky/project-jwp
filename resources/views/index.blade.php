@extends('layout.main')

@section('content')
    <div class="page-content-wrapper dashborad-v">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="/">PT Niaga Mandiri</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="row">
                <!-- Column -->
                <div class="col-xl-6">
                    <div class="card bg-secondary m-b-30">
                        <div class="card-body">
                            <div class="d-flex row">
                                <div class="col-3 align-self-center">
                                    <div class="round">
                                        <i class="mdi mdi-cart"></i>
                                    </div>
                                </div>
                                <div class="col-8 ml-auto align-self-center text-center">
                                    <div class="m-l-10 text-white float-right">
                                        <h5 class="mt-0 round-inner">{{ $totalSoldItems }}</h5>
                                        <p class="mb-0">Total produk terjual bulan ini</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Produk Terlaris 6 Bulan Terakhir</h4>
                            <canvas id="chart6Months" height="300"></canvas>
                        </div>
                    </div>
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Jumlah Penjualan 6 Bulan Terakhir</h4>
                            <canvas id="chartSalesMonthly" height="300"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-md-12 col-xl-6">
                    <div class="card m-b-30 h-360">
                        <div class="card-body">
                            <h5 class="header-title mt-0">Produk terlaris</h5>
                            <div class="col-12">
                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px">No</th>
                                            <th>Nama Produk</th>
                                            <th>Kategori</th>
                                            <th>Jumlah terjual</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($topProductPerCategory as $category => $data)
                                            <tr>
                                                <td style="width: 10%">{{ $loop->iteration }}</td>
                                                <td>{{ $data['product'] ?? '-' }}</td>
                                                <td>{{ $category }}</td>
                                                <td>
                                                    <span class="badge badge-pill text-uppercase badge-success">
                                                        {{ $data['total_sold'] }} Terjual
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">Data tidak ditemukan</td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card m-b-30 h-360">
                        <div class="card-body">
                            <h5 class="header-title mt-0">Data penjualan</h5>
                            <div class="col-12">
                                <table id="datatable2" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px">No</th>
                                            <th>Nama Produk</th>
                                            <th>Total penjualan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($productStatusList as $data)
                                            <tr>
                                                <td style="width: 10%">{{ $loop->iteration }}</td>
                                                <td>{{ $data['nama_produk'] ?? '-' }}</td>
                                                <td>Rp. {{ number_format($data['total_penjualan'], 0, ',', '.') }}</td>
                                                <td>
                                                    <span class="badge badge-pill text-uppercase badge-success">
                                                        {{ $data['status'] }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">Data tidak ditemukan</td>
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
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx6 = document.getElementById('chart6Months').getContext('2d');
            new Chart(ctx6, {
                type: 'bar',
                data: {
                    labels: @json($chartLabels6Months),
                    datasets: [{
                        label: 'Total Produk Terjual (6 Bulan Terakhir)',
                        data: @json($chartData6Months),
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#datatable2').DataTable({
                responsive: true,
                pageLength: 10,

            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('chartSalesMonthly').getContext('2d');
            const chart6Months = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels6MonthsBars),
                    datasets: [{
                        label: 'Total Penjualan (Rp)',
                        data: @json($data6MonthsBars),
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
