@extends('layouts.dashboard')

@section('title', '| Create User')

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
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.users.index') }}">
                        <strong>Users</strong>
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>create user</strong>
                </li>
            </ol>
        </div>
        <h3 class="page-title font-weight-bold">users</h3>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark d-flex justify-content-between">
                    <h4 class="text-white">create user</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div class="col-lg-6">
                            <div class="card mb-0">
                                <div class="card-body p-0">
                                    <form action="{{ route('dashboard.users.store') }}" method="post">
                                        @csrf

                                        {{--name--}}
                                        <div class="form-group">
                                            <label for="name">
                                                <strong>name</strong>
                                            </label>
                                            <input type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   id="name" name="name" value="{{ old('name') }}"
                                                   aria-describedby="emailHelp" placeholder="Enter name">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>{{--end of form-group--}}

                                        {{--email--}}
                                        <div class="form-group">
                                            <label for="email">
                                                <strong>email</strong>
                                            </label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                                   id="email" name="email" value="{{ old('email') }}"
                                                   aria-describedby="emailHelp" placeholder="Enter email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>{{--end of form-group--}}

                                        {{--password--}}
                                        <div class="form-group">
                                            <label for="password">
                                                <strong>password</strong>
                                            </label>
                                            <input type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   id="password" name="password" value="{{ old('password') }}"
                                                   aria-describedby="emailHelp" placeholder="Enter password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>{{--end of form-group--}}

                                        {{--password confirmation--}}
                                        <div class="form-group">
                                            <label for="password_confirmation">
                                                <strong>password confirmation</strong>
                                            </label>
                                            <input type="password"
                                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                                   id="password_confirmation" name="password_confirmation"
                                                   value="{{ old('password_confirmation') }}"
                                                   aria-describedby="emailHelp"
                                                   placeholder="Enter password confirmation">
                                            @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>{{--end of form-group--}}

                                        {{--role--}}
                                        <div class="form-group">
                                            <select class="form-control @error('permissions') is-invalid @enderror"
                                                    data-toggle="select2" name="role" data-placeholder="Choose role">
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('permissions')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>{{--end of form-group--}}

                                        <div class="form-group">
                                            <a href="{{ route('dashboard.roles.create') }}">create new role</a>
                                        </div>{{--end of form-group--}}


                                        <div class="form-group text-center mb-0">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Create User
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
