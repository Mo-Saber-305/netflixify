@extends('layouts.dashboard')

@section('title', '| Edit Role')

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
                    <a href="{{ route('dashboard.roles.index') }}">
                        <strong>Roles</strong>
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>edit role</strong>
                </li>
            </ol>
        </div>
        <h3 class="page-title font-weight-bold">roles</h3>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark d-flex justify-content-between">
                    <h4 class="text-white">edit role</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div class="col-lg-8">
                            <div class="card mb-0">
                                <div class="card-body p-0">
                                    <form action="{{ route('dashboard.roles.update', $role->id) }}" method="post">
                                        @csrf
                                        @method('put')

                                        {{--name--}}
                                        <div class="form-group  d-flex justify-content-center">
                                            <div class="col-md-7">
                                                <label for="name">
                                                    <strong>name</strong>
                                                </label>
                                                <input type="text"
                                                       class="form-control @error('name') is-invalid @enderror"
                                                       id="name" name="name"
                                                       value="{{ old('name', $role->display_name) }}"
                                                       aria-describedby="emailHelp" placeholder="Enter name">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>{{--end of form-group--}}

                                        {{--permissions--}}
                                        <div class="form-group">
                                            @php
                                                $models = ['users', 'categories','movies', 'roles', 'permissions', 'settings'];
                                            @endphp

                                            <table class="table text-center">
                                                <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>models</th>
                                                    <th width="50%">permissions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($models as $key => $model)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $model }}</td>
                                                        <td width="50%">
                                                            @php
                                                                if ($model == 'permissions') {
                                                                    $permissions = ['read'];
                                                                } elseif ($model == 'settings') {
                                                                    $permissions = ['create', 'read'];
                                                                } else {
                                                                    $permissions = ['create', 'read', 'update', 'delete'];
                                                                }
                                                            @endphp
                                                            <select class="form-control select2-multiple @error('permissions') is-invalid @enderror"
                                                                    data-toggle="select2" multiple="multiple"
                                                                    name="permissions[]"
                                                                    data-placeholder="Choose permission">
                                                                @foreach($permissions as $permission)
                                                                    <option
                                                                            value="{{ $permission . '_' . $model }}"
                                                                            {{ $role->hasPermission($permission . '_' . $model) ? 'selected' : '' }}
                                                                    >
                                                                        {{$permission}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('permissions')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>{{--end of table--}}
                                        </div>{{--end of form-group--}}

                                        <div class="form-group text-center mb-0">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Update Role
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
