@extends("layouts.app")

@section('title', 'Netflixify | Home Page')

@section('content')
    <section id="banner">
        @include("includes.navbar")

        <div class="movies owl-carousel owl-theme">
            @foreach($latest_movies as $latest_movie)
                <div class="movie text-white d-flex justify-content-center align-items-center">
                    <div class="movie__bg"
                         style="background: linear-gradient(rgba(0,0,0, 0.7), rgba(0,0,0, 0.7)), url({{ $latest_movie->image_path }}) center/cover no-repeat;"></div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div
                                    class="d-flex justify-content-center justify-content-md-between align-items-center">
                                    <h2 class="movie__name fw-300 mb-0 mr-3 mr-md-0">{{ $latest_movie->name }}</h2>
                                    <span class="movie__year">{{ $latest_movie->year }}</span>
                                </div>

                                <div
                                    class="movie__rate d-flex justify-content-center justify-content-md-start align-items-center my-3">
                                    <div class="d-flex">
                                        @for($i = 0; $i < $latest_movie->rate; $i++)
                                            <i class="fas fa-star text-primary mr-1"></i>
                                        @endfor
                                    </div>
                                    <span class="ml-1">{{ $latest_movie->rate }}</span>
                                </div>

                                <p class="movie__description">{{ $latest_movie->description }}
                                </p>

                                <div class="movie__actions text-center text-md-left">
                                    <a href="{{ route('movies.show', $latest_movie->id) }}"
                                       class="btn btn-primary mb-3 mb-sm-0 mr-2">
                                        <i class="fas fa-play"></i>
                                        watch now
                                    </a>
                                    <a href="" class="btn btn-outline-light mb-3 mb-sm-0">
                                        <i class="fas fa-heart"></i>
                                        add to favorites
                                    </a>
                                </div>
                            </div>
                            <div class="col-8 col-sm-6 mx-auto mr-md-0 ml-md-auto col-md-4 col-lg-3 mt-3">
                                <img src="{{ $latest_movie->poster_path }}" class="img-fluid" alt="....">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>

    <section class="listing py-5">
        <div class="container">
            @foreach($categories as $category)
                <div class="mb-4">
                    <div class="row  mb-3">
                        <div class="col-12 d-flex justify-content-between">
                            <h3 class="listing__title text-white fw-300">{{ $category->name }}</h3>
                            <a href="" class="text-primary">see all</a>
                        </div>

                    </div>

                    <div class=" movies owl-carousel owl-theme">
                        @foreach($category->movies as $movie)
                            <div class="movie">
                                <img src="{{ $movie->poster_path }}" class="img-fluid" alt="">

                                <div class="movie__details text-white">
                                    <div class="title text-center">
                                        <h4 class="mb-0 mb-2">{{ $movie->name }}</h4>
                                        <p class="align-self-end mb-2">
                                            ( <span class="text-primary"> {{ $movie->year }} </span> )
                                        </p>
                                    </div>
                                    <div class="text-center">
                                        <div class="rate d-flex justify-content-center align-items-center mb-2">
                                            <div class="d-flex">
                                                @for($i = 0; $i < $movie->rate; $i++)
                                                    <i class="fas fa-star text-primary mr-1"></i>
                                                @endfor
                                            </div>
                                            <span class="ml-1">{{ $movie->rate }}</span>
                                        </div>

                                        <div class="views  mb-3">
                                            views: <span class="text-primary">300</span>
                                        </div>
                                    </div>

                                    <div class="actions d-flex justify-content-center align-items-center btn-group-sm">
                                        <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-primary mr-4 ">
                                            <i class="fas fa-play mr-1"></i>
                                            watch now
                                        </a>
                                        <a href="" class="text-white">
                                            <i class="far fa-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@stop
