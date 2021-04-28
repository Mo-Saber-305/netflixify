@extends('layouts.app')

@section('title', 'Netflixify | Register')

@section('content')
    <!--start register-->
    <div class="login">
        <div class="login__bg"></div>

        <div class="container">
            <div class="row">
                <div class="col-10 col-md-8 col-lg-5 bg-white mx-auto p-3">
                    <h2 class="text-center">netflix<span class="text-primary">ify</span></h2>
                    <hr>
                    <!--start register form-->
                    <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!--user name-->
                        <div class="form-group">
                            <label for="name">name</label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Enter your name"
                                   aria-describedby="helpId">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <!--email-->
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="text" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Enter your email"
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
                                   placeholder="Enter your password"
                                   aria-describedby="helpId">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <!--password confirmation-->
                        <div class="form-group">
                            <label for="password_confirmation">password confirm</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="form-control" placeholder="Enter password confirmation"
                                   aria-describedby="helpId">
                        </div>
                        <!--password confirmation-->

                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-block" type="submit">register</button>
                        </div>

                        <p class="text-center">already have an account <a href="{{ route('login') }}">login</a></p>
                        <hr>

                        <!--social register-->
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
                    <!--end register form-->
                </div>
            </div>
        </div>
    </div>
    <!--end register-->
@endsection
