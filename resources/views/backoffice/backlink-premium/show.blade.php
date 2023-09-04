@extends('layouts.backoffice')
@section('title', 'Detail backlink')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail backlink </h1>
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

                                        <a href="{{ route('dashboard.member.backlink.premium') }}"
                                            class="btn btn-secondary btn-sm"> <i class="fa fa-arrow-left"></i>
                                            Kemabali</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-8">

                                        <div class="">
                                            <span class="d-block"><b>Website</b></span>
                                            <span>{{ $data->website }}</span>
                                        </div>
                                        <div class="">
                                            <span class="d-block"><b>Website Backlink</b></span>
                                            <span>{{ $data->website_backlink ?? 'Belum di input' }}</span>
                                        </div>

                                        <div class="">
                                            <span class="d-block"><b>Artikel</b></span>
                                            <div class="bg-light p-3 border rounded">
                                                <h3>{{ $data->title }}</h3>
                                                {!! $data->content ?? 'Belum di input' !!}
                                            </div>
                                        </div>

                                        <div class="">
                                            <span class="d-block"><b>Harga</b></span>
                                            <span>
                                                {{ currencyIDR($data->backlink->price) }}
                                            </span>
                                        </div>
                                        <div class="">
                                            <span class="d-block"><b>Status</b></span>
                                            <span>
                                                @if ($data->status == 'SUCCESS')
                                                    <button class="btn btn-sm btn-success">Selesai</button>
                                                @elseif ($data->status == 'PROCESS')
                                                    <button class="btn btn-sm btn-primary">Sedang diproses</button>
                                                @else
                                                    <button class="btn btn-sm btn-secondary">Menunggu
                                                        pembayaran</button>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="">
                                            <span class="d-block"><b>Tipe artikel</b></span>
                                            <span>
                                                @if ($data->type == 1)
                                                    <button class="btn btn-sm btn-success">Artikel sendiri</button>
                                                @else
                                                    <button class="btn btn-sm btn-primary">Artikel oleh admin</button>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        @if ($data->status == 'WAITING')
                                            <form method="POST" action="{{ route('data-backlink-premium.store') }}"
                                                enctype="multipart/form-data">
                                                <!-- /.card-header -->
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                <input type="hidden" name="status" value="PROCESS">
                                                <button type="submit" class="btn btn-success mx-2">Konfirmasi
                                                    pembayaran</button>
                                            </form>
                                        @else
                                            @if ($data->status != 'SUCCESS')

                                                <form method="POST"
                                                    action="{{ route('data-backlink-premium.update', $data->id) }}"
                                                    enctype="multipart/form-data">
                                                    <!-- /.card-header -->
                                                    @method('put')
                                                    @csrf

                                                    <div class="form-group">
                                                        <label>Hasil Backlink </label>
                                                        <input type="url" name="website_backlink"
                                                            value="{{ old('website_backlink') }}"
                                                            class="form-control @error('website_backlink') is-invalid @enderror">
                                                        @error('website_backlink')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    @if ($data->type == 0)
                                                        <div class="form-group">
                                                            <label>Judul artikel</label>
                                                            <input type="text" name="title"
                                                                value="{{ old('title') }}"
                                                                class="title form-control @error('title') is-invalid @enderror">
                                                            @error('title')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Konten</label>
                                                            <textarea type="text" name="content" maxlength="100"
                                                                class="editor form-control @error('content') is-invalid @enderror"> {{ old('content') }}</textarea>
                                                            @error('content')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    @endif
                                                    <button type="submit" class="btn btn-success mx-2">Selesaikan
                                                        pesanan</button>
                                                </form>
                                            @endif
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
