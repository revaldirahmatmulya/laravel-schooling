@extends('landing.main')
@section('content')
    <div class="main-wrapper">
        {{-- Hero title --}}
        <section class="page-title bg-1 "
            style="background-image: url({{ asset('assets/img/webpages/class.jpg') }}); background-position: 0% 30%; background-size: cover;height: 350px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block text-center">
                            <span class="text-white">About Us</span>
                            <h1 class="text-capitalize mb-4 text-lg">Our School</h1>

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
            background: url({{ $profile->image }});
            background-size: 400px;
            background-repeat : no-repeat;
            background-position:center;
            ">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-6 offset-md-0">
                        <div class="about-item ">
                            <span class="h6 text-color">School profile</span>
                            <h2 class="mt-3 mb-4 position-relative content-title">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit.
                            </h2>
                            <div class="about-content profile-data">
                                @foreach ($profile->take(1) as $profile)
                                    <ul>
                                        <li>
                                            NPSN : {{ $profile->npsn }}
                                        </li>
                                        <li>
                                            NSS : {{ $profile->nss }}
                                        </li>
                                        <li>
                                            Address : {{ $profile->address }}
                                        </li>
                                        <li>
                                            Email : {{ $profile->email }}
                                        </li>
                                        <li>
                                            Website : {{ $profile->website }}
                                        </li>

                                    </ul>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- end --}}
        {{-- Vission --}}
        <section class="about-info section pt-0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="about-info-item mb-4 mb-lg-0">
                            <h3 class="mb-3"><span class="text-color mr-2 text-md ">01.</span>Our Vission</h3>
                            <p>llum similique ducimus accusamus laudantium praesentium, impedit quaerat, itaque maxime sunt
                                deleniti voluptas distinctio .</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="about-info-item mb-4 mb-lg-0">
                            <h3 class="mb-3"><span class="text-color mr-2 text-md">02.</span>Mission</h3>
                            <p>llum similique ducimus accusamus laudantium praesentium, impedit quaerat, itaque maxime sunt
                                deleniti voluptas distinctio .</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        {{-- end --}}
        {{-- History --}}
        <section class="history border-bottom">
            <div class="row justify-content-center">
                <div class="col-lg-7 text-center">
                    <div class="section-title">
                        <span class="h6 text-color">Our History</span>
                        <h2 class="mt-3 content-title">From zero to now.</h2>
                    </div>
                </div>
            </div>
            <div class="container ">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="text-justify">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim qui libero quidem explicabo.
                            Consequatur quaerat et inventore commodi veniam quis quibusdam, unde ab dolore quisquam ipsam
                            incidunt aliquam illo at corrupti ipsa nobis assumenda excepturi? Distinctio totam enim ipsa
                            quaerat
                            minima veritatis reiciendis quam possimus corporis officiis ullam architecto neque unde, libero
                            nobis, dolor dolore cumque recusandae. Alias magni itaque quo dolor temporibus soluta molestiae
                            quaerat laboriosam labore, at ab earum culpa nulla voluptates cupiditate vero repellendus nam
                            maxime
                            excepturi, quisquam exercitationem suscipit esse ipsa illo? Veniam quo perspiciatis vel aliquam.
                            Aut, sequi at molestiae obcaecati porro iste minima possimus numquam, velit modi, non quibusdam
                            incidunt illum doloribus! Cum cumque in nam dolorum deserunt porro optio rem, alias, dignissimos
                            quaerat tempora iusto. Possimus perspiciatis at et. Ea dolore totam molestias aliquam
                            consectetur
                            quia commodi dicta voluptatum laudantium atque eum doloremque suscipit nisi quidem iusto vel
                            delectus laborum ab aperiam, corrupti quam. Placeat harum reiciendis obcaecati quasi voluptates
                            quas
                            vero, beatae quam vitae similique, illo repellendus distinctio quos at voluptas mollitia odio,
                            architecto possimus eos? Pariatur suscipit aliquam, excepturi facere iste perferendis in
                            cupiditate
                            incidunt ullam commodi ad corrupti? Quis ab, voluptatem voluptatum iure voluptates doloribus
                            vitae
                            nesciunt ex veniam dignissimos.
                        </p>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-lg-12">
                        <p class="text-justify">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim qui libero quidem explicabo.
                            Consequatur quaerat et inventore commodi veniam quis quibusdam, unde ab dolore quisquam ipsam
                            incidunt aliquam illo at corrupti ipsa nobis assumenda excepturi? Distinctio totam enim ipsa
                            quaerat
                            minima veritatis reiciendis quam possimus corporis officiis ullam architecto neque unde, libero
                            nobis, dolor dolore cumque recusandae. Alias magni itaque quo dolor temporibus soluta molestiae
                            quaerat laboriosam labore, at ab earum culpa nulla voluptates cupiditate vero repellendus nam
                            maxime
                            excepturi, quisquam exercitationem suscipit esse ipsa illo? Veniam quo perspiciatis vel aliquam.
                            Aut, sequi at molestiae obcaecati porro iste minima possimus numquam, velit modi, non quibusdam
                            incidunt illum doloribus! Cum cumque in nam dolorum deserunt porro optio rem, alias, dignissimos
                            quaerat tempora iusto. Possimus perspiciatis at et. Ea dolore totam molestias aliquam
                            consectetur
                            quia commodi dicta voluptatum laudantium atque eum doloremque suscipit nisi quidem iusto vel
                            delectus laborum ab aperiam, corrupti quam. Placeat harum reiciendis obcaecati quasi voluptates
                            quas
                            vero, beatae quam vitae similique, illo repellendus distinctio quos at voluptas mollitia odio,
                            architecto possimus eos? Pariatur suscipit aliquam, excepturi facere iste perferendis in
                            cupiditate
                            incidunt ullam commodi ad corrupti? Quis ab, voluptatem voluptatum iure voluptates doloribus
                            vitae
                            nesciunt ex veniam dignissimos.
                        </p>
                    </div>
                </div>
            </div>

        </section>
        {{-- end --}}

    </div>
@endsection
