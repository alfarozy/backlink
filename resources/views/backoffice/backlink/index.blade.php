@extends('layouts.backoffice')
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
                                    <div class="col-sm-6 col-lg-6  text-right ">
                                        <button type="button" class="btn btn-success btn-sm m-1" data-toggle="modal"
                                            data-target="#tambahData"> <i class="fa fa-plus"></i>
                                            Tambah data</button>
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
                                <table id="datatable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="30%">Website</th>
                                            <th width="15%" class="text-center">Harga</th>
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
                                                <td class="align-middle text-center">
                                                    <span>{{ currencyIDR($item->price) }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span>{{ $item->category->name }}</span>
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $item->domain_rating }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    @if ($item->type == 'NOFOLLOW')
                                                        <button class="btn btn-sm btn-danger">{{ $item->type }} </button>
                                                    @else
                                                        <button class="btn btn-sm btn-success">{{ $item->type }}</button>
                                                    @endif
                                                </td>


                                                <td class="align-middle">
                                                    <div class="d-flex justify-content-center">

                                                        <a href="{{ $item->url }}" target="_BLANK"
                                                            class="m-1 btn btn-sm btn-primary" data-toggle="tooltip"
                                                            data-placement="top" title="Kunjungi Webiste"><i
                                                                class="fa fa-link"></i></a>
                                                        <a href="{{ route('backlink.edit', $item->id) }}"
                                                            class="m-1 btn btn-sm btn-secondary" data-toggle="tooltip"
                                                            data-placement="top" title="Update item"><i
                                                                class="fa fa-edit"></i></a>

                                                        <form class="d-inline"
                                                            action="{{ route('backlink.destroy', $item->id) }}"
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


    <!-- Modal -->
    <div class="modal fade" id="tambahData" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="tambahDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="tambahDataLabel">Tambah data backlink</h4>
                    <button type="button" class="btn btn-sm btn-danger px-2" data-dismiss="modal" aria-label="Close"> <i
                            class="fa fa-times"></i></button>
                </div>
                <form method="POST" action="{{ route('backlink.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama website </label>
                            <input required type="text" name="title" value="{{ old('title') }}"
                                class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>URL website </label>
                                <input required type="url" name="url" value="{{ old('url') }}"
                                    class="form-control @error('url') is-invalid @enderror">
                                @error('url')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Domain Rating </label>
                                <input required type="text" name="domain_rating" value="{{ old('domain_rating') }}"
                                    class="form-control @error('domain_rating') is-invalid @enderror">
                                @error('domain_rating')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-4">
                                <label>Kategori </label>
                                <select required class="form-control category" name="category_id" id="">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-4">
                                <label>Type </label>
                                <select required class="form-control" name="type" id="">
                                    <option value="NOFOLLOW">NOFOLLOW</option>
                                    <option value="DOFOLLOW">DOFOLLOW</option>
                                </select>

                                @error('type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-4">
                                <label>Harga </label>
                                <input disabled type="text" name="price" value="{{ old('price') }}"
                                    class="price form-control @error('price') is-invalid @enderror">
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group">
                            <label>Keterangan (opsional) </label>
                            <textarea name="description" class="editor form-control " rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
