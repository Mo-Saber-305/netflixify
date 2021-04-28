@extends("layouts.dashboard")

@section('title', '| Roles')

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

    <style>
        th:nth-of-type(4) {
            width: 100px !important;
        }
    </style>

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
                    <strong>Roles</strong>
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
                    <h4 class="text-white">all roles</h4>


                    <a href="{{ route('dashboard.roles.create') }}" class="btn btn-primary">create role</a>
                </div>
                <div class="card-body">
                    <table id="selection-datatable" class="table dt-responsive nowrap w-100 text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>user count</th>
                            <th>actions</th>
                        </tr>
                        </thead>
                        @php
                            $pers = [];
                        @endphp
                        <tbody>
                        @foreach($roles as $key => $role)
                            <tr>
                                @php
                                    $pers[] = $role->permissions;
                                @endphp
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $role->display_name }}</td>
                                <td>{{ $role->users_count }}</td>
                                <td>
                                    @if(auth()->user()->hasPermission('read_permissions'))
                                        <button type="button" class="btn btn-soft-blue btn-sm mr-2 permissions-btn"
                                                data-toggle="modal"
                                                data-target="#permissionsmodal"
                                                title="permissions" data-plugin="tippy"
                                                data-permissions="{{ $role->permissions }}"
                                                data-tippy-animation="scale" data-tippy-arrow="true">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-soft-blue btn-sm mr-2 permissions-btn"
                                                disabled>
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    @endif

                                    @if(auth()->user()->hasPermission('update_roles'))
                                        <a href="{{route('dashboard.roles.edit', $role->id)}}"
                                           class="btn btn-soft-success btn-sm mr-2" title="edit" data-plugin="tippy"
                                           data-tippy-animation="scale" data-tippy-arrow="true">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @else
                                        <a href="#" class="btn btn-soft-success btn-sm mr-2" disabled>
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif

                                    @if(auth()->user()->hasPermission('delete_roles'))
                                        <button type="button" class="btn btn-soft-danger btn-sm delete-btn"
                                                data-toggle="modal"
                                                data-target="#deletemodal"
                                                title="delete" data-plugin="tippy" data-id="{{ $role->id }}"
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

        <!-- delete modal content -->
        <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="myCenterModalLabel">
                            <strong>delete role</strong>
                        </h2>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body text-center">
                        <h3 class="mt-0">Are you sure?</h3>
                        <p class="mb-0">You won't to delete this role</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('dashboard.roles.destroy') }}" method="post">
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

        <!-- permissions modal content -->
        <div class="modal fade" id="permissionsmodal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myCenterModalLabel">
                            <strong>list of permissions</strong>
                        </h3>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body text-center ">
                        <div class="row justify-content-center per-list"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark mr-1" data-dismiss="modal">Close</button>
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
    <script src="{{ asset('dashboard/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
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
            var selection_datatable_length = $('#selection-datatable_length')
            selection_datatable_length.addClass('d-flex justify-content-between');
            selection_datatable_length.append(
                '<div class="">text</div>'
            );
            $('.delete-btn').on('click', function () {
                var cat_id = $(this).attr('data-id');

                $('#cat_id').val(cat_id)
            });

            $('.permissions-btn').on('click', function () {
                var permissions = $(this).attr('data-permissions');
                // console.log(permissions);
                $.each(JSON.parse(permissions), function (key, value) {
                    $('.per-list').append(
                        '<div class="col-md-3 mb-2">' +
                        '<span class="badge badge-soft-primary py-1">' +
                        '<strong>' + value.display_name + '</strong>' +
                        '</span>' +
                        '</div>'
                    )
                })
            })
        })
    </script>
@stop