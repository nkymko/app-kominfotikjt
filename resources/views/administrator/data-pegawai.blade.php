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

    <!-- Table Data Karyawan -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pegawai</h6>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addMember"><i
                            class="fas fa-plus fa-sm text-white-50"></i> Tambah Akun Pegawai </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Seksi Bidang</th>
                                <th>Alamat</th>
                                <th>Hp</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                             $i = 1;   
                            @endphp
                            @foreach ($profile as $member)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $member->user->name }}</td>
                                <td>{{ $member->position !=null ? $member->position->name : '-' }}</td>
                                <td>{{ $member->division !=null ? $member->division->name : '-' }}</td>
                                <td>{{ $member->address !=null ? $member->address : '-' }}</td>
                                <td>{{ $member->phone !=null ? $member->phone : '-' }}</td>
                                <td>Aktif</td>
                                <td>
                                    <form action="/data-pegawai/destroy" method="post">
                                      @csrf
                                      <input type="hidden" name="user_id" value="{{ $member->user->id }}">
                                      <input type="hidden" name="profile_id" value="{{ $member->id }}">
                                      <button class="btn btn-sm btn-danger show_confirm" type="submit" data-toggle="tooltip" title="Delete">DELETE</button>
                                    </form>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <!-- End of Table Data Karyawan -->

    <!-- Modal Box - Tambah Karyawan -->
    <div class="modal fade" id="addMember" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Karyawan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/data-pegawai/store" method="post">
                        @csrf
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputNama">Nama</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputNama" autocomplete="off" required value="{{ old('name') }}">
                            @error('name')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputEmail">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" autocomplete="off" required value="{{ old('email') }}">
                            @error('email')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputAddress">Alamat</label>
                          <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="inputAddress" placeholder="(optional)" autocomplete="off" value="{{ old('alamat') }}">
                          @error('alamat')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label for="inputAddress2">Handphone</label>
                          <input type="tel" name="phone-num" class="form-control @error('phone-num') is-invalid @enderror" id="inputAddress2" placeholder="(optional)" autocomplete="off" value="{{ old('phone-num') }}">
                          @error('phone-num')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror 
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputCity">Jabatan</label>
                            <select id="inputState" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror">
                                <option selected value="">None</option>
                                @foreach ($position as $pos)
                                  <option value="{{ $pos->id }}">{{ $pos->name }}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputState">Divisi</label>
                            <select name="divisi" id="inputState" class="form-control @error('divisi') is-invalid @enderror">
                              <option selected value="">None</option>
                              @foreach ($division as $div)
                                <option value="{{ $div->id }}" >{{ $div->name }}</option>
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

@endsection