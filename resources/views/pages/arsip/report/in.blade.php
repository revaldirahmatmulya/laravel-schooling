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
                                    <h2 class="text-white pb-2 fw-bold">Laporan Surat Masuk</h2>
                                </div>
                                <div class="ml-md-auto py-2 py-md-0">
                                    <div class="d-flex">
                                        <div class="form-group" style="width: 300px">
                                            <label for="start" class="text-white">Tanggal Mulai</label>
                                            <input type="date" class="form-control" id="start" name="start"
                                                placeholder="">
                                            @error('date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group" style="width: 300px">
                                            <label for="end" class="text-white">Tanggal Selesai</label>
                                            <input type="date" class="form-control" id="end" name="end"
                                                placeholder="">
                                            @error('date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="ml-3" style="margin-top: 40px;">
                                            <button class="btn btn-primary btn-round filter">Filter</button>
                                            <button class="btn btn-danger btn-round reset">Reset</button>                                            
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
                                            <table id="basic-datatables" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Judul Surat</th>
                                                        <th>Jenis Surat</th>
                                                        <th>Pengirim Surat</th>
                                                        <th>Lampiran</th>
                                                        <th>Tanggal Diterima</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>No. Surat</th>
                                                        <th>Jenis Surat</th>
                                                        <th>Pengirim Surat</th>
                                                        <th>Lampiran</th>
                                                        <th>Tanggal Diterima</th>
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
                // serverSide: true,
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
                    url: '{!! route('arsip.report.in.data') !!}',
                    type: 'POST',
                    contentType: "application/json",
                    data: function(d) {
                        return JSON.stringify({
                            _token: _token,
                            start: $('#start').val(),
                            end: $('#end').val(),
                        });
                    },							
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'category.name'
                    },
                    {
                        data: 'sender'
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
                        data: 'created_at',
                        render: function(data, type, row, meta) {
                            moment.locale('id');
                            return moment(data).format('DD MMMM YYYY');
                        }
                    }
                ]
            });
            $('.filter').on('click', function() {
                table.ajax.reload();
            });
            $('.reset').on('click', function() {
                $('#start').val('');
                $('#end').val('');
                table.ajax.reload();
            });          
        });
    </script>
    @include('layouts.swal')
@endsection
