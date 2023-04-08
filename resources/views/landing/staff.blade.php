@extends('landing.main')
@section('content')
    <div class="main-wrapper">
        <section class="page-title bg-1"
            style="background-image: url({{ asset('assets/img/webpages/class.jpg') }}); background-position: 0% 30%; background-size: cover;height: 350px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block text-center">
                            <span class="text-white">Staff</span>
                            <h1 class="text-capitalize mb-4 text-lg">Our Staff</h1>

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
                            <span class="h6 text-color">Staff Profile</span>

                            <div class="about-content profile-data">

                                <ul>
                                    <li>
                                        Name : {{ $staff->user->name }}
                                    </li>
                                    <li>
                                        Gender : {{ $staff->gender }}
                                    </li>
                                    <li>
                                        Religion : {{ $staff->religion }}
                                    </li>
                                    <li>
                                        Birthday : {{ $staff->birthdate . ',' . $staff->birthplace }}
                                    </li>
                                    <li>
                                        Phone : {{ $staff->phone }}
                                    </li>
                                    <li>
                                        Address : {{ $staff->address }}
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
