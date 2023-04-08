@extends('landing.main')
@section('content')
    <div class="main-wrapper">
        {{-- header title --}}
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
        {{-- end --}}

        {{-- blog --}}
        <section class="section blog-wrap bg-gray">
            <div class="container">
                <div class="row">
                    @foreach ($majors as $item)
                        <div class="col-lg-6">
                            <div class="card bg-transparent border-0">
                                <div class="card-body mt-2">
                                    <img src="{{ asset('assets/img/webpages/icons8_book_reading.svg') }}" class="majors-img"
                                        alt="">
                                    <p class="majors-name">{{ $item->name }}</p>
                                    <a href="/major{{ '/' . $item->id . '/' . $item->name }}"
                                        class="btn btn-small btn-solid-border">Learn
                                        More</a>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </section>


        {{-- end --}}
    </div>
@endsection
