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
                                    <h2 class="text-white pb-2 fw-bold">Hi ! {{ auth()->user()->name }} Welcome to <span
                                            class="text-warning">Schooling Application</span></h2>
                                    <h5 class="text-white op-7 mb-2">Manage your website quickly and easily</h5>
                                </div>

                            </div>
                        </div>
                    </div>



                    <div class="page-inner mt--5">
                        {{-- Staff akademik  --}}
                        @if (Auth::user()->position_id == 1 || Auth::user()->position_id == 2)
                            <section class="akademik">
                                <div class="">
                                    @if (Auth::user()->position_id == 1)
                                        <h3 class="dashboard-title">Akademik</h3>
                                    @endif
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="card card-stats card-round bg-white shadow bg-white rounded">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-5">
                                                            <div class="icon-big text-center">
                                                                <i class="fas fa-users "></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-7 col-stats">
                                                            <div class="numbers">
                                                                <p class="card-category fw-bold">Siswa</p>
                                                                <h4 class="card-title">{{ $studentsCount }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="card card-stats card-round bg-white shadow bg-white rounded">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-5">
                                                            <div class="icon-big text-center">
                                                                <i class="fas fa-user-tie"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-7 col-stats">
                                                            <div class="numbers">
                                                                <p class="card-category fw-bold">Guru</p>
                                                                <h4 class="card-title">{{ $teachersCount }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="card card-stats card-round  bg-white shadow bg-white rounded">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-5">
                                                            <div class="icon-big text-center">
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-7 col-stats">
                                                            <div class="numbers">
                                                                <p class="card-category">Jurusan</p>
                                                                <h4 class="card-title">{{ $majorsCount }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 ">
                                            <div class="card card-stats card-round bg-white shadow bg-white rounded">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-5">
                                                            <div class="icon-big text-center">
                                                                <i class="fas fa-book-open"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-7 col-stats">
                                                            <div class="numbers">
                                                                <p class="card-category">Mapel</p>
                                                                <h4 class="card-title">{{ $subjectsCount }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 ">
                                            <div class="card card-stats card-round  bg-white shadow bg-white rounded">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-5">
                                                            <div class="icon-big text-center">
                                                                <i class="fas fa-user-graduate"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-7 col-stats">
                                                            <div class="numbers">
                                                                <p class="card-category">Alumni</p>
                                                                <h4 class="card-title">{{ $alumnusCount }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card card-round shadow bg-white rounded">
                                                <canvas id="myChart" width="200" height="200"></canvas>
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card card-round shadow bg-white rounded">
                                                <canvas id="myChart2" width="200" height="200"></canvas>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </section>
                        @endif
                        {{-- UKS --}}
                        @if (Auth::user()->position_id == 1 || Auth::user()->position_id == 11)
                            <section class="uks">
                                @if (Auth::user()->position_id == 1)
                                    <h3 class="dashboard-title">UKS</h3>
                                @endif
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card card-stats card-round bg-white shadow bg-white rounded">
                                                    <div class="card-body ">
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <div class="icon-big text-center">
                                                                    <i class="fas fa-tablets"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-7 col-stats">
                                                                <div class="numbers">
                                                                    <p class="card-category">Jumlah Obat</p>
                                                                    <h4 class="card-title">{{ $drugsCount }}</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card card-stats card-round bg-white shadow bg-white rounded">
                                                    <div class="card-body ">
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <div class="icon-big text-center">
                                                                    <i class="fas fa-user-md"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-7 col-stats">
                                                                <div class="numbers">
                                                                    <p class="card-category">Jumlah Petugas</p>
                                                                    <h4 class="card-title">{{ $uksOfficers }}</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="card card-round shadow bg-white rounded">
                                            <canvas id="myChart3" width="500" height="250"></canvas>
                                        </div>
                                    </div>
                                </div>

                            </section>
                        @endif
                        {{-- Staff perpus --}}
                        @if (Auth::user()->position_id == 1 || Auth::user()->position_id == 9)
                            <section class="perpus">
                                @if (Auth::user()->position_id == 1)
                                    <h3 class="dashboard-title">Perpustakaan</h3>
                                @endif
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="card card-round bg-white shadow rounded">
                                            <canvas id="myChart6" width="400" height="400"></canvas>
                                        </div>

                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card card-stats card-round bg-white shadow rounded">
                                                    <div class="card-body ">
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <div class="icon-big text-center">
                                                                    <i class="fas fa-book-open"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-7 col-stats">
                                                                <div class="numbers">
                                                                    <p class="card-category">Jumlah Buku</p>
                                                                    <h4 class="card-title">{{ $books }}</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">

                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="card-title">Informasi Peminjaman Telat</div>
                                                    </div>
                                                    <div class="card-body pb-0">
                                                        @foreach ($late as $item)
                                                            <div class="row">

                                                                <div class="col-lg-8 offset-lg-1">
                                                                    <h3 class="fw-bold mb-1">
                                                                        {{ $item->student->user->name }}</h3>
                                                                    <h5>{{ $item->book->title }}</h5>
                                                                    <h5 class="text-red">{{ $item->return_date }}</h5>
                                                                    <h5>{{ $item->description }}</h5>
                                                                </div>

                                                            </div>
                                                            <div class="separator-dashed"></div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </section>
                        @endif
                        {{-- Staff Sarpras --}}
                        @if (Auth::user()->position_id == 1 || Auth::user()->position_id == 7)
                            <section class="sarpras">
                                @if (Auth::user()->position_id == 1)
                                    <h3 class="dashboard-title">Sarpras</h3>
                                @endif
                                <div class="row">

                                    <div class="col-sm-6 col-md-6">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card card-stats card-round shadow bg-white rounded">
                                                    <div class="card-body ">
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <div class="icon-big text-center">
                                                                    <i class="fas fa-box"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-7 col-stats">
                                                                <div class="numbers">
                                                                    <p class="card-category">Jumlah Barang</p>
                                                                    <h4 class="card-title"> {{ $itemsCount }}</h4>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card card-stats card-round shadow bg-white rounded">
                                                    <div class="card-body ">
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <div class="icon-big text-center">
                                                                    <i class="fas fa-door-closed"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-7 col-stats">
                                                                <div class="numbers">
                                                                    <p class="card-category">Jumlah Ruangan</p>
                                                                    <h4 class="card-title"> {{ $roomsCount }}</h4>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card card-round shadow bg-white rounded">
                                            <canvas id="myChart7" width="400" height="400"></canvas>
                                        </div>

                                    </div>
                                </div>

                            </section>
                        @endif
                        {{-- Staff humas --}}
                        @if (Auth::user()->position_id == 1 || Auth::user()->position_id == 10)
                            <section class="humas">
                                @if (Auth::user()->position_id == 1)
                                    <h3 class="dashboard-title">Humas</h3>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-round shadow bg-white rounded">
                                            <canvas id="myChart8" width="400" height="400"></canvas>
                                        </div>

                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="card card-stats card-round bg-white shadow bg-white rounded">
                                            <div class="card-body ">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="icon-big text-center">
                                                            <i class="fas fa-solid fa-user"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 col-stats">
                                                        <div class="numbers">
                                                            <p class="card-category">Jumlah Tamu</p>
                                                            <h4 class="card-title">{{ $guestCount }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @endif
                        {{-- Siswa --}}
                        @if (Auth::user()->position_id == 4)
                            <section class="siswa">

                                <div class="row first">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="card-title">Informasi Saya</div>
                                                    </div>
                                                    <div class="card-body pb-0">

                                                        <div class="row">
                                                            <div class="col-lg-3 pl-5">
                                                                <div class="avatar">

                                                                    <i class="fas fa-solid fa-user fa-6x"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8 offset-lg-1">
                                                                <h2 class="fw-bold mb-1">{{ $name }}</h2>
                                                                <h4>{{ $nisn }}</h4>
                                                                <h4>Kelas {{ $class }}</h4>
                                                                <h4>{{ $major }}</h4>
                                                            </div>

                                                        </div>
                                                        <div class="separator-dashed"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card card-round shadow bg-white rounded">

                                                    <canvas id="myChart4"></canvas>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title">Tugas Terbaru</div>
                                            </div>
                                            <div class="card-body pb-0">
                                                @foreach ($taskName as $index => $value)
                                                    <div class="d-flex">

                                                        <div class="flex-1 pt-1 ml-2">
                                                            <h3 class="fw-bold mb-1">{{ $taskName[$index] }}</h3>
                                                            <small
                                                                class="text-muted">{{ $taskDescription[$index] }}</small>
                                                        </div>

                                                    </div>
                                                    <div class="separator-dashed"></div>
                                                @endforeach



                                            </div>
                                        </div>


                                    </div>
                                </div>


                            </section>
                        @endif
                        {{-- Ortu --}}
                        @if (Auth::user()->position_id == 6)
                            <section class="siswa">
                                @foreach ($student as $item)
                                    <div class="row first">
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-title">Informasi Anak</div>
                                                </div>
                                                <div class="card-body pb-0">

                                                    <div class="row">
                                                        <div class="col-lg-3 pl-5">
                                                            <div class="avatar">

                                                                <i class="fas fa-solid fa-user fa-6x"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8 offset-lg-1">
                                                            <h2 class="fw-bold mb-1">{{ $item->user->name }}</h2>
                                                            <h4>{{ $item->nis }}</h4>
                                                        </div>

                                                    </div>
                                                    <div class="separator-dashed"></div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-title">Informasi Kelas Anak</div>
                                                </div>
                                                <div class="card-body pb-0">

                                                    <div class="row">

                                                        <div class="col-lg-8 offset-lg-1">
                                                            <h2 class="fw-bold mb-1">Kelas {{ $item->class->name }}</h2>
                                                            <h2>{{ $item->class->major->code }}</h2>

                                                        </div>

                                                    </div>
                                                    <div class="separator-dashed"></div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row" style="margin-bottom: 30px">
                                        <div class="col-lg-6">
                                            <div class="card card-round shadow bg-white rounded">
                                                <canvas id={{ 'atn' . '-' . $item->id }}></canvas>
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card card-round shadow bg-white rounded">
                                                <canvas id={{ 'scr' . '-' . $item->id }}></canvas>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="separator-dashed"></div>
                                @endforeach

                            </section>
                        @endif
                        {{-- Guru --}}
                        @if (Auth::user()->position_id == 3)
                            <div class="row ">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-12 ">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-title">Informasi Saya</div>
                                                </div>
                                                <div class="card-body ">

                                                    <div class="d-flex mb-3">

                                                        <div class="avatar pl-4 ">

                                                            <i class="fas fa-solid fa-user fa-6x"></i>
                                                        </div>

                                                        <div class="flex-1 pt-1" style="margin-left: 100px">
                                                            <h2 class="fw-bold mb-1">{{ $teacherName }}</h2>
                                                            <h4>{{ $teacherNIP }}</h4>

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-title">Daftar Murid</div>
                                                </div>
                                                <div class="card-body ml-3 p-0 mt-2">
                                                    @foreach ($students as $item)
                                                        <div class="d-flex justify-content-center align-items-center">


                                                            <i class="fas fa-solid fa-user fa-2x ml-4"></i>

                                                            <div class="flex-1 pt-1 " style="margin-left: 100px">
                                                                <h5 class="fw-bold mb-1">{{ $item->user->name }}</h5>
                                                                <small class="text-muted">{{ $item->nisn }}</small>
                                                            </div>

                                                        </div>
                                                        <div class="separator-dashed"></div>
                                                    @endforeach



                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>


                                <div class="col-md-4 ">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">Tugas Terbaru</div>
                                        </div>
                                        <div class="card-body pb-0">
                                            @foreach ($taskName as $index => $value)
                                                <div class="d-flex">

                                                    <div class="flex-1 pt-1 ml-2">
                                                        <h3 class="fw-bold mb-1">{{ $taskName[$index] }}</h3>
                                                        <small class="text-muted">{{ $taskDescription[$index] }}</small>
                                                    </div>

                                                </div>
                                                <div class="separator-dashed"></div>
                                            @endforeach



                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif

                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="copyright ml-auto">
                            2018, made with <i class="fa fa-heart heart text-danger"></i> by <a
                                href="https://weboendercommunity.github.io/web/">Weboender Community</a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    @endsection

    @section('js')
        {{-- akademik --}}
        @if (Auth::user()->position_id == 1 || Auth::user()->position_id == 2)
            <script>
                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($classesList) !!},
                        datasets: [{
                            label: 'Siswa',
                            data: {!! json_encode($studentsClassesGroup) !!},
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Jumlah siswa per kelas'
                        },
                        scales: {
                            yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero: true,
                                    max: 100,
                                    min: 0,
                                    stepSize: 5
                                }
                            }]
                        },
                    },
                });

                const dataStudentMajorGroup = {!! json_encode($studentsMajorsGroup) !!};                                                
                const ctx2 = document.getElementById('myChart2').getContext('2d');
                const myChart2 = new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($majorsList) !!},
                        datasets: [{
                            label: 'Siswa',
                            data: Object.keys(dataStudentMajorGroup).map((key) => dataStudentMajorGroup[key]),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            title: {
                                display: true,
                                text: 'Jumlah siswa per jurusan'
                            },
                            yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero: true,
                                    max: 100,
                                    min: 0,
                                    stepSize: 5
                                }
                            }]
                        },
                    },
                });
            </script>
        @endif

        {{-- UKS --}}
        @if (Auth::user()->position_id == 1 || Auth::user()->position_id == 11)
            <script>
                new Chart(document.getElementById("myChart3"), {
                    type: "line",
                    data: {
                        labels: {!! json_encode($Days1) !!},
                        datasets: [{
                            label: 'Pasien',
                            backgroundColor: "rgba(0,0,0,1.0)",
                            borderColor: "rgba(0,0,0,0.1)",
                            data: {!! json_encode($uksDayCount) !!}
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Pasien per hari'
                        },
                        scales: {
                            yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero: true,
                                    max: 30,
                                    min: 0,
                                    stepSize: 5
                                }
                            }]
                        },
                    }
                });
            </script>
        @endif

        {{-- Siswa Chart --}}
        @if (Auth::user()->position_id == 4)
            <script>
                new Chart(document.getElementById("myChart4"), {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($taskNameScores) !!},
                        datasets: [{
                            label: 'Nilai',
                            data: {!! json_encode($scoresValue) !!},
                            backgroundColor: [

                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Scores Statistics'
                        },
                        scales: {
                            yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero: true,
                                    max: 100,
                                    min: 0,
                                    stepSize: 5
                                }
                            }]
                        },

                    }
                });
            </script>
        @endif
        {{-- Ortu --}}
        @if (Auth::user()->position_id == 6)
            <script>
                var day = {!! json_encode($eachDay) !!}
                var length = day.length;
                var taskName = {!! json_encode($eachName) !!}
                var score = {!! json_encode($eachScore) !!}
                var id = {!! json_encode($eachID) !!}

                for (var i = 0; i < length; i++) {
                    new Chart(document.getElementById("atn-" +
                        id[i]), {
                        type: 'pie',
                        data: {
                            labels: ['Hadir', 'Tidak Hadir'],
                            datasets: [{
                                label: 'Mark',
                                data: day[i],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',

                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',

                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {

                        }
                    });

                    new Chart(document.getElementById("scr-" + id[i]), {
                        type: 'bar',
                        data: {
                            labels: taskName[i],
                            datasets: [{
                                label: 'Nilai',
                                data: score[i],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    display: true,
                                    ticks: {
                                        beginAtZero: true,
                                        max: 100,
                                        min: 0,
                                        stepSize: 10
                                    }
                                }]
                            },

                        }
                    });
                }
            </script>
        @endif

        {{-- Perpus --}}
        @if (Auth::user()->position_id == 1 || Auth::user()->position_id == 9)
            <script>
                new Chart(document.getElementById("myChart6"), {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($Days4) !!},
                        datasets: [{
                            data: {!! json_encode($rentalDayCount) !!},
                            label: "Buku",
                            borderColor: "#3e95cd",
                            fill: false
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Peminjaman buku per hari',

                        },
                        scales: {
                            yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero: true,
                                    max: 100,
                                    min: 0,
                                    stepSize: 5
                                }
                            }]
                        },
                    }
                });
            </script>
        @endif

        {{-- Sarpras --}}
        @if (Auth::user()->position_id == 1 || Auth::user()->position_id == 7)
            <script>
                new Chart(document.getElementById("myChart7"), {
                    type: "line",
                    data: {
                        labels: {!! json_encode($Days2) !!},
                        datasets: [{
                            label: "Pengadaan",
                            borderColor: "#3cba9f",
                            fill: false,
                            data: {!! json_encode($procurementsDayCount) !!}
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                text: 'Pengadaan per hari',
                                display: true,
                                ticks: {
                                    beginAtZero: true,
                                    max: 100,
                                    min: 0,
                                    stepSize: 5
                                }
                            }]
                        },

                    }
                });
            </script>
        @endif

        {{-- Humas --}}
        @if (Auth::user()->position_id == 1 || Auth::user()->position_id == 10)
            <script>
                new Chart(document.getElementById("myChart8"), {
                    type: "line",
                    data: {
                        labels: {!! json_encode($Days3) !!},
                        datasets: [{
                            label: 'Tamu',
                            backgroundColor: "rgba(0,0,0,1.0)",
                            borderColor: "rgba(0,0,0,0.1)",
                            data: {!! json_encode($guestDayCount) !!}
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Tamu per hari'
                        },
                        scales: {
                            yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero: true,
                                    max: 30,
                                    min: 0,
                                    stepSize: 1
                                }
                            }]
                        },
                    }
                });
            </script>
        @endif
    @endsection
