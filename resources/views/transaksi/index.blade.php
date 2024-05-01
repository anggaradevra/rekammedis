@extends('partial.main')

@section('content')

<div class="page-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="page-breadcrumb">
                    <div class="row align-items-center">
                        <div class="col-md-6 col-8 align-self-center">
                            <h3 class="page-title mb-0 p-0">Transaksi</h3>
                            <div class="d-flex align-items-center">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container">
        <a type="button" href="/addtransaksi" class="btn btn-success text-white" data-toggle="modal"
            data-target="#myModal">Tambah +</a>

        <div class="row g-3 align-items-center mt-2">
            <div class="col-auto">
                
                <form action="{{ url('/db') }}" method="GET">
                    <input type="search" id="inputPassword6" name="search" class="form-control" placeholder="search">
                </form>
            </div>
            <div class="col-auto">
                <a type="button" href="/transaksi-pdf" class="btn btn-danger text-white">Export PDF</a>
            </div>
            <div class="col-auto">
                <a type="button" href="/transaksi-excel" class="btn btn-success ml-1 text-white">Export Excel</a>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Import Data
                </button>
            </div>
        </div>
        <div class="col-sm">
        <div class="card mt-2">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">No Registrasi</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No Telepon</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Usia</th>
                        <th scope="col">Total</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi as $key => $transaksis)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $transaksis->nama }}</td>
                        <td>{{ $transaksis->tgl }}</td>
                        <td>{{ $transaksis->no_registrasi }}</td>
                        <td>{{ $transaksis->alamat }}</td>
                        <td>{{ $transaksis->no_telepon }}</td>
                        <td>{{ $transaksis->usia }}</td>
                        <td>{{ $transaksis->jenis_kelamin }}</td>
                        <td>{{ $transaksis->total }}</td>
                        <td>
                            <div class="d-grid gap-2 d-md-flex ">
                                <a href="#" class="btn btn-danger btn-sm delete text-white" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-id="{{ $transaksis->id }}">Delete</a>
                                <a href="#"
                                    class="btn btn-info btn-sm text-white">Edit</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $transaksi->links('pagination::bootstrap-5') }}
        </div>
    </div>
    </div>
    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <span id="deleteName"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger text-white">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.delete').on('click', function () {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            $('#deleteForm').attr('action', '/data-pasien/' + id);
            $('#deleteName').text(nama);
        });
    });
</script>
@endpush
