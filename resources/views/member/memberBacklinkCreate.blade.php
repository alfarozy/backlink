@extends('layouts.member')
@section('title', 'Tambah backlink saya')
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
                                    <a href="{{ route('dashboard.member.listbacklink') }}"
                                        class="btn btn-secondary btn-sm m-1"> <i class="fa fa-arrow-left"></i>
                                        Kembali</a>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('dashboard.member.backlink.store', request()->id) }}"
                                enctype="multipart/form-data">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    @csrf
                                    <div class="form-group">
                                        <label>URL Website anda </label>
                                        <input type="url" name="website" value="{{ old('website') }}"
                                            class="form-control @error('website') is-invalid @enderror">
                                        @error('website')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>Keywords</label>
                                            <input type="text" name="keywords" value="{{ old('keywords') }}"
                                                class="tags form-control @error('keywords') is-invalid @enderror">
                                            @error('keywords')
                                                <small class="text-danger">{{ $message }}</small>
                                            @else
                                                <small class="text-muted">Gunakan koma (,) untuk memisahkan keywords. Maksimal
                                                    3 keywords</small>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Tipe artikel </label>
                                            <select required class="form-control type" name="type" id="">
                                                <option value="1">Artikel Sendiri</option>
                                                <option value="0">Artikel dari admin</option>
                                            </select>

                                            @error('type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Judul artikel</label>
                                        <input type="text" name="title" value="{{ old('title') }}"
                                            class="title form-control @error('title') is-invalid @enderror">
                                        @error('title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Konten</label>
                                        <textarea type="text" name="content" maxlength="100"
                                            class="editor form-control @error('content') is-invalid @enderror"> {{ old('content') }}</textarea>
                                        @error('content')
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
        $('.tags').tagsinput({
            maxTags: 3
        });
        $('.type').on('change', function() {

            if ($(this).val() == 0) {

                $('.title').attr('disabled', 'disabled');
                $('.title').val('');
                $('.editor').attr('disabled', 'disabled');
                $('.editor').val('');
            } else {
                $('.editor').removeAttr('disabled');
                $('.title').removeAttr('disabled');
            }
        });
    </script>
    <script src="/assets/js/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('.editor'), {

                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold', 'italic', 'bulletedList', 'numberedList', 'link',
                        '|',
                        'blockQuote',
                        'insertTable',
                        'imageInsert',
                        '|',
                        'code',
                        'codeBlock'
                    ]
                },
                language: 'id',
                licenseKey: '',
            })
            .then(editor => {
                window.editor = editor;




            })
            .catch(error => {
                console.error('Oops, something went wrong!');
                console.error(
                    'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:'
                );
                console.warn('Build id: hosofu6grpb-m75gatu85ah8');
                console.error(error);
            });
    </script>
@endsection
