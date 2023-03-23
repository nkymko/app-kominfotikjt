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
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Bulan/Tahun</th>
                            <th>Total Jam Kerja</th>
                            <th>Total Hadir</th>
                            <th>Sakit/Izin</th> 
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button class="btn btn-sm btn-info" style="width: 40px"><i class="fas fa-eye sm"></i></button>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End of Table Data Riwayat Absen -->

@endsection