@extends('layouts.dashboard')

@section('title', '| Create Movie')

@section('plugins_css')
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css') }}">
@stop

@push('style')
    <style>
        #movie_box_file {
            border: 1px dashed black;
            height: 25vh;
            cursor: pointer;
            display: {{ $errors->any() ? 'none' : 'flex' }};
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        #movie_submit_btn {
            display: {{ $errors->any() ? 'block' : 'none' }};
        }

        #movie_details {
            display: {{ $errors->any() ? 'block' : 'none' }};
        }

        .select2-container .select2-selection--multiple {
            border: 1px solid {{ $errors->has('categories') ? '#f1556c' : '#ced4da' }}                !important;;
        }
    </style>
@endpush

@section('breadcrumb')
    <div class="page-title-box">
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.welcome') }}">
                        <strong>dashboard</strong>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.movies.index') }}">
                        <strong>Movies</strong>
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>create movie</strong>
                </li>
            </ol>
        </div>
        <h3 class="page-title font-weight-bold">movies</h3>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark d-flex justify-content-between">
                    <h4 class="text-white">create movie</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div class="col-lg-6">
                            <div class="mb-3" id="movie_box_file"
                                 onclick="document.getElementById('movie_file').click()"
                            >
                                <i class="mdi mdi-video mdi-36px"></i>
                                <p class="mb-0">click to upload</p>
                            </div>

                            <input type="file" id="movie_file"
                                   data-movie-id="{{ $movie->id }}"
                                   data-url="{{ route('dashboard.movies.store') }}"
                                   style="display: none">

                            <div class="card mb-0" id="movie_details">
                                <div class="card-body p-0">
                                    <form
                                        action="{{ route('dashboard.movies.update', ['movie' => $movie->id, 'type' => 'publish']) }}"
                                        method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')

                                        {{--progress--}}
                                        <div class="form-group"
                                             style="display: {{ $errors->any() ? 'none' : 'block' }}">
                                            <label for="movie_uploading" id="movie_uploading_label">
                                                <strong>uploading</strong>
                                            </label>
                                            <div class="progress mb-2 progress-xl">
                                                <div class="progress-bar progress-bar-striped" role="progressbar"
                                                     aria-valuenow="0" aria-valuemin="0"
                                                     aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>

                                        {{--name--}}
                                        <div class="form-group">
                                            <label for="movie_name">
                                                <strong>name</strong>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                   id="movie_name" name="name" value="{{ old('name', $movie->name) }}"
                                                   aria-describedby="emailHelp" placeholder="Enter name">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>{{--end of form-group--}}

                                        {{--description--}}
                                        <div class="form-group">
                                            <label for="movie_description">
                                                <strong>description</strong>
                                            </label>
                                            <textarea type="text"
                                                      class="form-control @error('description') is-invalid @enderror"
                                                      id="movie_description" name="description"
                                                      aria-describedby="emailHelp"
                                                      placeholder="Enter description">{{ old('description', $movie->description) }}</textarea>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>{{--end of form-group--}}

                                        {{--poster--}}
                                        <div class="form-group">
                                            <label for="movie_poster">
                                                <strong>poster</strong>
                                            </label>
                                            <input type="file"
                                                   class="form-control @error('poster') is-invalid @enderror"
                                                   id="movie_poster" name="poster">
                                            @error('poster')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            <img src="#" id="image_preview" alt="">
                                            @enderror
                                            <div class="text-center mt-3">
                                                <img src="#" id="poster_preview" alt=""
                                                     width="50%">
                                            </div>
                                        </div>{{--end of form-group--}}

                                        {{--image--}}
                                        <div class="form-group">
                                            <label for="movie_image">
                                                <strong>image</strong>
                                            </label>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                                   id="movie_image" name="image">
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <div class="text-center mt-3">
                                                <img src="#" id="image_preview" alt=""
                                                     width="50%">
                                            </div>
                                        </div>{{--end of form-group--}}

                                        {{--categories--}}
                                        <div class="form-group has-error">
                                            <label for="movie_image">
                                                <strong>categories</strong>
                                            </label>

                                            <select
                                                class="@error('categories') is-invalid @enderror form-control select2-multiple "
                                                style="{{ $errors->has('categories') ? '1px solid #f1556c!important' : '' }}"
                                                data-toggle="select2" multiple="multiple"
                                                name="categories[]"
                                                data-placeholder="Choose permission">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ in_array($category->id, $movie->categories->pluck('id')->toArray()) ? 'selected' : '' }}
                                                    >{{ $category->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('categories')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>{{--end of form-group--}}


                                        {{--year--}}
                                        <div class="form-group">
                                            <label for="movie_year">
                                                <strong>year</strong>
                                            </label>
                                            <input type="text"
                                                   class="form-control @error('year') is-invalid @enderror"
                                                   id="movie_year" name="year" value="{{ old('year', $movie->year) }}">
                                            @error('year')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>{{--end of form-group--}}

                                        {{--rating--}}
                                        <div class="form-group">
                                            <label for="movie_rating">
                                                <strong>rating</strong>
                                            </label>
                                            <input type="number" min="1"
                                                   class="form-control @error('rate') is-invalid @enderror"
                                                   id="movie_rating"
                                                   name="rate" value="{{ old('rate', $movie->rate) }}">
                                            @error('rate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>{{--end of form-group--}}

                                        <div class="form-group text-center mb-0">
                                            <button type="submit"
                                                    id="movie_submit_btn"
                                                    class="btn btn-primary waves-effect waves-light">
                                                Create Movie
                                            </button>
                                        </div>{{--end of form-group--}}
                                    </form>{{--end of form--}}
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@stop

@section('plugins_js')
    <script src="{{ asset('dashboard/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/form-advanced.init.js') }}"></script>
@stop

@section('script')
    <script>

        $("#movie_poster").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#poster_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]); // convert to base64 string
            }
        });

        $("#movie_image").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]); // convert to base64 string
            }
        });
    </script>
@endsection
