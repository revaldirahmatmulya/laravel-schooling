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
                                    <div class="card-title">Form edit Petugas</div>
                                </div>
								<div class="card-body">
                                <form action="{{ route('uks.petugas.update', ['uksOfficer' => $uksOfficer->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="petugas">Nama</label>
                                        <select class="form-control" name="petugas" id="petugas" style="width: 100%" value="{{ old('petugas') }}">
                                            <option value="">- Pilih Petugas -</option>
                                            @foreach ($students as $student)
                                                <option value="{{ $student->id }}" {{ old('petugas', $uksOfficer->student_id) == $student->id ? 'selected' : '' }}>{{ $student->user->name }} - {{ ucwords($student->class->code)  }}</option>
                                            @endforeach
                                        </select>
                                        @error('petugas') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>  
                                    <div class="form-group">
                                        <label for="hari">Hari</label>
                                        <select class="form-control" name="hari" id="hari" style="width: 100%" value="{{ old('hari') }}">
                                            <option value="">- Pilih Hari Bertugas -</option>
                                            <option value="senin" {{ old('hari', strtolower($uksOfficer->day)) == 'senin' ? 'selected' : '' }}>Senin</option>
                                            <option value="selasa" {{ old('hari', strtolower($uksOfficer->day)) == 'selasa' ? 'selected' : '' }}>Selasa</option>
                                            <option value="rabu" {{ old('hari', strtolower($uksOfficer->day)) == 'rabu' ? 'selected' : '' }}>Rabu</option>
                                            <option value="kamis" {{ old('hari', strtolower($uksOfficer->day)) == 'kamis' ? 'selected' : '' }}>Kamis</option>
                                            <option value="jumat" {{ old('hari', strtolower($uksOfficer->day)) == 'jumat' ? 'selected' : '' }}>Jum'at</option>
                                            <option value="sabtu" {{ old('hari', strtolower($uksOfficer->day)) == 'sabtu' ? 'selected' : '' }}>Sabtu</option>
                                        </select>
                                        @error('hari') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Jam Tugas</label>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label for="jumat">Mulai</label>
                                                <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" placeholder="contoh: 08:00 s/d 11:30" value="{{ old('jam_mulai', date('H:s', strtotime($uksOfficer->time_start))) }}">
                                                @error('jam_mulai') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="jumat">Selesai</label>
                                                <input type="time" class="form-control" name="jam_selesai" id="jam_selesai" placeholder="contoh: 08:00 s/d 11:30" value="{{ old('jam_selesai', date('H:s', strtotime($uksOfficer->time_end))) }}">
                                                @error('jam_selesai') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-rounded">Edit Petugas</button>
                                        <a href="{{ route('uks.petugas.index') }}" type="button" class="btn btn-warning btn-rounded ml-2">Kembali</a>
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
