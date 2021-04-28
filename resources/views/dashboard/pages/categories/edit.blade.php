@extends('layouts.dashboard')

@section('title', '| Edit Category')

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
                    <a href="{{ route('dashboard.categories.index') }}">
                        <strong>Categories</strong>
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>edit category</strong>
                </li>
            </ol>
        </div>
        <h3 class="page-title font-weight-bold">categories</h3>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark d-flex justify-content-between">
                    <h4 class="text-white">edit category</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div class="col-lg-6">
                            <div class="card mb-0">
                                <div class="card-body p-0">
                                    <form action="{{ route('dashboard.categories.update', $category->id) }}"
                                          method="post">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label for="name">
                                                <strong>name</strong>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                   id="name" name="name" value="{{ $category->name }}"
                                                   aria-describedby="emailHelp" placeholder="Enter name">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>{{--end of form-group--}}

                                        <div class="form-group text-center mb-0">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Update Category
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
