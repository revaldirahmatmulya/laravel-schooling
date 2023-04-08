@extends('landing.main')
@section('content')
    <div class="main-wrapper">
        {{-- Hero title --}}
        <section class="page-title bg-1"
            style="background-image: url({{ asset('assets/img/webpages/class.jpg') }}); background-position: 0% 30%; background-size: cover;height: 350px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block text-center">
                            <span class="text-white">Majors</span>
                            <h1 class="text-capitalize mb-4 text-lg">Our Majors</h1>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- End --}}
        {{-- About data --}}
        <section class="section about position-relative">
            <div class="bg-about"
                style="
            background: url({{ asset('assets/img/webpages/icons8_book_reading.svg') }});
            background-size: 400px;
            background-repeat : no-repeat;
            background-position:center;
            ">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-6 offset-md-0">
                        <div class="about-item ">
                            <span class="h6 text-color">About this major</span>
                            <h2 class="mt-3 mb-4 position-relative content-title">{{ $data->name }}
                            </h2>
                            <div class="about-content text-justify">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Error rem consequatur ad? Iste,
                                incidunt accusamus nesciunt ratione, rerum ipsa perspiciatis fugit ut adipisci id tempora ad
                                rem nam quae molestias magni veritatis veniam necessitatibus iusto mollitia debitis aperiam?
                                Rerum at excepturi dolor corrupti dolorem enim provident quaerat ab! Necessitatibus, natus.

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- end --}}
    </div>
@endsection
