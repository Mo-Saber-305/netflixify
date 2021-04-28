@extends('layouts.app')

@section('title', 'Netflixify | Login')

@section('content')
    <!--start login-->
    <div class="login">
        <div class="login__bg"></div>

        <div class="container">
            <div class="row">
                <div class="col-10 col-md-8 col-lg-5 bg-white mx-auto p-3">
                    <a href="{{ route('welcome') }}" class="text-decoration-none">
                        <h2 class="text-center" style="color: black">netflix<span class="text-primary">ify</span></h2>
                    </a>
                    <hr>
                    <!--start login form-->
                    <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <!--email-->
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="text" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Enter your name"
                                   aria-describedby="helpId">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <!--password-->
                        <div class="form-group">
                            <label for="password">password</label>
                            <input type="password" name="password" id="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Enter your email"
                                   aria-describedby="helpId">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <!--remember me-->
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">remember me</label>
                        </div>
                        <!--remember me-->

                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-block" type="submit">login</button>
                        </div>

                        <p class="text-center">create new account <a href="{{ route('register') }}">register</a></p>

                        <hr>

                        <!--social login-->
                        <div class="form-group mb-0 text-center">
                            <a href="{{ url('/login/google') }}" class="btn btn-primary btn-block"
                               style="background:#ea4335; border-color: #ea4335">
                                <span class="fab fa-google"></span>
                                login by google
                            </a>
                            <a href="{{ url('/login/facebook') }}" class="btn btn-primary btn-block"
                               style="background:#3b5998; border-color: #3b5998">
                                <span class="fab fa-facebook"></span>
                                login by facebook
                            </a>
                        </div>
                    </form>
                    <!--end login form-->
                </div>
            </div>
        </div>
    </div>
    <!--end login-->
@stop

