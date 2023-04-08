{{-- call header and footer --}}
@extends('layouts.main')
@section('title',  'Edit kategori berita')

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
                                    <div class="card-title">Form Edit barang Keluar</div>
                                </div>
								<div class="card-body">
                                    <form action="{{ route('sarpras.item.out.update', ['itemOut' => $itemOut->id]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label for="item">Pilih Barang</label>
                                            <select class="form-control" name="item" id="item" style="width: 100%" value="{{ old('item') }}" disabled>
                                                <option value="">- Pilih Barang -</option>
                                                @foreach ($items as $item)
                                                    <option value="{{ $item->id }}" {{ old('item', $itemOut->item_id) == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('item') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-row mx-2">
                                            <div class="form-group col-md-6">
                                                <label for="amount">Jumlah Barang</label>
                                                <input type="text" class="form-control" id="amount" name="amount" placeholder="Jumlah Barang" value="{{ old('amount', $itemOut->amount) }}">
                                                @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="date_out">Tanggal Keluar</label>
                                                <input type="date" class="form-control" id="date_out" name="date_out" placeholder="Tanggal Keluar" value="{{ old('date_out', date('Y-m-d', strtotime($itemOut->date) ) ) }}">
                                                @error('date_out') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Keterangan</label>
                                            <textarea type="text" class="form-control" id="description" rows="3" name="description" placeholder="Jumlah Barang">{{ old('description', $itemOut->description) }}</textarea>
                                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <button class="btn btn-primary btn-rounded mt-2" type="submit">Edit barang Masuk </button>
                                        <a href="{{ route('sarpras.item.in.index') }}" class="btn btn-warning btn-rounded ml-2 mt-2">Kembali</a>
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

