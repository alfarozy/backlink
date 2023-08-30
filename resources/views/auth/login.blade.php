@extends('layouts.auth')
@section('title', 'Login')

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
                    <h3>Login Admin</h3>
                </div>
                <form action="{{ route('admin.login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-6">

                        </div>
                        <!-- /.col -->
                        <div class="col-6 text-right">
                            <a href="{{ route('forgotpassword') }}" class="text-primary">Lupa Password!</a>
                        </div>
                        <!-- /.col -->
                    </div> --}}
                    <hr>
                    <div class="social-auth-links text-center mb-3">
                        <button type="submit" class="btn btn-block btn-success"> Login
                        </button>
                    </div>
                </form>

                <!-- /.social-auth-links -->

            </div>
        </div>
    </div>
@endsection
