{{-- call header and footer --}}
@extends('layouts.main')
@section('title', 'Daily Journal')

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
                                    <h2 class="text-white pb-2 fw-bold">Jurnal Harian </h2>
                                    <h5 class="text-white op-7 mb-2">Kelola Jurnal Harian Guru.</h5>
                                </div>
                                <div class="ml-md-auto py-2 py-md-0">
                                    <div class="d-flex">
                                        <div class="form-group" style="width: 300px">
                                            <label for="start" class="text-white">Kelas</label>
                                            <select class="form-control" id="classes" name="classes">
                                                <option value="">Pilih Kelas</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}">{{ strtoupper($class->code) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('class')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="ml-3" style="margin-top: 40px;">
                                            <button class="btn btn-primary btn-round filter">Filter</button>
                                            <button class="btn btn-danger btn-round reset mx-2">Reset</button>
                                            <a href="{{ route('akademik.journal.add') }}"
                                                class="btn btn-secondary btn-round"><i class="fa fa-plus-circle mr-2"
                                                    aria-hidden="true"></i>Tambah Jurnal</a>
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
                                                        <th>Judul Jurnal</th>
                                                        <th>Mapel</th>
                                                        <th>Kelas</th>
                                                        <th>Tanggal</th>
                                                        <th>Aksi</th>
                                                        <th>Penilaian</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Judul Jurnal</th>
                                                        <th>Mapel</th>
                                                        <th>Kelas</th>
                                                        <th>Tanggal</th>
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
        var title = 'Daily Journal';
        var columns = [0, 1, 2, 3];
        $(document).ready(function() {
            table = $('#basic-datatables').DataTable({
                order: [
                    [4, 'desc']
                ],
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
                    url: '{!! route('akademik.journal.data') !!}',
                    type: 'POST',
                    contentType: "application/json",
                    data: function(d) {
                        return JSON.stringify({
                            _token: _token,
                            class: $('#classes').val(),
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
                        data: 'subject.name'
                    },
                    {
                        data: 'class.code',
                        render: function(data, type, row) {
                            return data.toUpperCase();
                        }
                    },
                    {
                        data: 'date',
                        render: function(data, type, row) {
                            let date = moment(data, 'YYYY-MM-DD');
                            console.log(date.toDate());
                            if (type == 'display' || type == 'filter') {
                                return moment(date).format('DD MMMM YYYY');
                            } else {
                                return moment(date).format('YYYY-MM-DD');

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
                            var url_tugas = "{{ \Request::url() }}" + "/" + data + "/tugas";
                            var url_presensi = "{{ \Request::url() }}" + "/" + data + "/presensi";
                            return '\
                							<a href="' + url_tugas + '" class="btn btn-xs btn-primary my-1">Tugas</a>\
                							<a href="' + url_presensi + '" class="btn btn-xs btn-success my-1">Presensi</a>';
                        }
                    },
                ]
            });

            $('.filter').on('click', function() {
                table.ajax.reload();
            });
            $('.reset').on('click', function() {
                $('#classes').val('').trigger('change');
                table.ajax.reload();
            });   
        });
    </script>
    @include('layouts.swal')
@endsection
