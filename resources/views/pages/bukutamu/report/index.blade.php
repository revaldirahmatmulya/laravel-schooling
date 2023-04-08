{{-- call header and footer --}}
@extends('layouts.main')
@section('title',  'Berita')

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
                                <h2 class="text-white pb-2 fw-bold">Buku Tamu</h2>
                                <h5 class="text-white op-7 mb-2"></h5>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
								<div class="d-flex">
									<div class="form-group" style="width: 300px">
										<label for="start" class="text-white">Tanggal Mulai</label>
										<input type="date" class="form-control" id="start" name="start" placeholder="">
										@error('date') <span class="text-danger">{{ $message }}</span> @enderror
									</div>
									<div class="form-group" style="width: 300px">
										<label for="end" class="text-white">Tanggal Selesai</label>
										<input type="date" class="form-control" id="end" name="end" placeholder="">
										@error('date') <span class="text-danger">{{ $message }}</span> @enderror
									</div>	
									<div class="ml-3" style="margin-top: 40px;">
										<button class="btn btn-primary btn-round filter">Filter</button>
										<button class="btn btn-danger btn-round reset">Reset</button>
										<button class="btn btn-success btn-round export">Export Excel</button>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Telepon</th>
                                                    <th>Instansi</th>
                                                    <th>Keperluan</th>
                                                    <th>Tanggal</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>No</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Telepon</th>
                                                    <th>Instansi</th>
                                                    <th>Keperluan</th>
                                                    <th>Tanggal</th>
												</tr>
											</tfoot>
											<tbody>
												{{-- <tr>
													<td>1</td>
													<td>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</td>
													<td><img class="img-product" src="{{ asset('assets/img/examples/product8.jpg') }}" alt=""></td>
													<td>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Pariatur amet voluptas excepturi veniam corporis deserunt quos nostrum non rem esse, dolore laudantium assumenda nisi cupiditate! Dolorem velit commodi fugiat quae.</td>
													<td>12-12-2022</td>
													<td>
														<a href="{{ route('master.news.edit') }}" class="btn btn-warning btn-sm m-1"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
														<button type="button" id="delete1" class="btn btn-danger btn-sm m-1"><i class="fas fa-trash mr-1"></i> Hapus</button>
													</td>
												</tr> --}}
												
											</tbody>
										</table>
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
	var table;
	var title = 'Berita';
	var columns = [0, 2, 3, 4];
	$(document).ready( function () {
		var _token = "{{ csrf_token() }}";
		table =  $('#basic-datatables').DataTable({
			processing: true,
			serverSide: true,
			responsive: true,
			ordering: false,
			searching: false,
			"lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"]],

			dom: 'Bflrtip',

			buttons: [
				{
					extend: 'print',
					titleAttr: 'Print',
					exportOptions: {
						columns: columns
					},
					title: title,
					footer: true,
				},
				{
					extend: 'excel',
					titleAttr: 'Excel',
					exportOptions: {
						columns: columns
					},
					title: title,
					footer: true,
				},
				{
					extend: 'pdf',
					titleAttr: 'Pdf',
					exportOptions: {
						columns: columns
					},
					title: title,
					footer: true,
				},
				{
					extend: 'csv',
					titleAttr: 'Csv',
					exportOptions: {
						columns: columns
					},
					title: title,
					footer: true,
				},
				{
					extend: 'copy',
					titleAttr: 'Copy',
					exportOptions: {
						columns: columns
					},
					title: title,
					footer: true,
				},
			],
			ajax: {
				url : '{!! route('tamu.laporan.data') !!}',
				type : 'POST',
				contentType: "application/json",
				data: function ( d ) {
					return JSON.stringify( { 
						_token : _token,
						start : $('#start').val(),
						end : $('#end').val(),
					});
				},
			},
			columns: [
				{ data: 'id',
					render: function (data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					} 
				},
				{ data: 'name' },
				{ data: 'email' },
				{ data: 'phone' },
				{ data: 'instance' },
				{ data: 'necessary' },
				{ data: 'tanggal' },
				
			]
		});

		$('#start').on('change', function(){
			table.ajax.reload();
		});
		$('#end').on('change', function(){
			table.ajax.reload();
		});


		// $('.filter').on('click', function(){
		// 	table.ajax.reload();
		// });
		$('.reset').on('click', function(){
			$('#start').val('');
			$('#end').val('');
			table.ajax.reload();
		});
		$('.export').on('click', function(){
			
			var ajaxurl = '{{ \Request::url() }}/export';
			var start = $('#start').val() == '' ? null : $('#start').val();
			var end = $('#end').val() == '' ? null : $('#end').val();
			// window.location.href = ajaxurl+"/"+start+"/"+end;
			window.open(ajaxurl+"/"+start+"/"+end, '_blank');
		});

	});
</script>
@include('layouts.swal')
@endsection
