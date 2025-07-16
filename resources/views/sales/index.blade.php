@extends('layout.main')

@section('content')
    <div class="page-content-wrapper dashborad-v">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="/dashboard">PT Niaga Mandiri</a></li>
                                <li class="breadcrumb-item active">Penjualan</li>
                                <li>
                                    <button type="button" class="btn btn-primary border-0 mb-2"
                                        style="margin-top: -5px; margin-left: 10px;" data-toggle="modal"
                                        data-target="#ModalTambahPenjualan">Tambah</button>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">Penjualan</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            @if (session('success'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Berhasil!</strong> {{ session('success') }}
                </div>
            @elseif ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Gagal!</strong> {{ $errors->first() }}
                </div>
            @endif

            {{-- Modal Tambah Penjualan --}}
            <div class="modal fade" id="ModalTambahPenjualan" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah data penjualan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('/sales/store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Tanggal Transaksi</label>
                                    <input type="date" class="form-control" name="tanggal_transaksi"
                                        value="{{ old('tanggal_transaksi') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Produk</label>
                                    <select class="form-control" name="nama_produk" id="nama_produk_select" required>
                                        <option value="">-- Pilih Produk --</option>
                                        @foreach ($products as $data)
                                            <option value="{{ $data['nama_produk'] }}" data-harga="{{ $data['harga'] }}">
                                                {{ $data['nama_produk'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Harga Produk</label>
                                    <input type="number" class="form-control" name="harga_produk" id="harga_produk_input"
                                        readonly required>
                                </div>
                                <div class="form-group">
                                    <label>Item Terjual</label>
                                    <input type="number" class="form-control" name="item_terjual"
                                        value="{{ old('item_terjual') }}" required>
                                </div>
                            </div>
                            <div class="modal-footer d-flex px-0">
                                <button type="button" class="btn btn-raised btn-secondary w-50 mx-1"
                                    data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-raised btn-primary w-50 mx-1">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Tabel Penjualan --}}
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered w-100 text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Nama Produk</th>
                                        <th>Item Terjual</th>
                                        <th>Total Penjualan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sales as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data['tanggal_transaksi'] }}</td>
                                            <td>{{ $data['nama_produk'] }}</td>
                                            <td>{{ $data['item_terjual'] }}</td>
                                            <td>Rp {{ number_format($data['total_penjualan'], 0, ',', '.') }}</td>
                                            <td>
                                                @if ($data['total_penjualan'] > 100000000)
                                                    <span class="badge badge-success">Sangat tinggi</span>
                                                @elseif($data['total_penjualan'] > 50000000 && $data['total_penjualan'] <= 100000000)
                                                    <span class="badge badge-secondary">Sedang</span>
                                                @elseif($data['total_penjualan'] > 20000000 && $data['total_penjualan'] <= 50000000)
                                                    <span class="badge badge-warning">Cukup</span>
                                                @elseif($data['total_penjualan'] > 10000000 && $data['total_penjualan'] <= 20000000)
                                                    <span class="badge badge-warning">Rendah</span>
                                                @elseif($data['total_penjualan'] <= 10000000)
                                                    <span class="badge badge-danger">Sangat Rendah</span>
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                <div class="row">
                                                    <div>
                                                        <button class="btn bg-warning border-0 mb-2 mr-2"
                                                            data-toggle="modal"
                                                            data-target="#editPenjualanModal{{ $loop->iteration }}">
                                                            <i class="mdi mdi-pencil text-white"></i>
                                                        </button>
                                                    </div>
                                                    <div>
                                                        <button type="button" class="btn bg-danger border-0 mb-2"
                                                            data-toggle="modal"
                                                            data-target="#deletePenjualanModal{{ $loop->iteration }}">
                                                            <i class="mdi mdi-delete text-white"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        {{-- Modal Edit --}}
                                        <div class="modal fade" id="editPenjualanModal{{ $loop->iteration }}"
                                            tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ url('/sales/update/' . ($loop->iteration - 1)) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="total_penjualan"
                                                            value="{{ $data['total_penjualan'] }}">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit data penjualan</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Tanggal Transaksi</label>
                                                                <input type="date" class="form-control"
                                                                    name="tanggal_transaksi"
                                                                    value="{{ $data['tanggal_transaksi'] }}" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Nama Produk</label>
                                                                <select class="form-control" name="nama_produk"
                                                                    id="edit_nama_produk_select_{{ $loop->iteration }}"
                                                                    required>
                                                                    <option value="">-- Pilih Produk --</option>
                                                                    @foreach ($products as $product)
                                                                        <option value="{{ $product['nama_produk'] }}"
                                                                            data-harga="{{ $product['harga'] }}"
                                                                            {{ $product['nama_produk'] === $data['nama_produk'] ? 'selected' : '' }}>
                                                                            {{ $product['nama_produk'] }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Harga Produk</label>
                                                                <input type="number" class="form-control"
                                                                    id="edit_harga_produk_input_{{ $loop->iteration }}"
                                                                    name="harga_produk"
                                                                    value="{{ $data['total_penjualan'] / $data['item_terjual'] ?? 0 }}"
                                                                    readonly required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Item Terjual</label>
                                                                <input type="number" class="form-control"
                                                                    name="item_terjual"
                                                                    value="{{ $data['item_terjual'] }}" required>
                                                            </div>

                                                        </div>

                                                        <div class="modal-footer d-flex px-0">
                                                            <button type="button" class="btn btn-raised btn-secondary w-50 mx-1"
                                                                data-dismiss="modal">Batal</button>
                                                            <button type="submit"
                                                                class="btn btn-raised btn-primary w-50 mx-1">Simpan</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                        {{-- Modal Hapus --}}
                                        <div class="modal fade" id="deletePenjualanModal{{ $loop->iteration }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi
                                                            hapus
                                                            kategori</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin ingin menghapus data penjualan "<strong
                                                                class="text-danger">{{ $data['nama_produk'] }}</strong>"
                                                        </p>
                                                    </div>
                                                    <form class="mb-0"
                                                        action="{{ url('/sales/destroy', $loop->iteration - 1) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-footer d-flex px-0">
                                                            <button type="button" class="btn btn-raised btn-secondary w-50 mx-1"
                                                                data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-raised btn-danger w-50 mx-1">Ya!
                                                                Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="6">Data tidak ditemukan</td>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectProduk = document.getElementById('nama_produk_select');
            const inputHarga = document.getElementById('harga_produk_input');

            selectProduk.addEventListener('change', function() {
                const selectedOption = selectProduk.options[selectProduk.selectedIndex];
                const harga = selectedOption.getAttribute('data-harga');
                inputHarga.value = harga || '';
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const allSelects = document.querySelectorAll('[id^="edit_nama_produk_select_"]');

            allSelects.forEach(select => {
                const iteration = select.id.split('_').pop();
                const inputHarga = document.getElementById(`edit_harga_produk_input_${iteration}`);

                select.addEventListener('change', function() {
                    const selectedOption = select.options[select.selectedIndex];
                    const harga = selectedOption.getAttribute('data-harga');
                    inputHarga.value = harga || '';
                });
            });
        });
    </script>
    <style>
        .dataTables_filter input {
            color: #000 !important;
            background-color: #fff !important;
            border: 1px solid #ccc;
        }
    </style>
@endsection
