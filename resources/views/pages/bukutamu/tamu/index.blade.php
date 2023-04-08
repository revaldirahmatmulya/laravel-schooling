{{-- call header and footer --}}
@extends('layouts.main')
@section('title', 'Berita')

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
                                    <a href="{{ route('tamu.add') }}" class="btn btn-secondary btn-round"><i
                                            class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Tambah Tamu</a>
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
                                                        <th>Nama</th>
                                                        <th>Telepon</th>
                                                        <th>Instansi</th>
                                                        <th>Tanggal</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Telepon</th>
                                                        <th>Instansi</th>
                                                        <th>Tanggal</th>
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
        var title = 'Berita';
        var columns = [0, 2, 3, 4];
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
                    url: '{!! route('tamu.data') !!}',
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
                        data: 'name'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'instance'
                    },
                    {
                        data: 'date',
						render: function(data, type, row) {
							moment.locale('id');
							return moment(data).format('DD MMMM YYYY');
						}
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            var num = meta.row + meta.settings._iDisplayStart + 1;
                            var url_edit = "{{ \Request::url() }}/edit/" + data;
                            return '\
    						<button type="button" class="btn btn-xs btn-primary my-1" data-toggle="modal" data-target="#exampleModal' + num + '">Detail</button>\
    						<a href="' + url_edit + '" class="btn btn-xs btn-warning my-1">Edit</a>\
    						<button class="btn btn-xs btn-danger my-1" onclick="delete_data(' + data + ')">Hapus</button>\
    						<!-- Modal -->\
    						<div class="modal fade" id="exampleModal' + num + '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">\
    							<div class="modal-dialog modal-lg">\
    								<div class="modal-content">\
    								<div class="modal-header">\
    									<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>\
    									<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
    									<span aria-hidden="true">&times;</span>\
    									</button>\
    								</div>\
    								<div class="modal-body">\
    									<div class="mx-2">\
    										<label><strong><b>Nama</b></strong></label>\
    										<p>' + row.name + '</p>\
    										<hr>\
    										<label><strong><b>Email</b></strong></label>\
    										<p>' + row.email + '</p>\
    										<hr>\
    										<label><strong><b>Telephone</b></strong></label>\
    										<p>' + row.phone + '</p>\
    										<hr>\
    										<label><strong><b>Tanggal</b></strong></label>\
    										<p>' + row.tanggal + '</p>\
    										<hr>\
    										<label><strong><b>Instansi</b></strong></label>\
    										<p>' + row.instance + '</p>\
    										<hr>\
    										<label><strong><b>Keperluan</b></strong></label>\
    										<p>' + row.necessary + '</p>\
    										<hr>\
    									</div>\
    								</div>\
    								<div class="modal-footer">\
    									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>\
    								</div>\
    								</div>\
    							</div>\
    						</div>';
                        }
                    },
                ]
            });
        });
    </script>
    @include('layouts.swal')
@endsection
