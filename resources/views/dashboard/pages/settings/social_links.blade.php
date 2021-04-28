@extends('layouts.dashboard')

@section('title', '| Setting - Social Login')

@section('plugins_css')
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css') }}">
@stop

@section('breadcrumb')
    <div class="page-title-box">
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.welcome') }}">
                        <strong>dashboard</strong>
                    </a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Settings Social Login</strong>
                </li>
            </ol>
        </div>
        <h3 class="page-title font-weight-bold">settings</h3>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark d-flex justify-content-between">
                    <h4 class="text-white">settings social links</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div class="col-lg-6">
                            <div class="card mb-0">
                                <div class="card-body p-0">
                                    @php
                                        $social_links = ['facebook', 'google', 'youtube'];
                                    @endphp
                                    <form action="{{ route('dashboard.settings.store') }}" method="post">
                                        @csrf

                                        @foreach($social_links as $social_link)
                                            {{--social link--}}
                                            <div class="form-group">
                                                <label for="{{ $social_link . '_link' }}">
                                                    <strong>{{ $social_link }} link</strong>
                                                </label>
                                                <input type="text"
                                                       class="form-control"
                                                       id="{{ $social_link . '_link' }}"
                                                       name="{{ $social_link . '_link' }}"
                                                       value="{{ setting($social_link . '_link') }}"
                                                       aria-describedby="emailHelp"
                                                       placeholder="Enter {{ $social_link }} link">
                                            </div>{{--end of form-group--}}
                                        @endforeach

                                        <div class="form-group text-center mb-0">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Save Setting
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
