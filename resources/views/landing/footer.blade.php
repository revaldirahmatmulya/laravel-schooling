<footer class="footer section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="widget">
                    <h4 class="text-capitalize mb-4">Our Social Media</h4>                    
                        <ul class="list-unstyled footer-menu lh-35">
                            <li>{{ $profile->email }}</li>
                            <li><a target="_blank" href="{{ $profile->instagram}}">Instagram</a>
                            </li>
                            <li><a target="_blank" href="{{ $profile->facebook }}">Facebook</a></li>
                            <li><a target="_blank" href="{{ $profile->youtube }}">Youtube</a></li>
                        </ul>                    
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="widget">
                    <h4 class="text-capitalize mb-4">Quick Links</h4>

                    <ul class="list-unstyled footer-menu lh-35">
                        <li><a href="{{ url('home') }}">About</a></li>
                        <li><a href="{{ url('news') }}">News</a></li>
                        <li><a href="{{ url('teachers') }}">Teacher</a></li>
                        <li><a href="{{ url('students') }}">Student</a></li>
                        <li><a href="{{ url('majors') }}">Majors</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="widget">
                    <h4 class="text-capitalize mb-4">Subscribe Us</h4>
                    <p>Subscribe to get latest news article and resources </p>

                    <form action="#" class="sub-form">
                        <input type="text" class="form-control mb-3" placeholder="Subscribe Now ...">
                        <a href="#" class="btn btn-main btn-small">subscribe</a>
                    </form>
                </div>
            </div>

            <div class=" col-lg-3 ml-auto col-sm-6">
                @if ($profile->image)
                    <img src="{{ asset('storage/school_profile/logo/' . explode('/', $profile->image)[3]) }}"
                        alt="" style="height: 200px;">
                @endif
            </div>
        </div>
    </div>
</footer>
