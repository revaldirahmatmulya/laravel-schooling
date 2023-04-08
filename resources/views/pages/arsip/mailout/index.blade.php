{{-- call header and footer --}}
@extends('layouts.main')
@section('title', 'Kategori berita')

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
                                    <h2 class="text-white pb-2 fw-bold">Surat Keluar</h2>
                                </div>
                                <div class="ml-md-auto py-2 py-md-0">
                                    <a href="{{ route('arsip.surat.out.add') }}" class="btn btn-secondary btn-round"><i
                                            class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Tambah Surat Keluar</a>
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
                                                        <th>Judul Surat</th>
                                                        <th>Penerima Surat</th>
                                                        <th>Tanggal Surat</th>
                                                        <th>Lampiran</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Judul Surat</th>
                                                        <th>Penerima Surat</th>
                                                        <th>Tanggal Surat</th>
                                                        <th>Lampiran</th>
                                                        <th>Aksi</th>
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
                            {{ date('Y') }}, made with <i class="fa fa-heart heart text-danger"></i> by <a
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
        var title = 'Kategori Berita';
        var columns = [0, 1];
        $(document).ready(function() {
            var _token = "{{ csrf_token() }}";
            table = $('#basic-datatables').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,                
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],

                dom: 'Bflrtip',

                buttons: [{
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
                    url: '{!! route('arsip.surat.out.data') !!}',
                    type: 'POST',
                    data: {
                        _token: _token
                    },
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'title',
                    },
                    {
                        data: 'receiver',
                    },
                    {
                        data: 'date',
                        render: function(data, type, row, meta) {
                            moment.locale('id');
                            return moment(data).format('DD MMMM YYYY');
                        }
                    },
					{
						data: 'file',
						render: function(data, type, row, meta) {
							if (data) {								
								return '<a href="{{ asset('storage') }}/' + data.replace('public/','') + '" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download</a>';
							}else{
								return 'Tidak ada lampiran';
							}
						}
					},
					{
						data: 'id',
						render: function(data, type, row){
							var url_edit = "{{ \Request::url() }}/edit"+"/"+data;
							return '\
							<a href="'+url_edit+'" class="btn btn-xs btn-warning my-1">Edit</a>\
							<button class="btn btn-xs btn-danger my-1" onclick="delete_data('+data+')">Hapus</button>';
						}
					},
                ]
            });
        });
    </script>
    @include('layouts.swal')
@endsection
