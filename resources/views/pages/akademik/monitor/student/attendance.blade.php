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
                                    <h2 class="text-white pb-2 fw-bold">Presensi untuk siswa <span
                                            class="text-warning">{{ $student->user->name }}</span></h2>
                                    <h5 class="text-white op-7 mb-2">Status kehadiran siswa di setiap mapel</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner mt--5">
                        <div class="row row-card-no-pd">
                            <div class="col-sm-6 col-md-6">
                                <div class="card card-stats card-round">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-check text-success"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Jumlah Hadir</p>
                                                    <h4 class="card-title">{{ $present }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="card card-stats card-round">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-error text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Jumlah Absen</p>
                                                    <h4 class="card-title">{{ $absent }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Presensi</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="basic-datatables" class="display table table-striped table-hover"
                                                style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Mata Pelajaran</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <canvas id="attendance-pie-chart" width="300" height="300"></canvas>
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
    @endsection
    @section('js')
        <script>
            const present = {{ $present }};
            const absent = {{ $absent }};

            const labels = [
                'Tidak Hadir',
                'Hadir',
            ];

            const data = {
                labels: labels,
                datasets: [{
                    label: 'My First dataset',
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)'
                    ],
                    data: [absent, present],
                }]
            };

            const config = {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            };

            const myChart = new Chart(
                document.getElementById('attendance-pie-chart'),
                config
            );
        </script>

        <script>
            var _token = "{{ csrf_token() }}";
            $(document).ready(function() {
                $('#basic-datatables').DataTable({
                    processing: true,
                    serverSide: true,
                    order: [
                        [2, 'desc']
                    ],
                    ajax: {
                        url: '{!!  route('akademik.monitor.student.attendance.data') !!}',
                        type: 'POST',
                        data: {
                            _token: _token
                        },                       
                    },
                    columns: [
                        {
                            data: 'id',
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'daily_journal.subject.name',
                        },
                        {
                            data: 'daily_journal.date',
                        },
                        {
                            data: 'present',
                            render: function(data, type, row) {
                                if (data == 1) {
                                    return '<span class="badge badge-success">Hadir</span>';
                                } else {
                                    return '<span class="badge badge-danger">Tidak Hadir</span>';
                                }
                            }
                        }
                    ]
                });
            });
        </script>
    @endsection
