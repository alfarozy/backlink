@extends('layouts.auth')
@section('title', 'Registrasi pengguna baru')

@section('content')
    <div class="login-box">

        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body rounded">
                @if (session()->has('error'))
                    <div class="alert bg-danger text-center">
                        {!! session()->get('error') !!}
                    </div>
                @endif
                @if (session()->has('msg'))
                    <div class="alert bg-success text-center">
                        {!! session()->get('msg') !!}
                    </div>
                @endif
                <div class="text-center my-4 mb-5">
                    <h3>Registrasi Pengguna Baru</h3>
                </div>
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="mb-3">

                        <div class="input-group">
                            <input type="text" name="name" class="form-control" placeholder="Nama Lengkap">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        @error('name')
                            <small class="text-danger ml-1">{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="mb-3">

                        <div class="input-group">
                            <input type="text" name="phone" class="number form-control" placeholder="Nomor Whatsapp">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fab fa-whatsapp"></span>
                                </div>
                            </div>
                        </div>
                        @error('phone')
                            <small class="text-danger ml-1">{{ $message }}</small>
                        @else
                            <small class="text-muted ml-1">Harus diawali dengan 62, contoh 628126817****</small>
                        @enderror
                    </div>
                    <div class="mb-3">

                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @error('email')
                            <small class="text-danger ml-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">

                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @error('password')
                            <small class="text-danger ml-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('register') }}" class="text-primary">Kembali kehalaman Login
                        </div>
                        <!-- /.col -->
                    </div>
                    <hr>
                    <div class="social-auth-links text-center mb-3">
                        <button type="submit" class="btn btn-block btn-primary"> Register sekarang
                        </button>
                    </div>
                </form>

                <!-- /.social-auth-links -->

            </div>
        </div>
    </div>
@endsection
