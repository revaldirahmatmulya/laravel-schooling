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
                                    <h2 class="text-white pb-2 fw-bold">Todo</h2>
                                    <h5 class="text-white op-7 mb-2">Tugas dari Siswa {{ $student->user->name }}</h5>
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
                                                        <th>Nama Mapel</th>
                                                        <th>Tugas Dibuat</th>
                                                        <th>Deadline tugas</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Tugas</th>
                                                        <th>Nama Mapel</th>
                                                        <th>Tugas Dibuat</th>
                                                        <th>Deadline tugas</th>
                                                        <th>Status</th>
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
                    [4, 'asc']
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
                    url: '{!! route('akademik.monitor.student.todo.data') !!}',
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
                        data: 'task.name'
                    },
                    {
                        data: 'task.daily_journal.subject.name'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'deadline',
                        render: function(data, type, row, meta) {
                            var today = new Date();
                            var dmy = data.split("-");
                            var deadline = new Date(dmy[2], dmy[1] - 1, dmy[0]);
                            if (today > deadline && row.status == 0) {
                                return '<span class="text-danger fw-bold">' + data + '</span>';
                            } else {
                                return '<span class="">' + data + '</span>';
                            }
                        }
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            if (data == 0) {
                                return '<span class="badge badge-danger">Belum Dikerjakan</span>';
                            } else {
                                return '<span class="badge badge-success">Sudah Dikerjakan</span>';
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {                            
                            return '<button type="button" class="btn btn-xs btn-primary my-1" data-toggle="modal" data-target="#exampleModal' +
                                data + '">Detail Tugas</button>\
                                    <!-- Modal -->\
    							<div class="modal fade" id="exampleModal' + data + '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">\
    								<div class="modal-dialog modal-lg">\
    									<div class="modal-content">\
    									<div class="modal-header">\
    										<h5 class="modal-title" id="exampleModalLabel">Detail Tugas '+row.task.name+'</h5>\
    										<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
    										<span aria-hidden="true">&times;</span>\
    										</button>\
    									</div>\
    									<div class="modal-body">\
    										<div class="mx-2">\
    											<label><strong><b>Nama tugas</b></strong></label>\
    											<p>' + row.task.name + '</p>\
    											<hr>\
    											<label><strong><b>Deskripsi tugas</b></strong></label>\
    											<p>' + row.task.description + '</p>\
    											<hr>\
    											<label><strong><b>Tanggal tugas dibuat</b></strong></label>\
    											<p>' + row.created_at + '</p>\
    											<hr>\
    											<label><strong><b>Tanggal deadline tugas</b></strong></label>\
    											<p>' + row.deadline + '</p>\
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
                    }
                ]
            });
        })
    </script>   
    @include('layouts.swal')
@endsection
