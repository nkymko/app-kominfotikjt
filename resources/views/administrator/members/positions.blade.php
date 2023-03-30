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

    <!-- Table Data Data Jabatan -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Jabatan</h6>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addPosition"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Tambah Sekbid </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Jabatan</th>
                            <th>Jumlah Pegawai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($data as $position)
                        @if (strpos($position->name, 'Pimpinan') === false)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $position->name }}</td>
                                <td>{{ $position->member_sum }}</td>
                                <td>
                                    <form action="{{ route('position.destroy') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="pos_id" value="{{ $position->id }}">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data?')">DELETE</button>
                                    </form>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End of Table Data Jabatan -->

        {{-- Modal Box - Add Sekbid --}}
        <div class="modal fade" id="addPosition" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jabatan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('position.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="inputNama">Nama Jabatan</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputNama" autocomplete="off" required value="{{ old('name') }}">
                            @error('name')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Box - End --}}

@endsection