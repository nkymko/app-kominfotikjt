@extends('layouts.main')

@section('container')
    
    {{-- Alert --}}
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif


    <!-- Table Data Sekbid -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Seksi Bidang</h6>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addSekbid"><i
                                        class="fas fa-plus fa-sm text-white-50"></i> Tambah Sekbid </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sekbid</th>
                            <th>Pimpinan</th>
                            <th>Jumlah Karyawan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $divisi)
                        <tr>
                            <td>{{ $divisi->name }}</td>
                            <td>{{ $divisi->lead !=null ? $divisi->user->name : '-' }}</td>
                            <td>{{ $divisi->member_sum }}</td>
                            <td>
                                <form action="/data-sekbid/destroy" method="post">
                                    @csrf
                                    <input type="hidden" name="div_id" value="{{ $divisi->id }}">
                                    <button class="btn btn-sm btn-danger show_confirm" type="submit" data-toggle="tooltip" title="Delete">DELETE</button>
                                  </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End of Table Data Sekbid -->

    {{-- Modal Box - Add Sekbid --}}
    <div class="modal fade" id="addSekbid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Seksi Bidang</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/data-sekbid" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="inputNama">Nama Sekbid</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputNama" autocomplete="off" required value="{{ old('name') }}">
                            @error('name')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputLead">Pimpinan Sekbid</label>
                                <select id="inputLead" name="lead" class="form-control @error('lead') is-invalid @enderror">
                                    <option selected value="">None</option>
                                    @foreach ($user as $option)
                                    <option value="{{ $option->id }}">{{ $option->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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