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
                                    <div class="card-title">Form edit Ruangan</div>
                                </div>
								<div class="card-body">
                                <form action="{{ route('sarpras.ruang.update', ['room' => $room->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="name">Nama Ruangan</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Rungan" value="{{ old('name', $room->name) }}">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-rounded">Update Ruangan</button>
                                        <a href="{{ route('sarpras.ruang.index') }}" class="btn btn-warning btn-rounded ml-2">Kembali</a>
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
@endsection