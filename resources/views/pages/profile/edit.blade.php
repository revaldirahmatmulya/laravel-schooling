{{-- call header and footer --}}
@extends('layouts.main')
@section('title', 'Edit pengguna')

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
                                        <div class="card-title">Form edit Pengguna</div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('profile.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="nama">Name</label>
                                                    <input type="text" class="form-control" id="nama" name="nama"
                                                        aria-describedby="nama"
                                                        value="{{ old('nama', auth()->user()->name) }}" readonly>
                                                    @error('nama')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        aria-describedby="email"
                                                        value="{{ old('email', auth()->user()->email) }}">
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="old_password">Password saat ini</label>
                                                    <input type="password" class="form-control" id="old_password"
                                                        name="old_password" aria-describedby="old_password"
                                                        value="{{ old('old_password') }}">
                                                    @error('old_password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="password">Password Baru</label>
                                                    <input type="password" class="form-control" id="password"
                                                        name="password" aria-describedby="password"
                                                        value="{{ old('password') }}">
                                                    @error('password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="password_confirmation">Konfirmasi Password</label>
                                                    <input type="password" class="form-control" id="password_confirmation"
                                                        name="password_confirmation"
                                                        aria-describedby="password_confirmation"
                                                        value="{{ old('password_confirmation') }}">
                                                    @error('password_confirmation')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <a type="button" href="{{ back()->getTargetUrl() }}"
                                                        class="btn btn-warning btn-rounded ml-2">Kembali</a>
                                                    <button type="submit" class="btn btn-primary btn-rounded ml-2 ">Update
                                                        Pengguna</button>
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
