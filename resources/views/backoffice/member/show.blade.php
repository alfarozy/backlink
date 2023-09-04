@extends('layouts.backoffice')
@section('title', 'Detail user')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail user </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">

                                    <h3 class="card-title mt-1">@yield('title')</h3>
                                    <div class="right">

                                        <a href="{{ route('member.index') }}" class="btn btn-secondary btn-sm"> <i
                                                class="fa fa-arrow-left"></i>
                                            back</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Fullname </label>
                                            <input readonly type="text" name="name"
                                                value="{{ $data->name ?? old('name') }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Nama Lengkap">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input readonly type="text" name="email"
                                                value="{{ $data->email ?? old('email') }}"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Email">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <input readonly type="text" name="email"
                                                        value="{{ $data->status ?? old('status') }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Tipe akun</label>
                                                    <br>
                                                    @if ($data->type == 'FREE')
                                                        <button class="btn btn-secondary">Akun Gratis</button>
                                                    @else
                                                        <button class="btn btn-danger">Akun Premium</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @if ($data->type != 'FREE')
                                            <div class="form-group">
                                                <label>Tanggal berakhir berlangganan</label>
                                                <input readonly type="date" name="expired_date"
                                                    value="{{ $data->expired_date }}" class="form-control"
                                                    placeholder="expired_date">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <h5 class="text-center">Jadikan premium</h5>
                                        @if ($data->type == 'FREE')

                                            <form method="POST" action="{{ route('member.update', $data->id) }}"
                                                enctype="multipart/form-data">
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group">
                                                        <label>Pilih paket </label>
                                                        <select class="form-control" name="package_id" id="">
                                                            <option value="">-- Pilih paket --</option>
                                                            @foreach ($packages as $item)
                                                                <option value="{{ $item->id }}">{{ $item->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('package_id')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="text-center">

                                                        <button type="submit" class="btn btn-success col-md-6 mx-2">Jadikan
                                                            berlangganan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
