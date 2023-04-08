{{-- call header and footer --}}
@extends('layouts.main')
@section('title', 'Edit Denda')

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
                                    <div class="card-title">Form Update Denda</div>
                                    <div class="card-subtitle mt-1">Denda Peminjaman Buku
                                        {{ $rentals->book->title }} dari {{$rentals->student->user->name}} </div>
                                </div>
                                <div class="card-body">
                                    <form
                                        action="{{ route('perpustakaan.fine.update', [ 'fine' => $fine, 'rental' => $rentals->id]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group col-md-6">
                                            <label for="item_price">Harga Denda</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp. </span>
                                                </div>
                                                <input type="number" class="form-control" id="fine" name="fine"
                                                    placeholder="Masukkan nilai denda"
                                                    value="{{ old('fine', $fine->fine) }}">
                                                @error('fine')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="title">Deskripsi Denda</label>
                                            <input type="text" class="form-control" id="description" name="description"
                                                placeholder="Masukkan Deskripsi"
                                                value="{{ old('description', $fine->description) }}">
                                            @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                </div>
                                <div class="d-flex col-3 mb-4 justify-content-start">
                                    <button class="btn btn-primary btn-rounded">Update Denda</button>
                                    <a href="{{ route('perpustakaan.fine.index', ['rental' => $rentals->id]) }}"
                                        type="button" class="btn btn-warning btn-rounded ml-2">Kembali</a>
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
