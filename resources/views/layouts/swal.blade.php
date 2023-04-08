@if (request()->routeIs('jabatan.add'))
    <?php
    $text = 'Menghapus kategori ini akan juga menghapus Berita yang berkaitan!';
    ?>
@else
    <?php
    $text = 'Anda tidak akan dapat mengembalikan data ini!';
    ?>
@endif

<?php 
    $teks_kembalikan = 'Buku yang telah dikembalikan tidak dapat diedit kembali!'
?>

<script>
    {{ \Request::url() }}

    function delete_data(id) {
        var url = "{{ \Request::url() }}";
        var _token = "{{ csrf_token() }}";          
                             
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "{{ $text }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url + "/" + id,
                    type: 'DELETE',
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

    function return_book(id) {
        var url = "{{ \Request::url() }}";
        var _token = "{{ csrf_token() }}";          
                             
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "{{ $teks_kembalikan }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Kembalikan!',
            cancelButtonText: 'Batal',
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url + "/" +id+"/dikembalikan",
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
</script>
