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
                                <li class="breadcrumb-item active">Kategori</li>
                                <li>
                                    <button type="button" class="btn btn-primary border-0 mb-2"
                                        style="margin-top: -5px; margin-left: 10px;" data-toggle="modal"
                                        data-target="#ModalTambahLokasi">Tambah</button>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">Kategori</h4>
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
                        <strong>Gagal!</strong> {{ $errors->first('nama_lokasi') }}
                    </div>
                </div>
            @endif
            <div class="modal fade" id="ModalTambahLokasi" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Tambah kategori baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="mb-0" action="{{ url('/category/store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="general-label">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="bmd-label-floating ">Nama kategori</label>
                                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                                            value="{{ old('nama_kategori') }}" required>
                                    </div>
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

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered w-100 text-center">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">No</th>
                                        <th>Nama kategori</th>
                                        <th class="d-flex justify-content-center align-items-center">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($categories as $data)
                                        <tr>
                                            <td style="width: 10%">{{ $loop->iteration }}</td>
                                            <td>{{ $data['nama_kategori'] }}</td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                <div class="row">
                                                    <div>
                                                        <button class="btn bg-warning  border-0 mb-2 mr-2"
                                                            data-toggle="modal"
                                                            data-target="{{ '#editCategoryModal' . $data['nama_kategori'] }}">
                                                            <i class="mdi mdi-pencil text-white"></i></button>
                                                    </div>
                                                    <div>
                                                        <button type="button" class="btn bg-danger border-0 mb-2"
                                                            data-toggle="modal"
                                                            data-target="{{ '#deleteCategoryModal' . $data['nama_kategori'] }}">
                                                            <i class="mdi mdi-delete text-white"></i></button>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                        {{-- Modal Hapus category --}}
                                        <div class="modal fade" id="{{ 'deleteCategoryModal' . $data['nama_kategori'] }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi hapus
                                                            kategori</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin ingin menghapus kategori "<strong
                                                                class="text-danger">{{ $data['nama_kategori'] }}</strong>"
                                                        </p>
                                                    </div>
                                                    <form class="mb-0"
                                                        action="{{ url('/category/destroy', $loop->iteration - 1) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
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
                                        {{-- End of modal hapus category --}}
                                        {{-- Modal edit category --}}
                                        <div class="modal fade" id="{{ 'editCategoryModal' . $data['nama_kategori'] }}"
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
                                                    <form class="mb-0"
                                                        action="{{ url('/category/update/' . $loop->iteration - 1) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="general-label">

                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1"
                                                                        class="bmd-label-floating ">Nama kategori</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nama_kategori" name="nama_kategori"
                                                                        value="{{ $data['nama_kategori'] }}" required>
                                                                </div>
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
                                        {{-- End of Modal edit category --}}
                                    @empty
                                        <tr>
                                            <td colspan="3">Data tidak ditemukan</td>
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
    <style>
        .dataTables_filter input {
            color: #000 !important;
            background-color: #fff !important;
            border: 1px solid #ccc;
        }
    </style>
@endsection
