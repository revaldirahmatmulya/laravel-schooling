@extends('landing.main')
@section('content')
    {{-- {{ dd($students->class->code) }} --}}
    <div class="main-wrapper">
        <section class="page-title bg-1"
           style="background-image: url({{ asset('assets/img/webpages/class.jpg') }}); background-position: 0% 30%; background-size: cover;height: 350px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block text-center">
                            <span class="text-white">Students</span>
                            <h1 class="text-capitalize mb-4 text-lg">All Students Data</h1>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="table-data mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">NISN</th>
                                        <th scope="col">Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="/student/{{ $item->id }}">{{ $item->user->name }}</a>

                                            </td>
                                            <td>{{ $item->nisn }}</td>
                                            <td>{{ $item->class->code }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
