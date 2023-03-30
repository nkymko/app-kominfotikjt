@extends('layouts.main')

@section('container')
    
    <!-- Table Data Sekbid -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Rekap Absen</h6>
            </div>
        </div>
        <div class="card-body">
          <a type="button" class="d-none d-sm-inline-block btn btn-info btn-sm mb-3" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-download fa-sm text-white-50"></i>
             Export Data
          </a>
          <div class="dropdown-menu">
          <form action="{{ route('rekap.excel') }}" method="post">
            @csrf
            <input type="hidden" name="username" value="{{ $user->username }}">
            <button class="dropdown-item">as XLSX</button>
          </form>
          <form action="{{ route('rekap.pdf') }}" method="post">
            @csrf
            <input type="hidden" name="username" value="{{ $user->username }}">
            <button class="dropdown-item" type="submit">as PDF</button>
          </form>
          </div>
            <div class="table-responsive">
                <table class="table table-striped" width="100%" cellspacing="0">
                    <thead>
                      <th></th>
                      <th>Hadir</th>
                      <th>Sakit/Izin</th>
                      <th>Keterlambatan</th>
                      <th>Total Jam Kerja</th>
                    </thead>
                    <tbody>
                      @php
                        $hadir = 0;
                        $absen = 0;
                        $telat = 0;
                        $jamker = 0;
                      @endphp
                      @foreach ($data as $recap)
                        <tr>
                          <th style="width: 20%">{{ $recap->month }}</th>
                          <td>{{ $recap->hadir }}</td>
                          <td>{{ $recap->absen }}</td>
                          <td>{{ $recap->telat }}</td>
                          <td>{{ $recap->jamker }} jam</td>
                        </tr>
                        @php
                            $hadir += $recap->hadir;
                            $absen += $recap->absen;
                            $telat += $recap->telat;
                            $jamker += $recap->jamker;
                        @endphp
                      @endforeach
                      <tr>
                        <th style="border:none;">Total (1 tahun)</th>
                        <td>{{ $hadir }}</td>
                        <td>{{ $absen }}</td>
                        <td>{{ $telat }}</td>
                        <td>{{ $jamker }} jam</td>
                      </tr>
                    </tbody>
                </table>
            </div>
            <div class="justify-content-center" style="display: flex; gap: 0.3rem">
                <a href="{{ URL::previous() }}" class="btn btn-secondary"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
            </div>
        </div>
    </div>
    <!-- End of Table Data Sekbid -->

@endsection