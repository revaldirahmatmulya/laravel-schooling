{{-- call header and footer --}}
@extends('layouts.main')
@section('title', 'Tugas')

@section('content')

    <body>
        <div class="wrapper">
            {{-- call header --}}
            @include('layouts.header')
            {{-- call sidebar --}}
            @include('layouts.sidebar')\
            <div class="main-panel">
                <div class="content">
                    <div class="panel-header bg-primary-gradient">
                        <div class="page-inner py-5">
                            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                                <div>
                                    <h2 class="text-white pb-2 fw-bold">Tugas</h2>
                                    <h5 class="text-white op-7 mb-2">Tugas dari jurnal {{ $dailyJournal->title }}</h5>
                                </div>
                                <div class="ml-md-auto py-2 py-md-0">
                                    <a href="{{ route('akademik.journal.task.add', ['dailyJournal' => $dailyJournal]) }}"
                                        class="btn btn-secondary btn-round"><i class="fa fa-plus-circle mr-2"
                                            aria-hidden="true"></i>Tambah Tugas</a>
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
                                                        <th>Nama Tugas</th>
                                                        <th>Nama Kelas</th>
                                                        <th>Nama Mapel</th>
                                                        <th>Tugas Dibuat</th>
                                                        <th>Deadline tugas</th>
                                                        <th>Aksi</th>
                                                        <th>Penilaian</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Tugas</th>
                                                        <th>Nama Kelas</th>
                                                        <th>Nama Mapel</th>
                                                        <th>Tugas Dibuat</th>
                                                        <th>Deadline tugas</th>
                                                        <th>Aksi</th>
                                                        <th>Penilaian</th>
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
        var _token = "{{ csrf_token() }}";
        var title = 'Pengguna';
        var columns = [0, 1, 2, 3];
        $(document).ready(function() {
            table = $('#basic-datatables').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                dom: 'Bflrtip',
                order: [
                    [4, 'desc']
                ],
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
                    url: '{!! route('akademik.journal.task.data', ['dailyJournal' => $dailyJournal]) !!}',
                    type: 'POST',
                    data: {
                        _token: _token
                    },
                    // success: function(data) {
                    // 	console.log(data);
                    // },
                    error: function(xhr, error, thrown) {
                        console.log(xhr);
                        console.log(error);
                        console.log(thrown);
                    }
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
                        data: 'daily_journal.class.code',
                        render: function(data, type, row) {
                            return data.toUpperCase();
                        }
                    },
                    {
                        data: 'daily_journal.subject.name'
                    },
                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                return moment(data).format('DD MMMM YYYY');
                            } else {
                                return moment(data).format('YYYY-MM-DD');
                            }
                        }
                    },
                    {
                        data: 'deadline',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                return moment(data).format('DD MMMM YYYY');
                            } else {
                                return moment(data).format('YYYY-MM-DD');
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            var url_edit = "{{ \Request::url() }}/edit" + "/" + data;
                            return '\
            							<a href="' + url_edit + '" class="btn btn-xs btn-warning my-1">Edit</a>\
            							<button class="btn btn-xs btn-danger my-1" id="delete" onclick="delete_data(' + data +
                                ')">Delete</button>';
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            var url_nilai = "{{ \Request::url() }}/" + data + "/nilai";
                            return '<a href="' + url_nilai +
                                '" class="btn btn-xs btn-primary my-1">Beri Nilai</a>';
                        }
                    }
                ]
            });

        })
    </script>
    @include('layouts.swal')
@endsection
