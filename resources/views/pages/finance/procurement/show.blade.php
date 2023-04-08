{{-- call header and footer --}}
@extends('layouts.main')
@section('title', 'Detail Pengadaan')

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
                                        <div class="card-title">Detail Pengadaan</div>
                                    </div>
                                    <div class="card-body pl-4">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="nis">Nama Barang</label>
                                                <p style="color: slategrey">{{ $procurement->item->name }}</p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nis">Jumlah Barang</label>
                                                <p style="color: slategrey">
                                                    {{ $procurement->item_amount . ' ' . $procurement->item->unit }}</p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nis">Harga Barang / Unit</label>
                                                <p style="color: slategrey">
                                                    {{ 'Rp. ' . number_format($procurement->price, 2, ',', '.') }}</p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nis">Total Harga</label>
                                                <p style="color: slategrey">
                                                    {{ 'Rp. ' . number_format($procurement->total_price, 2, ',', '.') }}</p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nis">Kategori</label>
                                                <p style="color: slategrey">{{ $procurement->item->category->name }}</p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nis">Pemasok</label>
                                                <p style="color: slategrey">{{ $procurement->supplier->name }}</p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nis">Status</label>
                                                @if ($procurement->status == 'pending')
                                                    <p class="fw-bold text-uppercase text-warning">Menunggu Persetujuan</p>                                                    
                                                @elseif ($procurement->status == 'approved')
                                                    <p class="fw-bold text-uppercase text-success">Disetujui</p>
                                                @elseif ($procurement->status == 'rejected')
                                                    <p class="fw-bold text-uppercase text-danger">Ditolak</p>
                                                @elseif ($procurement->status == 'completed')
                                                    <p class="fw-bold text-uppercase text-primary">Selesai</p>
                                                @else
                                                    <p class="fw-bold text-uppercase text-danger">Error</p>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="nis">Deskripsi Pengajuan</label>
                                                <p style="color: slategrey">
                                                    {{ $procurement->description ? $procurement->description : 'Tidak ada deskripsi' }}
                                                </p>
                                            </div>
                                            @if ($procurement->status == 'rejected')
                                                <div class="form-group col-md-12">
                                                    <label for="nis">Alasan Penolakan</label>
                                                    <p style="color: slategrey">
                                                        {{ $procurement->reason }}
                                                    </p>
                                                </div>
                                            @endif
                                            @if ($procurement->receipt)
                                                <div class="form-group col-md-12">
                                                    <label for="nota">Nota</label>
                                                    <p>
                                                        <a
                                                            href="{{ asset('storage/procurement/receipt/' . explode('/', $procurement->receipt)[3]) }}">File
                                                            Nota</a>
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="mt-2 float-right">
                                            <a type="button" href="{{ route('finance.procurement.index') }}"
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
