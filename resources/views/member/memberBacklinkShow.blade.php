@extends('layouts.member')
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
                                        <a href="#" class="btn btn-success btn-sm"> <i class="fab fa-whatsapp"></i>
                                            Hubungi admin</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">


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
