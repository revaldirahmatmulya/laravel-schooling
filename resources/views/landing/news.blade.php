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
                            <span class="text-white">News</span>
                            <h1 class="text-capitalize mb-4 text-lg">Our School Blog</h1>

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
                    @forelse ($news as $item)
                        <div class="col-lg-6 col-md-6 mb-5">
                            <div class="blog-item">
                                <img src="{{ $item->image }}" alt="" class="img-news-grid">

                                <div class="blog-item-content bg-white p-5">
                                    <div class="blog-item-meta bg-white py-1 px-2">
                                        <a href=""> <span class="text-muted text-capitalize mr-3"><i
                                                    class="ti-pencil-alt mr-2"></i>{{ $item->category->name }}</span></a>



                                        <span class="text-black text-capitalize mr-3"><i
                                                class="ti-time mr-1"></i>{{ $item->date }}</span>
                                    </div>

                                    <h3 class="mt-3 mb-3"><a
                                            href="/news/details{{ '/' . $item->id . '/' . $item->slug }}">{{ $item->title }}</a>
                                    </h3>
                                    <p class="mt-3 mb-3 text-justify">
                                        {!! Str::limit($item->description, 200) !!}
                                    </p>
                                    <a href="/news/details{{ '/' . $item->id . '/' . $item->slug }}"
                                        class="btn btn-small btn-main btn-round-full">Learn More</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <div class="block text-center">
                                <h1 class="text-black">Sorry</h1>
                                <h1 class="text-capitalize mb-4 text-lg text-black">News unavailable !</h1>

                            </div>
                        </div>
                    @endforelse
                    @foreach ($news as $item)
                        @if (!$news == null)
                        @else
                        @endif
                    @endforeach
                </div>
            </div>
        </section>


        {{-- end --}}
    </div>
@endsection
