@extends('layouts.backoffice')
@section('title', 'New technology')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create New</h1>
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
                                    <a href="{{ route('technology.index') }}" class="btn btn-secondary btn-sm m-1"> <i
                                            class="fa fa-arrow-left"></i>
                                        Back</a>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('technology.store') }}" enctype="multipart/form-data">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    @csrf
                                    <div class="row">
                                        <div class="col-1">
                                            <div class="form-group">
                                                <label>Sequence </label>
                                                <input type="text" name="sequence"
                                                    value="{{ old('sequence') ?? $sequence }}"
                                                    class="text-center form-control @error('sequence') is-invalid @enderror">

                                            </div>
                                        </div>
                                        <div class="col-11">

                                            <div class="form-group">
                                                <label>Name </label>
                                                <input type="text" name="name" value="{{ old('name') }}"
                                                    class="form-control @error('name') is-invalid @enderror">
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label>Description </label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3"></textarea>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-3 text-center rounded">
                                            <img class="col-9 text-center image-preview rounded"
                                                src="/assets/img/no-image.jpg" alt="" srcset="">
                                        </div>
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Logo</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="image"
                                                            class="custom-file-input input-img" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Chose
                                                            file</label>
                                                    </div>
                                                </div>
                                                @error('image')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
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
