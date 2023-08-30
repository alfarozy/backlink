@extends('layouts.member')
@section('title', 'Data backlink saya')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
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
                                <div class="row justify-content-between">
                                    <div class="col-sm-6 col-lg-6">
                                        <h3 class="card-title mt-2 ">@yield('title')</h3>
                                    </div>
                                    <div class="col-sm-6 col-lg-6  text-right ">
                                        <a href="{{ route('dashboard.member.backlink.create') }}"
                                            class="btn btn-success btn-sm m-1">
                                            <i class="fa fa-plus"></i>
                                            Tambah data</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if (session()->has('msg'))
                                    <div class="alert bg-success fade show" role="alert">
                                        {{ session()->get('msg') }}
                                    </div>
                                @endif
                                @if (session()->has('error'))
                                    <div class="alert bg-danger fade show" role="alert">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                                <a href="{{ route('dashboard.member.submit.backlink') }}"
                                    class="btn btn-sm {{ !request()->category ? 'btn-primary' : 'btn-outline-primary' }}">All</a>
                                @foreach ($categories as $item)
                                    <a href="{{ route('dashboard.member.submit.backlink', ['category' => $item->slug]) }}"
                                        class="btn btn-sm {{ request()->category == $item->slug ? 'btn-primary' : 'btn-outline-primary' }}">{{ $item->name }}</a>
                                @endforeach
                                <hr>
                                <table id="datatable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="60%">Website</th>
                                            <th width="20%">Kategori</th>
                                            <th width="15%" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                                <td class="align-middle">
                                                    <b class="text-truncate"><a class="text-dark"
                                                            href="{{ $item->url }}">{{ $item->domain() }}</a></b>
                                                    <br>
                                                    <span class="text-muted">{{ $item->url }}
                                                    </span>
                                                </td>
                                                <td class="align-middle">
                                                    {{ $item->backlink->category->name }}
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex justify-content-center">

                                                        <a href="{{ $item->url }}" target="_BLANK"
                                                            class="m-1 btn btn-sm btn-primary" data-toggle="tooltip"
                                                            data-placement="top" title="Kunjungi Webiste"><i
                                                                class="fa fa-link"></i></a>

                                                        <form class="d-inline"
                                                            action="{{ route('dashboard.member.backlink.delete', $item->id) }}"
                                                            method="post"
                                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data?');">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="m-1 btn btn-sm btn-danger" data-toggle="tooltip"
                                                                data-placement="top" title="Hapus item"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
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
