@extends('layouts.member')
@section('title', 'Tambah backlink saya')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah data baru</h1>
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
                                    <a href="{{ route('dashboard.member.submit.backlink') }}"
                                        class="btn btn-secondary btn-sm m-1"> <i class="fa fa-arrow-left"></i>
                                        Kembali</a>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('dashboard.member.backlink.store') }}"
                                enctype="multipart/form-data">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    @csrf
                                    <div class="form-group">
                                        <label>Backlink </label>
                                        <select name="backlink_id" class="form-control select2bs4" style="width:100%"
                                            id="">

                                            @foreach ($data as $item)
                                                <option value="{{ $item->id }}">{{ $item->domain() }}</option>
                                            @endforeach
                                        </select>
                                        @error('backlink_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Url </label>
                                        <input type="url" name="url" value="{{ old('url') }}"
                                            class="form-control @error('url') is-invalid @enderror">
                                        @error('url')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success col-md-3 mx-2">Submit</button>
                                </div>
                            </form>
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

@section('script')
    <script>
        $('.input-img').change(function() {
            const file = this.files[0];
            if (file && file.name.match(/\.(jpg|jpeg|png|svg)$/)) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('.image-preview').attr('src', event.target.result)
                }
                reader.readAsDataURL(file);
            } else {
                alert('please upload image file');
            }
        });
        $('.custom-file-input').on('change', function() {
            let filename = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(filename)
        });
    </script>
@endsection
