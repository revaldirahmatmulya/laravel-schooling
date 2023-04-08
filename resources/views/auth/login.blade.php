@extends('layouts.main')

@section('content')

    <body style="overflow: hidden; height:100%">

        <div class="login-bg-wrap">
            <div class="container login-container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="login-wrap">
                            <div class="image-wrap">
                                <div class="overlay"></div>

                            </div>
                            <div class="form-wrap">
                                <h3 class="mb-3 fw-bold" style="font-size: 42px">Schooling</h3>
                                <form action="{{ route('login') }}" method="post" style="width: 25rem">
                                    @csrf
                                    <div class="login-form">
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input id="email" type="email" name="email" class="form-control mb-0"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                                placeholder="Your email">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input class="form-control mb-0" id="password" type="password" name="password"
                                                required autocomplete="current-password" placeholder="Your password">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group" style="position: relative">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}
                                                style="position: absolute; left:30px">
                                            <label class="form-check-label" for="remember"
                                                style="position: absolute; left:30px">Remember Me</label>
                                        </div>
                                        <div class="form-group form-action-d-flex mb-3">
                                            <button class="btn btn-primary col-md-5 float-right mt-3 mt-sm-3 fw-bold">Sign
                                                In</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection
