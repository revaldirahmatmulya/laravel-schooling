@extends('layouts.main')

@section('content')

    <body>
        <div class="wrapper">
            @include('layouts.header')

            @include('layouts.sidebar')

            <div class="main-panel">
                <div class="content">
                    <div class="panel-header bg-primary-gradient">
                        <div class="page-inner py-5">
                            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                                <div>
                                    <h2 class="text-white pb-2 fw-bold">Rekap Presensi Kelas
                                        <span class="text-warning">{{ strtoupper( implode(', ', $teacherClass) ) }} </span>
                                    </h2>
                                    <h5 class="text-white op-7 mb-2">Status kehadiran siswa di setiap mapel</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner mt--5">
                        @foreach ($classes as $class)
                            <div class="row row-card-no-pd">
                                <h2 class="fw-bold ml-4">{{ strtoupper($class->code) }}</h2>
                                <div class="table-responsive">
                                    <table id="basic-datatables-{{ $class->id }}"
                                        class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIM</th>
                                                <th>Nama Siswa</th>
                                                <th>Jumlah Hadir</th>
                                                <th>Jumlah Absen</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>NIM</th>
                                                <th>Nama Siswa</th>
                                                <th>Jumlah Hadir</th>
                                                <th>Jumlah Absen</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
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
    @endsection
    @section('js')
        <script>
            var table;
            var _token = "{{ csrf_token() }}";
            var title = 'Pengguna';
            var columns = [0, 1, 2, 3];
            var classes = {!! json_encode($classes->toArray()) !!};
            classes.forEach(element => {
                let url_students = "{{ \Request::url() }}/data" + "/" + element.code;
                table = $(`#basic-datatables-${element.id}`).DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    lengthChange: false,
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
                        url: url_students,
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
                            data: 'nis'
                        },
                        {
                            data: 'user.name'
                        },
                        {
                            data: 'attend',
                            render: function(data){
                                return '<span class="fw-bold text-primary">'+data+'</span>'
                            }
                        },
                        {
                            data: 'absent',
                            render: function(data){
                                return '<span class="fw-bold text-danger">'+data+'</span>'
                            }
                        },
                        {
                            data: 'id',
                            render: function(data, type, row) {
                                var url_detail = "{{ \Request::url() }}/detail" + "/" +
                                    data;
                                return '<a href="' + url_detail +
                                    '" class="btn btn-xs btn-primary my-1">Details</a>';
                            }
                        },
                    ]
                });
            });
        </script>
        @include('layouts.swal')
    @endsection
