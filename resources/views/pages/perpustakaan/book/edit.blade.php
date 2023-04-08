{{-- call header and footer --}}
@extends('layouts.main')
@section('title', 'Edit Data Buku')

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
                            <div>
                                <h2 class="text-white pb-2 fw-bold"></h2>
                                <h5 class="text-white op-7 mb-2"></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header card-info">
                                    <div class="card-title">Form Edit Buku</div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('perpustakaan.book.update', ['book' => $books->id]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label for="title">Kode</label>
                                            <input type="text" class="form-control" id="code" name="code"
                                                placeholder="Masukkan kode buku"
                                                value="{{ old('code', $books->code) }}">
                                            @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Judul Buku</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Masukkan judul buku"
                                                value="{{ old('title', $books->title) }}">
                                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Lokasi Buku</label>
                                            <input type="text" class="form-control" id="location" name="location"
                                                placeholder="Masukkan lokasi buku"
                                                value="{{ old('location', $books->location) }}">
                                            @error('location') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Stok Buku</label>
                                            <input type="number" class="form-control" id="stock" name="stock"
                                                placeholder="Masukkan stok buku"
                                                value="{{ old('stock', $books->stock) }}">
                                            @error('stock') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col" for="author">Nama Penulis</label>
                                            </div>
                                            <div class="row mx-1">
                                                <select class="form-control" name="author" style="width: 100%"
                                                    value="{{ old('author') }}" id="js-example-basic-multiple"
                                                    multiple="multiple">
                                                    @foreach ($authors as $author)
                                                    <option value="{{ $author->id }}"
                                                        {{ old('author', $books->author_id) == $author->id ? "selected" : "" }}>
                                                        {{ $author->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('author') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="teacher">Kategori Buku</label>
                                            <select class="form-control" name="category" id="category"
                                                style="width: 100%" value="{{ old('category') }}">
                                                <option value="">- Category Buku -</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category', $books->category_id) == $category->id ? "selected" : "" }}>
                                                    {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="d-flex col-3 mb-4 justify-content-start">
                                            <button class="btn btn-primary btn-rounded">Edit Buku</button>
                                            <a href="{{ route('perpustakaan.book.index') }}" type="button"
                                                class="btn btn-warning btn-rounded ml-2">Kembali</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">

            <div class="copyright ml-auto">
                {{ date("Y") }}, made with <i class="fa fa-heart heart text-danger"></i> by <a
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
        $(document).ready(function() {
            $('#js-example-basic-multiple').select2({                
                allowClear: true,
                theme: 'bootstrap4',
            });
        });
    </script>
@endsection