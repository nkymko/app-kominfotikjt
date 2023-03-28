@extends('layouts.main')

@section('container')
    
    <!-- Table Data Sekbid -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Kartu Profil</h6>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm" data-toggle="modal" data-target="#addSekbid"><i
                                        class="fas fa-pen fa-sm text-white-50"></i> Sunting Profil </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                    <tr>
                        <th style="width: 20%">Nama</th>
                        <td>{{ $data->name }}</td>
                        <td rowspan="4" width="15%"><img class="img-profile"
                            src="{{asset('img/undraw_profile_2.svg')}}"></td>
                      </tr>
                      <tr>
                        <th>Jabatan</th>
                        <td>{{ $detail->position->name }}</td>
                      </tr>
                      <tr>
                        <th>Seksi Bidang</th>
                        <td>{{ $detail->division->name }}</td>
                      </tr>
                      <tr>
                        <th>Handphone</th>
                        <td colspan="2">{{ $data->profile->phone_num === '' ? $data->profile->phone_num : '-'}}</td>
                      </tr>
                      <tr>
                        <th>Seksi Bidang</th>
                        <td colspan="2">{{ $data->profile->address === '' ? $data->profile->address : '-' }}</td>
                      </tr>
                      <tr>
                        <th>Bergabung pada</th>
                        <td colspan="2">{{ $detail->join_at }}</td>
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