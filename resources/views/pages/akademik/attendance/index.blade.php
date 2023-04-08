{{-- call header and footer --}}
@extends('layouts.main')
@section('title', 'Nilai')

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
                                    <h2 class="text-white pb-2 fw-bold">Presensi</h2>
                                    <h5 class="text-white op-7 mb-2">
                                        Presensi mapel {{ $dailyJournal->subject->name }} Kelas
                                        {{ strtoupper($dailyJournal->class->code) }} Tanggal
                                        {{ $dailyJournal->created_at->format('d M Y') }}
                                    </h5>
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
                                            <form
                                                action="{{ route('akademik.journal.attendance.add', ['dailyJournal' => $dailyJournal]) }}"
                                                method="post">
                                                @csrf
                                                <table id="basic-datatables"
                                                    class="display table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>NIS</th>
                                                            <th>Nama Siswa</th>
                                                            <th>Kehadiran</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                                <div class="row">
                                                    <div class="col mt-2 mb-2">
                                                        <a href="{{ route('akademik.journal.index', ['dailyJournal' => $dailyJournal]) }}"
                                                            class="btn btn-warning mr-2 ml-3">Kembali</a>
                                                        <button type="submit" class="btn btn-primary">Apply</button>
                                                    </div>
                                                </div>
                                            </form>
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
        var title = 'Nilai';
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
                paging: false,
                bInfo: false,
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
                    url: '{!! route('akademik.journal.attendance.data', ['dailyJournal' => $dailyJournal]) !!}',
                    type: 'POST',
                    data: {
                        _token: _token
                    },
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
                        data: 'student.nis'
                    },
                    {
                        data: 'student.user.name'
                    },
                    {
                        data: 'present',
                        render: function(data, type, row) {
                            console.log(data);
                            return ' <input type="checkbox" class="form-check-input ml-3"' + (data ?
                                    "checked" : "") + ' id="presents" name="presents[]" value="' +
                                row['student_id'] + '">';
                        }
                    }
                ]
            });

        })
    </script>
    @include('layouts.swal')
@endsection
