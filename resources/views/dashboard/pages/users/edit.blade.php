@extends('layouts.dashboard')

@section('title', '| Edit User')

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
                    <strong>edit user</strong>
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
                    <h4 class="text-white">edit user</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div class="col-lg-6">
                            <div class="card mb-0">
                                <div class="card-body p-0">
                                    <form action="{{ route('dashboard.users.update', $user->id) }}" method="post">
                                        @csrf
                                        @method('put')

                                        {{--name--}}
                                        <div class="form-group">
                                            <label for="name">
                                                <strong>name</strong>
                                            </label>
                                            <input type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   id="name" name="name" value="{{ old('name', $user->name) }}"
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
                                                   id="email" name="email" value="{{ old('email', $user->email) }}"
                                                   aria-describedby="emailHelp" placeholder="Enter email">
                                            @error('email')
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
                                                    <option
                                                            value="{{ $role->id }}"
                                                            {{ $user->hasRole($role->name) ? 'selected' : '' }}
                                                    >
                                                        {{$role->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('permissions')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>{{--end of form-group--}}

                                        <div class="form-group text-center mb-0">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Edit User
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
