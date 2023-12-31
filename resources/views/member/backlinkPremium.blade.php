@extends('layouts.member')
@section('title', 'Backlink Premium')
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


                                <hr>
                                <table id="datatable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="40%">Website</th>
                                            <th width="25%" class="text-center">Keywords</th>
                                            <th width="10%" class="text-center">Staus</th>
                                            <th width="15%" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                                <td class="align-middle">
                                                    <b class="text-truncate"><a class="text-dark"
                                                            href="#">{{ $item->website }}</a></b>
                                                    <br>
                                                    <span>Backlink {{ $item->backlink->domain() }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    @foreach ($item->tags() as $tag)
                                                        <span class="badge badge-light border">{{ $tag }}</span>
                                                    @endforeach
                                                </td>
                                                <td class="text-center align-middle">
                                                    @if ($item->status == 'SUCCESS')
                                                        <button class="btn btn-sm btn-success">Selesai</button>
                                                    @elseif ($item->status == 'PROCESS')
                                                        <button class="btn btn-sm btn-primary">Sedang diproses</button>
                                                    @else
                                                        <button class="btn btn-sm btn-secondary">Menunggu
                                                            pembayaran</button>
                                                    @endif
                                                </td>


                                                <td class="align-middle">
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('dashboard.member.backlink.show', $item->id) }}"
                                                            class="btn btn-primary btn-sm m-1" title="Kunjungi Webiste">
                                                            Lihat
                                                            Detail</a>

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
