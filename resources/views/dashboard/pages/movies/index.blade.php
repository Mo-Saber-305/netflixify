@extends("layouts.dashboard")

@section('title', '| Movie')

@section('plugins_css')
    <!-- third party css -->
    <link href="{{ asset('dashboard/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('dashboard/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('dashboard/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
          rel="stylesheet"
          type="text/css"/>
    {{--    <link href="{{ asset('dashboard/plugins/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}"--}}
    {{--          rel="stylesheet"--}}
    {{--          type="text/css"/>--}}
    <!-- third party css end -->
@stop

@push('style')
    <style>
        .table td, .table th {
            vertical-align: middle !important;
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
                <li class="breadcrumb-item active">
                    <strong>Movies</strong>
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
                    <h4 class="text-white">all movies</h4>
                    <div class="col-md-2">
                        <form action="{{ route('dashboard.movies.index') }}" method="get" id="category_form">
                            <select name="category" id="movie_category"
                                    class="custom-select custom-select-sm form-control form-control-sm">
                                <option value="">choose category</option>
                                <option value="all">all</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </form>

                    </div>
                    <a href="{{ route('dashboard.movies.create') }}" class="btn btn-primary">create movie</a>
                </div>
                <div class="card-body">
                    <table id="selection-datatable" class="table dt-responsive nowrap w-100 text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>image</th>
                            <th>description</th>
                            <th>year</th>
                            <th>rate</th>
                            <th>actions</th>
                        </tr>
                        </thead>

                        <tbody class="table-body">
                        @foreach($movies as $key => $movie)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $movie->name }}</td>
                                <td>
                                    <img src="{{ $movie->image_path }}" alt="" width="80" height="80">
                                </td>
                                <td>{{ Str::limit($movie->description, 50) }}</td>
                                <td>{{ $movie->year }}</td>
                                <td>{{ $movie->rate }}</td>
                                <td>
                                    @if(auth()->user()->hasPermission('update_movies'))
                                        <a href="{{route('dashboard.movies.edit', $movie->id)}}"
                                           class="btn btn-soft-success btn-sm mr-2" title="edit" data-plugin="tippy"
                                           data-tippy-animation="scale" data-tippy-arrow="true">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @else
                                        <a href="#" disabled="" class="btn btn-soft-success btn-sm mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif

                                    @if(auth()->user()->hasPermission('delete_movies'))
                                        <button type="button" class="btn btn-soft-danger btn-sm delete-btn"
                                                data-toggle="modal"
                                                data-target="#centermodal"
                                                title="delete" data-plugin="tippy" data-id="{{ $movie->id }}"
                                                data-tippy-animation="scale" data-tippy-arrow="true">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-soft-danger btn-sm" disabled>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->

        <!-- Center modal content -->
        <div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="myCenterModalLabel">
                            <strong>delete movie</strong>
                        </h2>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body text-center">
                        <h3 class="mt-0">Are you sure?</h3>
                        <p class="mb-0">You won't to delete this movie</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('dashboard.movies.destroy') }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="id" id="cat_id">

                            <button type="button" class="btn btn-dark mr-1" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
@stop

@section('plugins_js')
    <!-- third party js -->
    <script src="{{ asset('dashboard/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script
        src="{{ asset('dashboard/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    {{--    <script src="{{ asset('dashboard/plugins/datatables.net-select/js/dataTables.select.min.js') }}"></script>--}}

    <!-- third party js ends -->

    <!-- Datatables init -->
    <script src="{{ asset('dashboard/plugins/datatables.init.js') }}"></script>
@stop

@section('script')
    <script>
        $(function () {
            $('#movie_category').on('change', function () {
                $('#category_form').submit();
            });
            $('.delete-btn').on('click', function () {
                var cat_id = $(this).attr('data-id');

                $('#cat_id').val(cat_id)
            });
        })
    </script>
@stop
