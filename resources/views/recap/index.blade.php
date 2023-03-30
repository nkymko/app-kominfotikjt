@extends('layouts.main')

@section('container')
    
    <!-- Table Data Sekbid -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Kartu Profil</h6>
                <div class="justify-content-end">
                    <a type="button" class="d-none d-sm-inline-block btn btn-sm btn-info -sm" data-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-download fa-sm text-white-50"></i>
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
            <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                    <tr>
                        <th style="width: 20%">Nama</th>
                        <td>{{ $data->user->name }}</td>
                        {{-- <td rowspan="4" width="15%"><img class="img-profile"
                            src="{{asset('img/undraw_profile_2.svg')}}"></td> --}}
                      </tr>
                      <tr>
                        <th>Tahun</th>
                        <td>{{ $data->year }}</td>
                      </tr>
                      <tr>
                        <th>Total Jam Kerja</th>
                        <td>{{ $data->workHour }}</td>
                      </tr>
                      <tr>
                        <th>Total Kehadiran</th>
                        <td>{{ $data->presence }}</td>
                      </tr>
                      <tr>
                        <th>Sakit/Izin</th>
                        <td >{{ $data->absence }}</td>
                      </tr>
                      <tr>
                        <th>Telat</th>
                        <td >{{ $data->late }}</td>
                      </tr>
                </table>
            </div>
            <div class="justify-content-center" style="display: flex">
                <a href="{{ URL::previous() }}" class="btn btn-secondary"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
            </div>
        </div>
    </div>
    <!-- End of Table Data Sekbid -->

@endsection