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
                                    <div class="card-title">Form edit tamu</div>
                                </div>
								<div class="card-body">
                                <form action="{{ route('tamu.update', ['guestBook' => $guestBook->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="name">Nama Tamu</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Tamu" value="{{ old('name', $guestBook->name) }}">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email', $guestBook->email) }}">
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Telepon</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="telepon" value="{{ old('phone', $guestBook->phone) }}">
                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Tanggal</label>
                                        <input type="date" class="form-control" id="date" name="date" placeholder="telepon" value="{{ old('date', date('Y-m-d', strtotime($guestBook->date)) ) }}">
                                        @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="instance">Instansi</label>
                                        <input type="text" class="form-control" id="instance" name="instance" placeholder="Instansi" value="{{ old('instance', $guestBook->instance) }}">
                                        @error('instance') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="necessary">Keperluan</label>
                                        <textarea name="necessary" class="form-control" id="necessary" rows="4">{{ old('necessary', $guestBook->necessary) }}</textarea>
                                        @error('necessary') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-rounded">Edit Tamu</button>
                                        <a href="{{ route('tamu.index') }}" type="button" class="btn btn-warning btn-rounded ml-2">Kembali</a>
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
