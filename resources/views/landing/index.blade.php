@extends('landing.main')
@section('content')
    <div class="main-wrapper ">

        {{-- Hero --}}
        <section class="section hero-site slider"
            style="background: url({{ asset('assets/img/webpages/hero2.jpg') }}); background-size: cover;  background-position: 0% 50%;">

            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-10">
                        <div class="block">
                            <span class="d-block mb-3 text-white text-capitalize">Prepare for new future</span>
                            <h1 class="animated fadeInUp mb-5">Our Education <br>Makes your <br>Future Bright.</h1>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- end hero --}}
        {{-- Some content --}}
        <section class="section about position-relative" id="about">
            <div class="bg-about"
                style="
            background: url({{ asset('assets/img/webpages/study.jpg') }});
            background-size: cover;
            ">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-6 offset-md-0">
                        <div class="about-item ">
                            <span class="h6 text-color">What we are</span>
                            <h2 class="mt-3 mb-4 position-relative content-title">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit.
                            </h2>
                            <div class="about-content">
                                <h4 class="mb-3 position-relative">We are Perfect Solution</h4>
                                <p class="mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente ullam
                                    esse possimus minima beatae quod maxime expedita, rerum animi. Amet.</p>

                                <a href="/profile" class="btn btn-main btn-round-full">Get started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- end --}}
        {{-- Majors --}}

        <section class="section cta">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="cta-item  bg-white p-5 rounded">
                            <span class="h6 text-color">Majors</span>
                            <h2 class="mt-2 mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, saepe.
                            </h2>
                            <p class="lead mb-4">See our majors here : </p>
                            <a href="/majors" class="btn btn-small btn-solid-border btn-round-full text-black">Learn
                                More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- end --}}
        {{-- Teachers --}}
        <section class="section teacher-site border-top position-relative">

            <div class="container">
                <div class="row">
                    <div class="col-lg-6  offset-md-0">
                        <div class="about-item ">
                            <span class="h6 text-color">Meet with our teachers</span>
                            <h2 class="mt-3 mb-4 position-relative content-title">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit.
                            </h2>
                            <div class="about-content">
                                <h4 class="mb-3 position-relative">We are Perfect Solution</h4>
                                <p class="mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente ullam
                                    esse possimus minima beatae quod maxime expedita, rerum animi. Amet.</p>

                                <a href="#" class="btn btn-main btn-round-full">Get started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-teacher"
                style="
            background: url({{ asset('assets/img/webpages/teacher.jpg') }});
            background-size: cover;
            ">
            </div>
        </section>
        {{-- end --}}

        {{-- latest news --}}
        <section class="section latest-blog bg-2">
            <div class="container ">
                <div class="row justify-content-center">
                    <div class="col-lg-7 ">
                        <div class="section-title">
                            <span class="h6 text-color">Latest News</span>
                            <h2 class="mt-3 content-title text-white">Latest articles to enrich knowledge</h2>
                        </div>
                    </div>
                </div>


                <div class="row d-flex ">
                    @forelse ($news->take(3) as $news)
                        <div class="col-lg-4 col-md-6 mb-5">
                            <div class="card bg-transparent border-0">
                                <img src="{{ $news->image_url }}" alt="" class=" img-news-home">

                                <div class="card-body mt-2">
                                    <div class="blog-item-meta">
                                        <a href="#" class="text-white-50 ">{{ $news->category->name }}</a>
                                        <p class="text-white-50">{{ $news->date }}</p>

                                    </div>

                                    <h3 class="mt-3 mb-5 lh-36"><a href="#"
                                            class="text-white ">{{ $news->title }}</a>
                                    </h3>
                                    <div class="body-text">
                                        <div class="mt-3 mb-3 text-justify text-white">
                                            {!! Str::limit($news->description, 200) !!}
                                        </div>
                                    </div>


                                    <a href="/news/details{{ '/' . $news->id . '/' . $news->slug }}"
                                        class="btn btn-small btn-solid-border btn-round-full text-white">Learn More</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <div class="block text-center">
                                <h1 class="text-white">Sorry</h1>
                                <h1 class="text-capitalize mb-4 text-lg text-white">News unavailable !</h1>

                            </div>
                        </div>
                    @endforelse

                </div>

            </div>
        </section>
        {{-- end news --}}
    </div>
@endsection
