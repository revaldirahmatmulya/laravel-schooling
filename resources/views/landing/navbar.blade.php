<header class="navigation">

    <nav class="navbar navbar-expand-lg  py-4" id="navbar">
        <div class="container">
            <div class="logo-wrap">
                <div class="row  align-items-center">
                    <div class="col-lg-2">
                        <a class="navbar-brand" href="{{ url('home') }}">
                            {{-- Mega<span>kit.</span> --}}
                            @if ($profile->image)
                                <img src="{{ asset('storage/school_profile/logo/' . explode('/', $profile->image)[3]) }}"
                                    alt="" class="logo-site">
                            @endif
                        </a>
                    </div>
                    <div class="col-lg-10 ">
                        <p class="text-white fw-bold " style="font-size:20px;font-weight:600;">
                            {{ $profile->name }}</p>
                    </div>
                </div>
            </div>


            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
            </button>

            <div class="collapse navbar-collapse text-center nav-wrap" id="navbarsExample09">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('home') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('news') }}">News</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Teacher and Staff</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown03">
                            <li><a class="dropdown-item" href="{{ url('teachers') }}">Teacher</a></li>
                            <li><a class="dropdown-item" href="{{ url('staffs') }}">Staff</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('students') }}">Student</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Major</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown05">
                            @foreach ($majors as $item)
                                <li><a class="dropdown-item"
                                        href="{{ url('major/' . $item->id . '/' . $item->code) }}">{{ $item->code }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
