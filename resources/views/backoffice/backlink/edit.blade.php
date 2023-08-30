@extends('layouts.backoffice')
@section('title', 'Edit data')
@section('style')
    <style>
        .ck-content {
            height: 575px
        }

        .img-preview {
            object-fit: cover;
            object-position: center;
            height: 200px;
            width: 100%
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit data</h1>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title mt-2">@yield('title')</h3>
                                    <a href="{{ route('backlink.index') }}" class="btn btn-secondary btn-sm m-1"> <i
                                            class="fa fa-arrow-left"></i>
                                        Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('backlink.update', $data->id) }}">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label>Nama website </label>
                                        <input required type="text" name="title"
                                            value="{{ old('title') ?? $data->title }}"
                                            class="form-control @error('title') is-invalid @enderror">
                                        @error('title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>URL website </label>
                                            <input required type="url" name="url"
                                                value="{{ old('url') ?? $data->url }}"
                                                class="form-control @error('url') is-invalid @enderror">
                                            @error('url')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Domain Rating </label>
                                            <input required type="text" name="domain_rating"
                                                value="{{ old('domain_rating') ?? $data->domain_rating }}"
                                                class="form-control @error('domain_rating') is-invalid @enderror">
                                            @error('domain_rating')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Kategori </label>
                                            <select required class="form-control" name="category_id" id="">
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $data->category_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('category_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Type </label>
                                            <select required class="form-control" name="type" id="">
                                                <option value="NOFOLLOW" {{ $data->type == 'NOFOLLOW' ? 'selected' : '' }}>
                                                    NOFOLLOW
                                                </option>
                                                <option value="DOFOLLOW" {{ $data->type == 'DOFOLLOW' ? 'selected' : '' }}>
                                                    DOFOLLOW</option>
                                            </select>

                                            @error('type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label>Keterangan (opsional) </label>
                                        <textarea name="description" class="form-control " rows="3">{{ old('description') ?? $data->description }}</textarea>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary col-2">Simpan</button>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
