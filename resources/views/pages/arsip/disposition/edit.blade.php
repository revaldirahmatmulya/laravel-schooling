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
                                    <div class="card-title">Form Edit kategori Surat</div>
                                </div>
								<div class="card-body">
                                    <form action="{{ route('arsip.surat.in.disposisi.update', ['disposition' => $disposition->id]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label for="name">Nomor Surat</label>
                                            <input type="text" class="form-control" id="name" placeholder="Nomor Surat" value="{{ $disposition->number_mail }}" @disabled(true) >
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Perihal Surat</label>
                                            <input type="text" class="form-control" id="name" placeholder="Perihal Surat" value="{{ $disposition->mail_regarding }}" @disabled(true)>
                                        </div>
                                        <div class="form-group">
                                            <label for="disposisi">Disposisi Kepada</label>
                                            <input type="text" class="form-control" id="disposisi" name="disposisi" placeholder="Disposisi Kepada" value="{{ old('disposisi', $disposition->disposition->mail_destination) }}">
                                            @error('disposisi') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="sifat_disposisi">Sifat Disposisi</label>
                                            <select class="form-control" name="sifat_disposisi" id="sifat_disposisi" style="width: 100%">
                                                <option value="">- Pilih Tindakan -</option>
                                                <option value="1" {{ old('sifat_disposisi', $disposition->disposition->status) == '1' ? 'selected' : '' }}>Biasa</option>
                                                <option value="2" {{ old('sifat_disposisi', $disposition->disposition->status) == '2' ? 'selected' : '' }}>Segera</option>
                                                <option value="3" {{ old('sifat_disposisi', $disposition->disposition->status) == '3' ? 'selected' : '' }}>Sangat Segera</option>
                                            </select>
                                            @error('sifat_disposisi') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="isi_disposisi">Isi Disposisi</label>
                                            {{-- <input type="text" class="form-control" id="isi_disposisi" name="isi_disposisi" placeholder="Nomor kategori Surat" value="{{ old('isi_disposisi') }}"> --}}
                                            <textarea name="isi_disposisi" id="isi_disposisi" rows="5" class="form-control" placeholder="Isi Disposisi">{{ old('isi_disposisi', $disposition->disposition->description) }}</textarea>
                                            @error('isi_disposisi') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-rounded mt-2" type="submit">Edit Disposisi</button>
                                            <a href="{{ route('arsip.surat.in.index') }}" class="btn btn-warning btn-rounded ml-2 mt-2">Kembali</a>
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

