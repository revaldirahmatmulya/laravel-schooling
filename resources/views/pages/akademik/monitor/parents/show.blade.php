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
                            <div class="col-md-8 ">
                                <div class="card">
                                    <div class="card-header card-info">
                                        <div class="card-title">Detail Siswa</div>
                                    </div>
                                    <div class="card-body pl-4">
                                        <form action="#" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="nis">NIS</label>
                                                    <p style="color: slategrey">{{$student->nis}}</p>                                                    
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="nisn">NISN</label>
                                                    <p style="color: slategrey">{{$student->nisn}}</p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="name">Nama</label>
                                                    <p style="color: slategrey">{{$student->user->name}}</p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email">Email</label>
                                                    <p style="color: slategrey">{{$student->user->email}}</p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="class">Kelas</label>
                                                    <p style="color: slategrey">{{ strtoupper($student->class->code)}}</p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="gender">Jenis Kelamin</label>
                                                    <p style="color: slategrey">{{ $student->gender}}</p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="birthplace">Tempat Lahir</label>
                                                    <p style="color: slategrey">{{ $student->birthplace}}</p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="birthdate">Tanggal Lahir</label>
                                                    <p style="color: slategrey">{{ $student->birthdate}}</p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="religion">Agama</label>
                                                    <p style="color: slategrey">{{ $student->religion}}</p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="phone">Telepon</label>
                                                    <p style="color: slategrey">{{ $student->birthplace}}</p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="generation">Angkatan</label>
                                                    <p style="color: slategrey">{{ $student->generation}}</p>
                                                </div>                                                
                                                <div class="form-group col-md-12">
                                                    <label for="address">Alamat</label>
                                                    <p style="color: slategrey">{{ $student->address}}</p>
                                                </div>
                                            </div>
                                            <div class="mt-2 float-right">
                                                <a type="button" href="{{ route('akademik.monitor.parents.index') }}"
                                                    class="btn btn-warning btn-rounded ml-2">Kembali</a>
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
