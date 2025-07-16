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
                                <li class="breadcrumb-item active">Produk</li>
                                <li>
                                    <button type="button" class="btn btn-primary border-0 mb-2"
                                        style="margin-top: -5px; margin-left: 10px;" data-toggle="modal"
                                        data-target="#ModalTambahProduk">Tambah</button>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">Produk</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            @if (session('success'))
                <div>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Berhasil!</strong> {{ session('success') }}
                    </div>
                </div>
            @elseif ($errors->any())
                <div>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Gagal!</strong> {{ $errors->first() }}
                    </div>
                </div>
            @endif

            {{-- Modal Tambah Produk --}}
            <div class="modal fade" id="ModalTambahProduk" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form class="modal-content mb-0" action="{{ url('/product/store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Tambah produk baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control" name="nama_produk" required>
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="nama_kategori" class="form-control" required>
                                    <option value="">Pilih kategori</option>
                                    @foreach ($categories as $kategori)
                                        <option value="{{ $kategori['nama_kategori'] }}">{{ $kategori['nama_kategori'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" class="form-control" name="harga" required>
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

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered w-100 text-center">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">No</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th class="d-flex justify-content-center align-items-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td style="width: 10%">{{ $loop->iteration }}</td>
                                            <td>{{ $product['nama_produk'] }}</td>
                                            <td>{{ $product['nama_kategori'] }}</td>
                                            <td>Rp {{ number_format($product['harga'], 0, ',', '.') }}</td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                <div class="row">
                                                    <div>
                                                        <button class="btn bg-warning border-0 mb-2 mr-2"
                                                            data-toggle="modal"
                                                            data-target="{{ '#editProductModal' . $loop->iteration }}">
                                                            <i class="mdi mdi-pencil text-white"></i></button>
                                                    </div>
                                                    <div>
                                                        <button type="button" class="btn bg-danger border-0 mb-2"
                                                            data-toggle="modal"
                                                            data-target="{{ '#deleteProductModal' . $loop->iteration }}">
                                                            <i class="mdi mdi-delete text-white"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        {{-- Modal Hapus Produk --}}
                                        <div class="modal fade" id="{{ 'deleteProductModal' . $loop->iteration }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form class="modal-content bg-white mb-0"
                                                        action="{{ url('/product/destroy/' . ($loop->iteration - 1)) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Konfirmasi hapus produk</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin ingin menghapus produk
                                                                "<strong
                                                                    class="text-danger">{{ $product['nama_produk'] }}</strong>"?
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer d-flex px-0">
                                                            <button type="button"
                                                                class="btn btn-raised btn-secondary w-50 mx-1"
                                                                data-dismiss="modal">Batal</button>
                                                            <button type="submit"
                                                                class="btn btn-raised btn-danger w-50 mx-1">Ya! Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        {{-- Modal edit product --}}
                                        <div class="modal fade" id="{{ 'editProductModal' . $loop->iteration }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit data
                                                            kategori</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form class="modal-content bg-white mb-0"
                                                        action="{{ url('/product/update/' . ($loop->iteration - 1)) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit produk</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Nama Produk</label>
                                                                <input type="text" class="form-control"
                                                                    name="nama_produk"
                                                                    value="{{ $product['nama_produk'] }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Kategori</label>
                                                                <select name="nama_kategori" class="form-control"
                                                                    required>
                                                                    @foreach ($categories as $kategori)
                                                                        <option value="{{ $kategori['nama_kategori'] }}"
                                                                            {{ $kategori['nama_kategori'] == $product['nama_kategori'] ? 'selected' : '' }}>
                                                                            {{ $kategori['nama_kategori'] }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Harga</label>
                                                                <input type="number" class="form-control" name="harga"
                                                                    value="{{ $product['harga'] }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer d-flex px-0">
                                                            <button type="button"
                                                                class="btn btn-raised btn-secondary w-50 mx-1"
                                                                data-dismiss="modal">Batal</button>
                                                            <button type="submit"
                                                                class="btn btn-raised btn-primary w-50 mx-1">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End of Modal edit product --}}

                                    @empty
                                        <tr>
                                            <td colspan="5">Data tidak ditemukan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
@endsection
