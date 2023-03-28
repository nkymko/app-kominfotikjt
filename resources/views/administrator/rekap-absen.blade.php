@extends('layouts.main')

@section('container')

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
                            <th>Tahun</th>
                            <th>Total Jam Kerja</th>
                            <th>Total Hadir</th>
                            <th>Sakit/Izin</th>
                            <th>Telat</th> 
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($data as $users)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $users->user->name }}</td>
                                <td>{{ $month }}</td>
                                <td>{{ $users->workHour }} jam</td>
                                <td>{{ $users->total_hadir }}</td>
                                <td></td>
                                <td>{{ $users->telat }}</td>
                                <td>
                                    <a href="rekap-absen/{{ $users->user->username }}" class="btn btn-sm btn-info">VIEW</a>
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