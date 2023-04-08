{{-- call header and footer --}}
@extends('layouts.main')
@section('title', 'Detail Transaksi')

@section('content')

<body>
    {{-- {{ dd($fine ) }} --}}
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
                                    <div class="card-title">Detail Transaksi Peminjaman</div>
                                </div>
                                <div class="card-body pl-4">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Judul Buku</label>
                                            <p style="color: slategrey">{{ $rental->book->title }}</p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nis">Nama Peminjam</label>
                                            <p style="color: slategrey">
                                                {{ $rental->student->user->name }}</p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nis">Status</label>
                                            <p
                                                class="fw-bold {{ $rental->status == 'completed' ? 'text-success' : 'text-danger' }} ">
                                                {{ strtoupper($rental->status) }}</p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nis">Keterangan</label>
                                            <p style="color: slategrey">
                                                {{ $fine->description }}</p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nis">Dipinjam Pada</label>
                                            <p style="color: slategrey">{{ $rental->created_at->format('Y-m-d') }}</p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nis">Tanggal Pengembalian</label>
                                            <p style="color: slategrey">
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $rental['return_date'])->format('Y-m-d'); }}
                                            </p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nis">Tanggal Dikembalikan</label>
                                            <p style="color: slategrey">
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $rental['returned_at'])->format('Y-m-d'); }}
                                            </p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nis">Jumlah Denda</label>
                                            <div>
                                                <div style="color: slategrey">
                                                    <span>Rp. </span>
                                                    <span>{{ $fine->fine }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2 float-right">
                                            <a type="button" href="{{ route('perpustakaan.rental.index') }}"
                                                class="btn btn-warning btn-rounded ml-2">Kembali</a>
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
                            {{ date('Y') }}, made with <i class="fa fa-heart heart text-danger"></i> by <a
                                href="https://weboendercommunity.github.io/web/">Weboender Community</a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
</body>

@endsection
