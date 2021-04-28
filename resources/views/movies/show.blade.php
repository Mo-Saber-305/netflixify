@extends('layouts.app')

@section('title', 'Netflixify | Show Movie')

@section('content')
    <section id="show">
        @include("includes.navbar")

        <div class="movies">
            <div class="movie text-white d-flex justify-content-center align-items-center">
                <div class="movie__bg"
                     style="background: linear-gradient(rgba(0,0,0, 0.7), rgba(0,0,0, 0.7)), url({{ $movie->image_path }}) center/cover no-repeat;"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8" id="player"></div>

                        <div class="col-md-4">
                            <div
                                class="d-flex align-items-center">
                                <h2 class="movie__name fw-300 mb-0 mr-2">{{ $movie->name }}</h2>
                                <span class="movie__year">
								( <span class="text-primary"> {{ $movie->year }} </span> )
							</span>
                            </div>

                            <div
                                class="movie__rate d-flex justify-content-center justify-content-md-start align-items-center my-3">
                                <div class="d-flex">
                                    @for($i = 0; $i < $movie->rate; $i++)
                                        <i class="fas fa-star text-primary mr-1"></i>
                                    @endfor
                                </div>
                                <span class="ml-1">{{ $movie->rate }}</span>
                            </div>

                            <p class="movie__description">{{ $movie->description }}</p>

                            <div class="movie__actions text-center text-md-left">
                                <a href="" class="btn btn-outline-light mb-3 mb-sm-0">
                                    <i class="fas fa-heart"></i>
                                    add to favorites
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="listing py-5">
        <div class="container">

            <div class="mb-4">
                <div class="row  mb-3">
                    <div class="col-12 d-flex justify-content-between">
                        <h3 class="listing__title text-white fw-300">related movies</h3>
                    </div>

                </div>

                <div class=" movies owl-carousel owl-theme">
                    @foreach($movies as $movie)
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
                                    <a href="" class="btn btn-primary mr-4 ">
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
        </div>
    </section>
@stop

@push('script')
    <script>
        var file =
            "[Auto]{{ Storage::url('movies/' . $movie->id .'/' .$movie->id . '.m3u8') }}," +
            "[144]{{ Storage::url('movies/' . $movie->id .'/' .$movie->id . '_0_144.m3u8') }}," +
            "[360]{{ Storage::url('movies/' . $movie->id .'/' .$movie->id . '_1_360.m3u8') }}," +
            "[720]{{ Storage::url('movies/' . $movie->id .'/' .$movie->id . '_2_720.m3u8') }}";

        var player = new Playerjs({
            id: "player",
            file: file,
            poster: "{{ $movie->image_path }}",
            default_quality: "Auto"
        });
    </script>
@endpush
