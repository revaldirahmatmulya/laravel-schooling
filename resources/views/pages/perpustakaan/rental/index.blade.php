{{-- call header and footer --}}
@extends('layouts.main')
@section('title',  'Data Peminjam Buku')

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
                                <h2 class="text-white pb-2 fw-bold">Data Peminjam Buku</h2>
                                <h5 class="text-white op-7 mb-2">Kelola Data Peminjam Buku</h5>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
                                <a href="{{ route('perpustakaan.rental.add') }}" class="btn btn-secondary btn-round"><i
                                        class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Tambah Data Peminjam
                                    Buku</a>
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
                                        <table id="basic-datatables" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Judul Buku</th>
                                                    <th>Nama Peminjam</th>
                                                    <th>Status</th>
                                                    <th>Dipinjam Pada</th>
                                                    <th>Akan Dikembalikan Pada</th>
                                                    <th>Aksi</th>
                                                    <th>Kembali Pada</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Judul Buku</th>
                                                    <th>Nama Peminjam</th>
                                                    <th>Status</th>
                                                    <th>Dipinjam Pada</th>
                                                    <th>Akan Dikembalikan Pada</th>
                                                    <th>Aksi</th>
                                                    <th>Kembali Pada</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
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
                        {{ date("Y") }}, made with <i class="fa fa-heart heart text-danger"></i> by <a
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
		var table;
		var title = 'Data Peminjam';
		var columns = [0, 1, 2, 3, 4, 5, 7];
		$(document).ready( function () {
			var _token = "{{ csrf_token() }}";
			table =  $('#basic-datatables').DataTable({
			processing: true,
			serverSide: true,
			responsive: true,
			ordering: true,
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
					url : '{!! route('perpustakaan.rental.data') !!}',
					type : 'POST',
					data: {_token:_token},
				},
				columns: [
					{ data: 'id',
						render: function (data, type, row, meta) {
							return meta.row + meta.settings._iDisplayStart + 1;
						} 
					},
					{ data: 'book.title' },
					{ data: 'student.user.name' },
					{
						data: 'status',
						render: function(data, type, row){
							if(data == 'returned_late')
							{
								return '<span class="badge badge-danger">'+data+'</span>';
							}else if (data == 'ongoing'){
								return '<span class="badge badge-warning">'+data+'</span>';
							}else {
								return '<span class="badge badge-success">'+data+'</span>';
							}
						}
					},
					{ data: 'created_at' },
					{ 
						data: 'return_date', 
						render: function(data, type, row){
							if(Date.parse(data)-Date.parse(new Date())<0)
							{
								return '<span class="badge badge-danger">'+data+'</span>';
							}else{
								return '<span class="badge badge-success">'+data+'</span>';
							}
						}
					},
					{
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
							var url_edit = "{{ \Request::url() }}/edit"+"/"+data;
							var url_denda = "/perpustakaan/" +data+"/telat-pengembalian";
							var url_turned = "/perpustakaan/peminjam/" +data+"/dikembalikan";
							url_detail = "{{ \Request::url() }}" + "/" + data;
                            let renderData = '';
                            if (row['status'] == "ongoing") {
                                renderData += '\
								<a href="'+url_edit+'" class="btn btn-xs btn-warning my-1">Edit</a>\
								<button class="btn btn-xs btn-danger my-1" onclick="delete_data('+data+')">Hapus</button> <button class="btn btn-xs btn-success my-1" onclick="return_book('+data+')">dikembalikan</button>';
                            }
							if(row['status'] == "completed" || row['status'] == "returned_late"){
                            	renderData += '<a href="' + url_detail +
                                '" class="btn btn-xs btn-primary my-1">Detail</a>';
							}
                            return renderData;
                        }
                    },
					{
						data: 'returned_at',
						render: function(data, type, row){
							if(data == null)
							{
								return '<p>Buku masih dipinjam</p>';
							}else if(Date.parse(data)-Date.parse(row['return_date'])>0){
								return '<span class="badge badge-danger">'+data+'</span>';
							} else if((Date.parse(data)-Date.parse(row['return_date']))<0){
								return '<span class="badge badge-success">'+data+'</span>';
							}
						}
					},
				]
			});
		});
	</script>
	@include('layouts.swal')
@endsection
