@extends('layouts.main')

@section('container')

    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif

    <!-- Table Data Riwayat Absen -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Riwayat Absen Pegawai</h6>
                <div class="justify-content-end">
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#importData">Import Data</a>
                    <a type="button" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" data-toggle="dropdown" aria-expanded="false">
                    Export Data
                    </a>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('data.export') }}">as XLSX</a>
                    <button class="dropdown-item" href="#">as PDF</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">

            <!-- Modal -->
            <div class="modal fade" id="importData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body justify-content-center">
                        <form action="/riwayat-absen" method="POST" enctype="multipart/form-data" style="display: flex" class="mb-2">
                            @csrf
                            <div class="import-form">
                                <input id="file-upload" type="file" name="file" class="form-control-file">
                            </div>
                            <br>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Status</th>
                            {{-- <th>Keterangan</th>
                            <th>Status</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $history)
                            <tr>
                                <td>{{ $history->uuid }}</td>
                                <td>{{ $history->name }}</td>
                                <td>{{ $history->date }}</td>
                                <td>{{ $history->clock_in }}</td>
                                <td>{{ $history->clock_out }}</td>
                                <td>{{ $history->status }}</td>
                                {{-- <td></td>
                                <td></td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End of Table Data Riwayat Absen -->

@endsection