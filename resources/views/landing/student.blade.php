@extends('landing.main')
@section('content')
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
        <section class="section about position-relative">
            <div class="bg-about"
                style="
            background: url({{ asset('assets/img/webpages/icons8_user.svg') }});
            background-size: 400px;
            background-repeat : no-repeat;
            background-position:center;
            ">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-6 offset-md-0">
                        <div class="about-item ">
                            <span class="h6 text-color">Student Profile</span>

                            <div class="about-content profile-data">

                                <ul>
                                    <li>
                                        Name : {{ $students->user->name }}
                                    </li>
                                    <li>
                                        NISN : {{ $students->nisn }}
                                    </li>
                                    <li>
                                        NIS : {{ $students->nis }}
                                    </li>
                                    <li>
                                        Class: {{ $students->class->code }}
                                    </li>
                                    <li>
                                        Religion : {{ $students->religion }}
                                    </li>
                                    <li>
                                        Birthday : {{ $students->birthdate }}
                                    </li>
                                    <li>
                                        Generation : {{ $students->generation }}
                                    </li>
                                    <li>
                                        Phone : {{ $students->phone }}
                                    </li>
                                    <li>
                                        Email : {{ $students->email }}
                                    </li>
                                    <li>
                                        Address : {{ $students->address }}
                                    </li>

                                </ul>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
