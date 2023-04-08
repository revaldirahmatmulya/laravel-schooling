{{-- call header and footer --}}
@extends('layouts.main')
@section('title', 'Tambah kategori berita')

@section('content')

    <body>
        <div class="wrapper">
            {{-- call header --}}
            @include('layouts.header')
            {{-- call sidebar --}}
            @include('layouts.sidebar')

            <div class="main-panel">
                <div class="content">
                    <div class="panel-header bg-primary-gradient">
                        <div class="page-inner py-5">
                            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            </div>
                        </div>
                    </div>
                    <div class="page-inner mt--5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-info">
                                        <div class="card-title">Form Update Surat Masuk</div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('arsip.surat.in.update',['mailIn' => $mailIn]) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="title">Judul Surat</label>
                                                    <input type="text" class="form-control" id="title" name="title"
                                                        placeholder="Undangan rapat "
                                                        value="{{ old('title', $mailIn->title) }}">
                                                    @error('title')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <div class="row">                                                        
                                                        <div class="col">
                                                            <label style="font-weight: 600">Berkas Baru </label><br>
                                                            <p id="file-name" style="display: none;"></p>
                                                            <label class="image-label" for="image"><i
                                                                    class="fas fa-file-upload"></i><span>Cari
                                                                    File</span></label>
                                                            <input type="file" class="form-control-file" id="image"
                                                                name="file" onchange="previewImage()">
                                                            {{-- <div class="info">
                                                                <p>Max size : 1MB</p>
                                                            </div> --}}
                                                            @error('file')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col">
                                                            @if ($mailIn->file)
                                                            <label style="font-weight: 600">Berkas Lama</label><br>
                                                                <a href="{{ asset('storage/' . str_replace('public/','',$mailIn->file)) }}"
                                                                    target="_blank" class="text-primary"><i
                                                                        class="fa fa-download" aria-hidden="true"></i>
                                                                    Download</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="sender">Pengirim (asal surat)</label>
                                                    <input type="text" class="form-control" id="sender" name="sender"
                                                        placeholder="PT. Sumber Makmur"
                                                        value="{{ old('sender', $mailIn->sender) }}">
                                                    @error('sender')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="category">Kategori Surat</label>
                                                    <select class="form-control" name="category" id="category"
                                                        style="width: 100%">
                                                        <option value="">- Pilih Kategori Surat -</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ old('category', $mailIn->mail_category_id) == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="my-2">
                                                <button class="btn btn-primary btn-rounded mt-2" type="submit">Update Surat
                                                    Masuk</button>
                                                <a href="{{ route('arsip.surat.in.index') }}"
                                                    class="btn btn-warning btn-rounded ml-2 mt-2">Kembali</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">

                        <div class="copyright ml-auto">
                            {{ date('Y') }}, made with <i class="fa fa-heart heart text-danger"></i> by <a
                                href="https://weboendercommunity.github.io/web/">Weboender Community</a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </body>

@endsection

@section('js')
    <script>
        // thumbnail
        function previewImage() {
            const image = document.querySelector('#image');
            const namaberkas = document.querySelector('#nama-berkas');
            const imagePreview = document.querySelector('.img-preview');
            let filename = document.getElementById('file-name');
            filename.innerHTML = 'Nama Berkas : ' + image.files[0].name;
            filename.style.display = 'block';
            console.log(image.files[0].name);
            // const oFReader = new FileReader();
            // oFReader.readAsDataURL(image.files[0]);

            // oFReader.onload =function (oFREvent) {
            //     imagePreview.src = oFREvent.target.result;					
            // }
        }
    </script>
@endsection
