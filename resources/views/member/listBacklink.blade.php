@extends('layouts.member')
@section('title', 'Data backlink')
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

                                <div class="text-center">
                                    <a href="{{ route('dashboard.member.listbacklink') }}"
                                        class="btn btn-sm m-1 {{ !request()->category ? 'btn-primary' : 'btn-outline-primary' }}">All</a>
                                    @foreach ($categories as $item)
                                        <a href="{{ route('dashboard.member.listbacklink', ['category' => $item->slug]) }}"
                                            class="btn btn-sm m-1 
                                            
                                            @if (request()->category == $item->slug) @if ($item->slug == 'premium') btn-warning

                                            @else
                                            btn-primary @endif
@else
@if ($item->slug == 'premium') btn-light border border-warning

                                            @else
                                            btn-outline-primary @endif
                                            @endif
                                            ">
                                            @if ($item->slug == 'premium')
                                                <i class="fa fa-star"></i>
                                            @endif
                                            {{ $item->name }}
                                        </a>
                                    @endforeach
                                </div>
                                <hr>
                                <table id="datatable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="40%">Website</th>
                                            @if (request()->category == 'premium')
                                                <th width="15%" class="text-center">Harga</th>
                                            @endif
                                            <th width="15%" class="text-center">Kategori</th>
                                            <th width="10%" class="text-center">Rating</th>
                                            <th width="10%" class="text-center">Type</th>
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
                                                    <span class="text-muted">{{ $item->description }}
                                                    </span>
                                                </td>
                                                @if (request()->category == 'premium')
                                                    <td class="align-middle text-center">
                                                        <span>{{ currencyIDR($item->price) }}</span>
                                                    </td>
                                                @endif

                                                <td class="align-middle text-center">
                                                    <span>{{ $item->category->name }}</span>
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $item->domain_rating }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    @if ($item->type == 'NOFOLLOW')
                                                        <button class="btn btn-sm btn-danger">{{ $item->type }}
                                                        </button>
                                                    @else
                                                        <button class="btn btn-sm btn-success">{{ $item->type }}</button>
                                                    @endif
                                                </td>


                                                <td class="align-middle">
                                                    <div class="d-flex justify-content-center">

                                                        <a href="{{ $item->url }}" target="_BLANK"
                                                            class="m-1 btn btn-sm btn-primary" data-toggle="tooltip"
                                                            data-placement="top" title="Kunjungi Webiste"><i
                                                                class="fa fa-link"></i> Kunjungi</a>

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
