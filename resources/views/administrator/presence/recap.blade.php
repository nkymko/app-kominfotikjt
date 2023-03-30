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
                <h6 class="m-0 font-weight-bold text-primary">Rekap Absen Pegawai</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        {{-- @dd($data); --}}
                        @foreach ($data as $users)
                            <tr>
                                <td width="5%">{{ $i }}</td>
                                <td>{{ $users->user->name }}</td>
                                <td width="10%">
                                    <div class="action" style="display: flex; gap: 0.2rem;">
                                        <a href="rekap-absen/{{ $users->user->username }}" class="btn btn-sm btn-info">VIEW</a>
                                    </div>
                                </td>
                            </tr>
                        @php
                            $i ++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End of Table Data Riwayat Absen -->

@endsection