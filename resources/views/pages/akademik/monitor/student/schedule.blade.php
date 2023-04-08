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
                                    <h2 class="text-white pb-2 fw-bold">Jadwal Pelajaran kelas <span class="text-warning">{{strtoupper($student->class->code)}}</span> </h2>
                                    <h5 class="text-white op-7 mb-2">Tampilan jadwal mingguan</h5>
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
                                                        <th>Hari</th>
                                                        <th>Jam</th>
                                                        <th>Mata Pelajaran</th>
                                                        <th>Pengajar</th>
                                                    </tr>
                                                </thead>
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
        var title = 'Nilai';
        var columns = [0, 1, 2, 3];
        $(document).ready(function() {
            table = $('#basic-datatables').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                paging: false,
                order: [[1, 'desc']],
                ajax: {
                    url: '{!! route('akademik.monitor.student.schedule.data') !!}',
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
                columns: [
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'day'
                    },                    
                    {
                        data: 'time'
                    },
                    {
                        data: 'subject.name'
                    },
                    {
                        data: 'teacher.user.name'
                    },
                ]
            });

        })
    </script>
    @include('layouts.swal')
@endsection
