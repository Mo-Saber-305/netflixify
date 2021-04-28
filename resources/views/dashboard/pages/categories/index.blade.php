@extends("layouts.dashboard")

@section('title', '| Categories')

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
                    <strong>Categories</strong>
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
                    <h4 class="text-white">all categories</h4>
                    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary">create category</a>
                </div>
                <div class="card-body">
                    <table id="selection-datatable" class="table dt-responsive nowrap w-100 text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>movies count</th>
                            <th>actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($categories as $key => $category)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->movies_count }}</td>
                                <td>
                                    @if(auth()->user()->hasPermission('update_categories'))
                                        <a href="{{route('dashboard.categories.edit', $category->id)}}"
                                           class="btn btn-soft-success btn-sm mr-2" title="edit" data-plugin="tippy"
                                           data-tippy-animation="scale" data-tippy-arrow="true">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @else
                                        <a href="#" class="btn btn-soft-success btn-sm mr-2" disabled="">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif

                                    @if(auth()->user()->hasPermission('delete_categories'))
                                        <button type="button" class="btn btn-soft-danger btn-sm delete-btn"
                                                data-toggle="modal"
                                                data-target="#centermodal"
                                                title="delete" data-plugin="tippy" data-id="{{ $category->id }}"
                                                data-tippy-animation="scale" data-tippy-arrow="true">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-soft-danger btn-sm delete-btn" disabled>
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
                            <strong>delete category</strong>
                        </h2>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body text-center">
                        <h3 class="mt-0">Are you sure?</h3>
                        <p class="mb-0">You won't to delete this category</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('dashboard.categories.destroy') }}" method="post">
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
            $('.delete-btn').on('click', function () {
                var cat_id = $(this).attr('data-id');

                $('#cat_id').val(cat_id)
            })
        })
    </script>
@stop
