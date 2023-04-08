{{-- call header and footer --}}
@extends('layouts.main')
@section('title',  'Pengguna')

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
                                <h2 class="text-white pb-2 fw-bold">Siswa </h2>
                                <h5 class="text-white op-7 mb-2">List Siswa di kelas {{ strtoupper($classes->code)}}.</h5>
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
													<th>NIS</th>
													<th>NISN</th>
													<th>Nama</th>																										
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>No</th>
													<th>NIS</th>
													<th>NISN</th>
													<th>Nama</th>																										
												</tr>
											</tfoot>									
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
		var _token = "{{ csrf_token() }}";
		var title = 'Pengguna';
		var columns = [0, 1, 2, 3];
        $(document).ready(function() {
			table =  $('#basic-datatables').DataTable({
				processing: true,
				serverSide: true,
                responsive: true,
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
					url : '{!! route('akademik.classes.student.data',['classes' => $classes]) !!}',
					type : 'POST',
					data: {_token:_token},
				},
				columns: [
					{ data: 'id',
						render: function (data, type, row, meta) {
							return meta.row + meta.settings._iDisplayStart + 1;
						} 
					},
					{ data: 'nis' },
					{ data: 'nisn' },
					{ data: 'user.name' },								
				]
			});
			
		})
		// Switch Active
		function set_switch(id,isactive){
			$.ajax({
				type: 'POST',
				data: { 
					_token : _token,
					id: id,
					isactive: isactive,
				},
				url: '{!! route('master.users.student.switch') !!}',
				dataType: 'JSON',
				success: function (data) {
					if (data.status == 'success') {
						table.ajax.reload(null, false);
						Swal.fire(
							'Success!',
							data.message,
							'success',
						)
					} else {
						table.ajax.reload(null, false);
						Swal.fire(
							'Oops...',
							data.message,
							'error',
						)
					}
				},
				error: function (ajaxContext) {
					Swal.fire(
						'Oops...',
						'The action you have requested is not allowed.',
						'error',
					)
				}
			});
		}
		
		</script>
		@include('layouts.swal')
@endsection
