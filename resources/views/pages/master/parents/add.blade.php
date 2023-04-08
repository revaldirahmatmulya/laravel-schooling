{{-- call header and footer --}}
@extends('layouts.main')
@section('title', 'Tambah pengguna')

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
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-header card-info">
                                        <div class="card-title">Form Tambah Orang Tua Siswa</div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('master.users.parents.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="name">Nama</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        aria-describedby="name" placeholder="Nama"
                                                        value="{{ old('name') }}">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        aria-describedby="email" placeholder="Email"
                                                        value="{{ old('email') }}">
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="phone">Telepon</label>
                                                    <input type="text" class="form-control" id="phone" name="phone"
                                                        placeholder="Telepon" value="{{ old('phone') }}">
                                                    @error('phone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="row">
                                                        <label class="col" for="students[]">Nama Anak</label>
                                                    </div>
                                                    <div class="row mx-1">
                                                        <select class="col form-control pl-2" name="students[]" id="js-example-basic-multiple"
                                                            multiple="multiple">
                                                            @foreach ($students as $student)
                                                                <option value="{{$student->id}}">{{ $student->user->name }}</option>
                                                            @endforeach                                                            
                                                        </select>
                                                    </div>
                                                    @error('students')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="address">Alamat</label>
                                                    <textarea name="address" id="address" class="form-control" rows="5">{{ old('address') }}</textarea>
                                                    @error('address')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="mt-2 float-right">
                                                <a type="button" href="{{ route('master.users.parents.index') }}"
                                                    class="btn btn-warning btn-rounded ml-2">Kembali</a>
                                                <button type="submit" class="btn btn-primary btn-rounded ml-2">Tambah
                                                    Orang Tua Siswa</button>
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
        $(document).ready(function() {
            $('#js-example-basic-multiple').select2({                
                allowClear: true,
                theme: 'bootstrap4',
            });
        });
    </script>
@endsection
