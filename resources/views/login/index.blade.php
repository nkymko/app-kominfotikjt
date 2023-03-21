@extends('layouts.login')

@section('container')

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class=" col-lg-6 col-md-9">

            <div class="card o-hidden border-0 shadow my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                @if (session()->has('loginError'))
                                <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
                                {{ session('loginError') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                @endif
                                <div class="text-center">
                                    <img src="img/kominfotikjt.svg" alt="" width="300" class="mb-5">
                                    {{-- <h1 class="h4 text-gray-900 mb-5">Log In</h1> --}}
                                </div>
                                <form class="user" action="/auth" method="post">   
                                    @csrf
                                    <div class="input-grp">
                                        <div class="form-floating mb-4">
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="Email address" value="{{ old('email') }}" autofocus required>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                                        </div>
                                        <div class="captcha-box mb-4">
                                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div><br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block" style="font-weight:500; font-size:15px;">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection