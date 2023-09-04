@extends('layouts.backoffice')
@section('title', 'Data member')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Daftar Pengguna </h1>
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
                                <div class="row justify-content-between">
                                    <div class="col-sm-6 col-lg-6">
                                        <h3 class="card-title mt-2 ">@yield('title')</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="40%">Nama Lengkap</th>
                                            <th width="16%">Nomor Whatsapp</th>
                                            <th width="14%" class="text-center">Register date</th>
                                            <th width="10%" class="text-center">Langganan</th>
                                            <th width="10%" class="text-center">Status</th>
                                            <th width="10%" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td class="align-middle" style="line-height: 10px">
                                                    <p>{{ $item->name }}</p>
                                                    <small class="text-muted">{{ $item->email }}
                                                    </small>
                                                </td>
                                                <td class="align-middle">{{ $item->phone }}</td>
                                                <td class="align-middle text-center">
                                                    {{ $item->created_at->translatedFormat('d-F-Y') }} </td>
                                                <td class="align-middle text-center">
                                                    @if ($item->type == 'FREE')
                                                        <button class="btn btn-sm btn-secondary">Gratis</button>
                                                    @else
                                                        <button class="btn btn-sm btn-primary">Premium</button>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    @if ($item->status == 'ACTIVE')
                                                        <button class="btn btn-sm btn-success">Active</button>
                                                    @else
                                                        <button class="btn btn-sm btn-danger">Nonactive</button>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex justify-content-center">

                                                        <a href="{{ route('member.show', $item->id) }}"
                                                            class="m-1 btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Detail data"><i
                                                                class="fa fa-address-card"></i></a>

                                                        {{-- @if ($item->enabled == 1)
                                                            <a href="{{ route('users.setActive', $item->id) }}"
                                                                class="m-1 ml-2 btn btn-sm btn-danger"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Disabled"><i class="fa fa-times"></i></a>
                                                        @else
                                                            <a href="{{ route('users.setActive', $item->id) }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Enabled" class="m-1 ml-2 btn btn-sm btn-success"><i
                                                                    class="fa fa-check"></i></a>
                                                        @endif --}}
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
