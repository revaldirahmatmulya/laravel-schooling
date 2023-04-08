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
                                    <h2 class="text-white pb-2 fw-bold">Pengajuan Sarana dan Prasarana</h2>
                                    <h5 class="text-white op-7 mb-2"></h5>
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
                                                        <th width='5%'>No</th>
                                                        <th>Nama Barang</th>
                                                        <th>Jumlah</th>
                                                        <th>Unit</th>
                                                        <th>Harga/Unit</th>
                                                        <th>Harga Total</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                        <th width='10%'>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Barang</th>
                                                        <th>Jumlah</th>
                                                        <th>Unit</th>
                                                        <th>Harga/Unit</th>
                                                        <th>Harga Total</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </tfoot>
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
                    url: '{!! route('finance.procurement.data') !!}',
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
                        data: 'item.name'
                    },
                    {
                        data: 'amount'
                    },
                    {
                        data: 'item.unit'
                    },
                    {
                        data: 'price',
                        render: function(data) {
                            return Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }).format(data);
                        }
                    },
                    {
                        data: 'total_price',
                        render: function(data) {
                            return Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }).format(data);
                        }
                    },
                    {
                        data: 'tanggal'
                    },
                    {
                        data: 'status',
                        render: function(data) {
                            if (data == "pending") {
                                return '<span class="badge badge-warning">Pending</span>';
                            } else if (data == "approved") {
                                return '<span class="badge badge-success">Approved</span>';
                            } else if (data == "rejected") {
                                return '<span class="badge badge-danger">Rejected</span>';
                            } else if (data == "completed") {
                                return '<span class="badge badge-primary">Completed</span>';
                            }
                        }
                    },
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            let renderData = '';
                            var url_reject = "{{ \Request::url() }}/reject" + "/" + data;
                            var url_detail = "{{ \Request::url() }}" + "/" + data;
                            if (row['status'] == "pending") {
                                renderData += '\
                                    <a href="' + url_detail +'" class="btn btn-xs btn-primary my-1">Detail</a>\
                                    <a href="' + url_reject + '" class="btn btn-xs btn-danger my-1">Tolak</a>\
                                    <button class="btn btn-xs btn-success my-1" onclick="approve(' + data +
                                    ')">Setujui</button>';
                                return renderData;
                            }else if (row['status'] == "approved"){                                
                                renderData += '<a href="' + url_detail +
                                    '" class="btn btn-xs btn-primary my-1">Detail</a>\
                                    <button class="btn btn-xs btn-warning my-1" onclick="resetStatus(' + data +
                                    ')">Reset Satus</button>';
                                return renderData;
                            }else{                                
                                renderData += '<a href="' + url_detail +
                                    '" class="btn btn-xs btn-primary my-1">Detail</a>';
                                return renderData;
                            }
                        }
                    },
                ]
            });
        });
    </script>
    <script>
        function approve(id) {
            var url = "{{ \Request::url() }}" + "/approve";
            var _token = "{{ csrf_token() }}";

            Swal.fire({
                title: 'Apakah kamu yakin menyetujuinya?',
                text: "Pengajuan ini akan disetujui!",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Setujui!',
                cancelButtonText: 'Batal',
                allowOutsideClick: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url + "/" + id,
                        type: 'POST',
                        data: {
                            _token: _token
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: data.message,
                                    icon: 'success',
                                    allowOutsideClick: false,
                                    confirmButtonText: 'OK'
                                })
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    data.message,
                                    'error'
                                )
                            }
                            table.ajax.reload();
                        },
                        error: function(ajaxContext) {
                            console.log(ajaxContext);
                            Swal.fire(
                                'Oops...',
                                'Tindakan yang anda minta tidak diizinkan.',
                                'error',
                            )
                        }
                    });
                }
            })
        };

        function resetStatus(id){
            var url = "{{ \Request::url() }}" + "/reset";
            var _token = "{{ csrf_token() }}";

            Swal.fire({
                title: 'Apakah kamu yakin akan mereset status ini?',
                text: "Status pengajuan akan direset!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Reset Status!',
                cancelButtonText: 'Batal',
                allowOutsideClick: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url + "/" + id,
                        type: 'POST',
                        data: {
                            _token: _token
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: data.message,
                                    icon: 'success',
                                    allowOutsideClick: false,
                                    confirmButtonText: 'OK'
                                })
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    data.message,
                                    'error'
                                )
                            }
                            table.ajax.reload();
                        },
                        error: function(ajaxContext) {
                            console.log(ajaxContext);
                            Swal.fire(
                                'Oops...',
                                'Tindakan yang anda minta tidak diizinkan.',
                                'error',
                            )
                        }
                    });
                }
            });
        }
    </script>
    @include('layouts.swal')
@endsection
