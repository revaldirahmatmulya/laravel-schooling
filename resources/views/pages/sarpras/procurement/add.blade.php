{{-- call header and footer --}}
@extends('layouts.main')
@section('title', 'Tambah berita')

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
                                        <div class="card-title">Form ajukan pengadaan</div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('sarpras.procurement.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="item">Pilih Barang</label>
                                                    <select class="col form-control pl-2" name="item"
                                                        id="item">
                                                        <option value="">- Pilih Barang -</option>
                                                        @foreach ($items as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->code . ' - ' . $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('item')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>                                                                                              
                                                <div class="form-group col-md-12">
                                                    <label for="supplier">Nama Supplier</label>                                                   
                                                    <select class="col form-control pl-2" name="supplier"
                                                        id="supplier">
                                                        <option value="">- Pilih Supplier -</option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}">
                                                                {{ $supplier->code . ' - ' . $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('supplier')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="amount">Jumlah Barang</label>
                                                    <input type="number" class="form-control" min="0"
                                                        id="amount" name="amount" placeholder="Jumlah Barang"
                                                        value="{{ old('amount') }}">
                                                    @error('amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>                                               
                                                <div class="form-group col-md-6">
                                                    <label for="price">Harga Barang / Unit</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rp. </span>
                                                        </div>
                                                        <input type="number" min="0" step="100"
                                                            class="form-control" id="price" name="price"
                                                            placeholder="Harga Barang" value="{{ old('price') }}">
                                                    </div>
                                                    @error('price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="total_price">Total Harga</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rp. </span>
                                                        </div>
                                                        <input type="number" min="0" step="100" readonly
                                                            class="form-control" id="total_price" name="total_price"
                                                            value="{{ old('total_price') }}">
                                                    </div>
                                                    @error('total_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="description">Deskripsi</label>
                                                    <textarea name="description" id="description" class="form-control" rows="5"
                                                        placeholder="Deskripsi Barang / Alasan">{{ old('description') }}</textarea>
                                                    @error('description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-rounded">Ajukan pengadaan</button>
                                                <a href="{{ route('sarpras.procurement.index') }}" type="button"
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

@section('js')

    <script>
        $(document).ready(function() {
            $('#item').select2({
                allowClear: true,
                theme: 'bootstrap4',
            });
            $('#supplier').select2({
                allowClear: true,
                theme: 'bootstrap4',
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#price').change(function() {
                var price = $('#price').val();
                var amount = $('#amount').val();
                var total_price = price * amount;
                $('#total_price').val(total_price);
            });
            $('#amount').change(function() {
                var price = $('#price').val();
                var amount = $('#amount').val();
                var total_price = price * amount;
                $('#total_price').val(total_price);
            });
        });
    </script>
@endsection
