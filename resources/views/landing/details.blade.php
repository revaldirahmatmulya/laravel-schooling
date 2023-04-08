@extends('landing.main')
@section('content')
    <div class="main-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-5">
                    <div class="single-blog-item ">
                        <img src="{{ $data->image_url }}" alt="" class="img-news-detail ">

                        <div class="blog-item-content bg-white p-5">
                            <div class="blog-item-meta bg-white py-1 px-2">
                                <span class="text-muted text-capitalize mr-3"><i
                                        class="ti-pencil-alt mr-2"></i>{{ $data->category->name }}</span>

                                <span class="text-black text-capitalize mr-3"><i class="ti-time mr-1"></i>
                                    {{ $data->date }}</span>
                            </div>

                            <h2 class="mt-3 mb-4">{{ $data->title }}</h2>
                            <div class="text-justify">
                                {!! $data->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
