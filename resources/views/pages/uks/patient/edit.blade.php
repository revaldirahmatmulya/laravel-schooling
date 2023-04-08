{{-- call header and footer --}}
@extends('layouts.main')
@section('title',  'Tambah berita')

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
						<div class="col-md-10   ">
							<div class="card">
                                <div class="card-header card-info">
                                    <div class="card-title">Form Edit data Pasien </div>
                                </div>
								<div class="card-body">
                                <form action="{{ route('uks.pasien.update', ['patient' => $patient->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Nama Pasien</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Pasien" value="{{ old('name', $patient->name) }}">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>  
                                    <div class="form-group">
                                        <label for="keterangan_pasien">Keterangan Pasien</label>
                                        <input type="text" class="form-control" id="keterangan_pasien" name="keterangan_pasien" placeholder="Keterangan Pasien" value="{{ old('keterangan_pasien', $patient->patient_description) }}">
                                        @error('keterangan_pasien') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div> 
                                    <div class="form-group">
                                        <label for="keluhan">Keluhan</label>
                                        <textarea name="keluhan" id="keluhan" class="form-control" cols="3" rows="3">{{ old('keluhan', $patient->complaint) }}</textarea>
                                        @error('keluhan') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>  
                                    <div class="form-group">
                                        <label for="penanganan">Penanganan</label>
                                        <textarea name="penanganan" id="penanganan" class="form-control" cols="3" rows="3">{{ old('penanganan', $patient->handling) }}</textarea>
                                        @error('penanganan') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>  
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-10">
                                                @php
                                                    $old_obat = (old('obat') !== null) ? collect(old('obat')) : null;
                                                    // var_dump($old_obat);
                                                @endphp
                                                <label for="obat">Obat </label>
                                                <div class="">
                                                    <div class="row obat">
                                                        @php
                                                            $no = 1 ;
                                                        @endphp
                                                        @if ($old_obat == null)
                                                            @foreach ($patient->medicines as $medic)
                                                                @if ($no == 1)
                                                                    <div class="col-md-12">
                                                                        <select class="form-control mb-2" name="obat[]" style="width: 100%" value="">
                                                                            <option value="">- Pilih Obat -</option>
                                                                            @foreach ($medicines as $medicine)
                                                                                <option value="{{ $medicine->id }}" {{ $medic->medicine_id == $medicine->id ? 'selected' : '' }}>{{ $medicine->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                @else
                                                                    <div class="col-md-10 obat{{ $no }}"> 
                                                                        <select class="form-control mb-2" name="obat[]" style="width: 100%" value=""> 
                                                                            <option value="">- Pilih Obat -</option> 
                                                                            @foreach ($medicines as $medicine) 
                                                                            <option value="{{ $medicine->id }}" {{ $medic->medicine_id == $medicine->id ? 'selected' : '' }}>{{ $medicine->name }}</option>
                                                                            @endforeach 
                                                                        </select> 
                                                                    </div> 
                                                                    <div class="col-md-1 obat{{ $no }}"> 
                                                                        <button type="button" class="btn btn-danger" onclick="hapus('obat{{ $no }}')"><i class="fas fa-trash"></i>
                                                                        </button> 
                                                                    </div>
                                                                @endif
                                                                @php
                                                                    $no++;
                                                                @endphp
                                                            @endforeach
                                                        @else
                                                            
                                                            @foreach ($old_obat as $obat)
                                                                @if ($no == 1)
                                                                    <div class="col-md-12">
                                                                        <select class="form-control mb-2" name="obat[]" id="obat1" style="width: 100%" value="">
                                                                            <option value="">- Pilih Obat -</option>
                                                                            @foreach ($medicines as $medicine)
                                                                                <option value="{{ $medicine->id }}" {{ $obat == $medicine->id ? 'selected' : '' }}>{{ $medicine->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                @else
                                                                    <div class="col-md-10 obat1"> 
                                                                        <select class="form-control mb-2" name="obat[]" style="width: 100%" value=""> 
                                                                            <option value="">- Pilih Obat -</option> 
                                                                            @foreach ($medicines as $medicine) 
                                                                            <option value="{{ $medicine->id }}" {{ $obat == $medicine->id ? 'selected' : '' }}>{{ $medicine->name }}</option>
                                                                            @endforeach 
                                                                        </select> 
                                                                    </div> 
                                                                    <div class="col-md-1  obat1"> 
                                                                        <button type="button" class="btn btn-danger" onClick="hapus()"><i class="fas fa-trash"></i>
                                                                        </button> 
                                                                    </div>
                                                                @endif
                                                                @php
                                                                    $no++;
                                                                @endphp
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                @error('obat[]') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="col-md-2" style="margin-top: 30px;">
                                                <label for=""></label>
                                                <button type="button" id="tambah" class="btn btn-primary">Tambah</button>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="mt-3 float-right">
                                        <a href="{{ route('uks.pasien.index') }}" type="button" class="btn btn-warning btn-rounded ml-2">Kembali</a>
                                        <button class="btn btn-primary btn-rounded">Edit Pasien</button>
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
    var old = {{ $old_obat != null ? count($old_obat) :  $no  }}
    $('#tambah').on('click', function(event) {
        $('.obat').append('<div class="col-md-10 obat'+old+'"> <select class="form-control mb-2" name="obat[]" id="obat'+old+'" style="width: 100%" value=""> <option value="">- Pilih Obat -</option> @foreach ($medicines as $medicine) <option value="{{ $medicine->id }}">{{ $medicine->name }}</option> @endforeach </select> </div> <div class="col-md-1 obat'+old+'"> <button type="button" class="btn btn-danger"  onClick="hapus(\'obat'+old+'\')"><i class="fas fa-trash"></i></button> </div>');
        console.log('add');
        old++;
    });

    function hapus(id) {
        console.log("#"+id+"");   // The function returns the product of p1 and p2
        // $('.obat').remove("."+id+"");
        $("."+id+"").remove();
    }

</script>
@endsection
