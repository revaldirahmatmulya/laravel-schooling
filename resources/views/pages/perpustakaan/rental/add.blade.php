{{-- call header and footer --}}
@extends('layouts.main')
@section('title', 'Tambah Data Peminjam Buku')

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
                                    <div class="card-title">Form Peminjam Buku</div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('perpustakaan.rental.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group col-12">
                                            <label for="author">Nama Buku</label>
                                            <select class="form-control" name="title" id="title" style="width: 100%"
                                                value="{{ old('title') }}">
                                                <option value="">- Pilih Buku -</option>
                                                @foreach ($books as $book)
                                                <option value="{{ $book->id }}"
                                                    {{ old('book') == $book->id ? "selected" : "" }}>
                                                    {{ $book->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="row">
                                                <label class="col" for="author">Nama Peminjam</label>
                                            </div>
                                            <div class="row mx-1">
                                                <select class="col form-control pl-2" name="student"
                                                    id="js-example-basic-multiple" value="{{ old('student') }}"
                                                    multiple="multiple">
                                                    @foreach ($students as $student)
                                                    <option value="{{ $student->id }}"
                                                        {{ old('student') == $student->id ? "selected" : "" }}>
                                                        {{ $student->user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('student') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status" style="width: 100%"
                                                value="{{ old('status') }}">
                                                <option value="">- Status Peminjaman -</option>
                                                <option value="ongoing">Ongoing</option>
                                            </select>
                                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="created_at">Dipinjam Pada</label>
                                            <input type="date" class="form-control" id="created_at" name="created_at"
                                                value="<?php echo date('Y-m-d'); ?>" disabled>
                                            <input type="date" class="form-control" id="created_at" name="created_at"
                                                value="<?php echo date('Y-m-d'); ?>" hidden>
                                            @error('created_at') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="return_date">Akan Dikembalikan Pada</label>
                                            <input type="date" class="form-control" id="return_date" name="return_date">
                                            @error('return_date') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="d-flex col-3 mb-4 justify-content-start">
                                            <button class="btn btn-primary btn-rounded">Tambah Data Peminjam</button>
                                            <a href="{{ route('perpustakaan.rental.index') }}" type="button"
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