@extends('layouts.member')
@section('title', 'Dashboard')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $total_member_backlink }}</h3>

                                <p>Total submit link</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $total_backlink }}</h3>
                                <p>Total backlink</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->

                    <!-- ./col -->
                    <div class="col-lg-4 ">
                        <!-- small box -->
                        <div
                            class="small-box {{ Auth()->guard('member')->user()->type == 'FREE'? 'bg-light': 'bg-warning' }} p-2">
                            <div class="inner">
                                <h3 class="">
                                    Tipe akun
                                </h3>

                                <span
                                    class="badge p-2 {{ Auth()->guard('member')->user()->type == 'FREE'? 'badge-secondary': 'badge-danger' }}">
                                    {{ Auth()->guard('member')->user()->type == 'FREE'? 'Akun gratis': 'Akun premium' }}</span>

                                @if (Auth()->guard('member')->user()->type != 'FREE')
                                    <span class="badge p-2 badge-light">
                                        Berakhir pada {{ Auth()->guard('member')->user()->expired_date }}</span>
                                @endif

                            </div>
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

        </section>
        <!-- /.content -->
    </div>
@endsection
