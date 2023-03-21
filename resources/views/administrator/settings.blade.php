@extends('layouts.main')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Setelan</h1>

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
                <h6 class="m-0 font-weight-bold text-primary">Settings</h6>
                {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addShift"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Tambah Shift </a> --}}
            </div>
        </div>
        <div class="card-body">
            
        </div>
    </div>
    <!-- End of Table Data Riwayat Absen -->

    <div class="modal fade" id="addShift" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Shift Kerja</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" action="/shift" id="shift-form">
                @csrf
                <div class="form-group">
                    <label for="inputAddress">Nama</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid" placeholder="{{ $message }}" @enderror id="inputAddress">
                  </div>
                <div class="form-row">
                  <div class="col">
                    <p>Jam Masuk</p>
                    <div class="input-grp">
                        <input type="number" name="hour_in" id="hour_in" class="form-control @error('hour_in') is-invalid @enderror" min="0" max="24" placeholder="07">
                        <input type="number" name="minute_in" id="minute_in" class="form-control @error('minute_in') is-invalid @enderror" min="0" max="60" placeholder="30">
                    </div>
                  </div>
                  <div class="col">
                    <p>Jam Keluar</p>
                    <div class="input-grp">
                        <input type="number" name="hour_out" id="hour_out" class="form-control @error('hour_out') is-invalid @enderror" min="0" max="24" placeholder="16">
                        <input type="number" name="minute_out" id="minute_out" class="form-control @error('minute_out') is-invalid @enderror" min="0" max="60" placeholder="00">
                    </div>
                  </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="shift-button" disabled>Submit</button>
        </form>
        </div>
        </div>
    </div>
    </div>

@endsection