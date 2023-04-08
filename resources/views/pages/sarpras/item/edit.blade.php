{{-- call header and footer --}}
@extends('layouts.main')
@section('title',  'Edit berita')

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
                                    <div class="card-title">Form edit barang</div>
                                </div>
								<div class="card-body">
                                <form action="{{ route('sarpras.item.update', ['item' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="code">Kode</label>
                                        <input type="text" class="form-control" id="code" name="code" placeholder="Kode Barang" value="{{ old('code', $item->code) }}">
                                        @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nama Barang</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Barang" value="{{ old('name', $item->name) }}">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>  
                                    <div class="form-group">
                                        <label for="category">Kategori Barang</label>
                                        <select class="form-control" name="category" id="category" style="width: 100%" value="{{ old('category') }}">
                                            <option value="">- Pilih Kategori -</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category', $item->category->id) == $category->id ? "selected" : "" }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="unit">Satuan</label>
                                        <input type="text" class="form-control" id="unit" name="unit" placeholder="Nama Ruang" value="{{ old('unit', $item->unit) }}">
                                        @error('unit') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="amount">Jumlah</label>
                                        <input type="text" class="form-control" id="amount" name="amount" placeholder="Nama Ruang" value="{{ old('amount', $item->amount) }}">
                                        @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div> --}}
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-rounded">Edit Barang</button>
                                        <a href="{{ route('sarpras.item.index') }}" type="button" class="btn btn-warning btn-rounded ml-2">Kembali</a>
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
						{{ date("Y") }}, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://weboendercommunity.github.io/web/">Weboender Community</a>
					</div>				
				</div>
			</footer>
        </div>
    </div>
</body>

@endsection

@section('js')
    <script>
        $('input[name="amount"]').on('keyup focusin focusout ', function(event) {
            if (event.which >= 37 && event.which <= 40) return;
            $(this).val(function(index, value) {
                return value.replace(/\D/g, "");
            });
        });
    </script>
@endsection
