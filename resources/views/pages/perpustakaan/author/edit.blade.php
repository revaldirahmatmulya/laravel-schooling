{{-- call header and footer --}}
@extends('layouts.main')
@section('title', 'Edit penulis buku')

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
                                        <div class="card-title">Form Edit penulis buku</div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('perpustakaan.author.update', ['author' => $Author->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <label for="name">Nama Penulis</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Nama kategori buku"
                                                    value="{{ old('author', $Author->name) }}">
                                                @error('author')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="location">Lokasi Penulis</label>
                                                <input type="text" class="form-control" id="location" name="location"
                                                    placeholder="Lokasi Penulis"
                                                    value="{{ old('author', $Author->location) }}">
                                                @error('author')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-rounded mt-2" type="submit">Edit Penulis
                                                </button>
                                                <a href="{{ route('perpustakaan.author.index') }}"
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
