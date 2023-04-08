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
                                    <h2 class="text-white pb-2 fw-bold">Surat Masuk</h2>
                                </div>
                                <div class="ml-md-auto py-2 py-md-0">
                                    <a href="{{ route('arsip.surat.in.add') }}" class="btn btn-secondary btn-round"><i
                                            class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Tambah Surat Masuk</a>
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
                                                        <th>Pengirim</th>
                                                        <th>Status Disposisi</th>
                                                        <th>Tanggal Surat</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Judul Surat</th>
                                                        <th>Pengirim</th>
                                                        <th>Status Disposisi</th>
                                                        <th>Tanggal Surat</th>
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
                ordering: false,
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
                    url: '{!! route('arsip.surat.in.data') !!}',
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
                        data: 'sender',
                    },
                    {
                        data: 'is_disposed',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return '<strong><span class="text-primary">Sudah Didisposisikan</span></strong>';
                            } else {
                                return '<strong><span>Belum Didisposisikan</span></strong>';
                            }
                        }
                    },
                    {
                        data: 'created_at',
                        render: function(data, type, row, meta) {
                            moment.locale('id');
                            return moment(data).format('DD MMMM YYYY');
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            var url_edit = "{{ \Request::url() }}/edit" + "/" + data;

                            var html = '';

                            var htmlModalBody = '';

                            if (!row['is_disposed']) {
                                var url_disposisi = "{{ \Request::url() }}/" + data +
                                    "/disposisi/add";
                                html += '<a href="' + url_disposisi +
                                    '" class="btn btn-xs btn-primary my-1">Disposisikan</a>';
                            } else {
                                html +=
                                    '<button type="button" class="btn btn-xs btn-info my-1" data-toggle="modal" data-target="#exampleModal' +
                                    data + '">Lihat Disposisi</button>';
                                                                    
                                html += '<div class="modal fade" id="exampleModal' + data + '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">\
            								<div class="modal-dialog modal-lg">\
            									<div class="modal-content">\
            									<div class="modal-header">\
            										<h5 class="modal-title" id="exampleModalLabel">Detail Disposisi</h5>\
            										<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
            										<span aria-hidden="true">&times;</span>\
            										</button>\
            									</div>\
                                                <div class="modal-body">\
            										<div class="mx-2">\
            											<label><strong><b>Judul Surat</b></strong></label>\
                                                        <p>' + row.title + '</p>\
                                                        <label><strong><b>Pengirim Surat</b></strong></label>\
                                                        <p>' + row.sender + '</p>\
                                                        <label><strong><b>Tujuan Disposisi</b></strong></label>\
                                                        <p>' + row.disposition.destination + '</p>\
                                                        <label><strong><b>Pesan Disposisi</b></strong></label>\
                                                        <p>' + row.disposition.message + '</p>';
                                                        if (row.file) {
                                                            html += '<label><strong><b>Berkas</b></strong></label>\
            											    <br>\
            											    <a href="{!! url('storage/') !!}/' + row.file.replace('public/', '') + '" target="_blank" ><button class="btn btn-primary">File Berkas</button></a>';
                                                        }                                                        
            											html += '<hr>\
                                                        </div>\
                                                        </div>\
                                                        <div class="modal-footer">\
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>\
                                                            </div>\
                                                            </div>\
                                                            </div>\
                                                            </div>';
                            }
                            html += '<a href="' + url_edit + '" class="btn btn-xs btn-warning ml-1 my-1">Edit</a>\
                							<button class="btn btn-xs btn-danger my-1" id="delete" onclick="delete_data(' + data +
                                ')">Delete</button>';

                            return html;
                        }
                    },
                ]
            });
        });
    </script>
    @include('layouts.swal')
@endsection
