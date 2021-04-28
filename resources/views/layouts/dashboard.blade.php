<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
        {{--      dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}"--}}
>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Netflixify @yield('title')</title>
    <!-- Styles -->
    @yield('plugins_css')

    <link href="{{ asset('dashboard/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"
          id="bs-default-stylesheet"/>
    @if (app()->getLocale() == 'ar')
    <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
        <style>
            body, h1, h2, h3, h4, h5, h6 {
                font-family: 'Cairo', sans-serif;
            }
        </style>
        <!-- App css -->
        <link href="{{ asset('dashboard/css/app-creative-rtl.min.css') }}" rel="stylesheet" type="text/css"
              id="app-default-stylesheet"/>
    @else
    <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <style>
            body, h1, h2, h3, h4, h5, h6 {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        <!-- App css -->
        <link href="{{ asset('dashboard/css/app-creative.min.css') }}" rel="stylesheet" type="text/css"
              id="app-default-stylesheet"/>
    @endif



<!-- icons -->
    <link href="{{ asset('dashboard/css/fontawesome/all.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>

    <style>
        body {
            text-transform: capitalize !important;
        }

        .left-side-menu {
            background: #3c4854;
        }

        #sidebar-menu > ul > li > a {
            color: rgba(255, 255, 255, .6);
            font-size: 18px;
        }

        #sidebar-menu > ul > li > a i {
            font-size: 22px;
        }

        body[data-sidebar-size=condensed] .left-side-menu #sidebar-menu > ul > li > a i {
            font-size: 25px;
        }

        @media (min-width: 768px) {
            body[data-sidebar-size=condensed]:not([data-layout=compact]) {
                min-height: 80vh;
            }
        }

        .footer {
            color: rgba(255, 255, 255, .6);
            background: #3c4854;
        }

        .nav-second-level li a {
            color: rgba(255, 255, 255, .6);
        }
    </style>

    @stack('style')
</head>

<body>

<!-- Begin page -->
<div id="wrapper">

    <!-- Topbar Start -->
@include("dashboard.includes._navbar")
<!-- end Topbar -->

    <!-- ========== Left Sidebar Start ========== -->
@include("dashboard.includes._aside")
<!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
        @include('sweetalert::alert')

        <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        @yield('breadcrumb')

                        <main class="py-4">
                            @include("partials.messages")
                            @yield('content')
                        </main>
                    </div>
                </div>
                <!-- end page title -->

            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
    @include("dashboard.includes._footer")
    <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->


<!-- Vendor js -->
<script src="{{ asset('dashboard/js/vendor.min.js') }}"></script>


@yield('plugins_js')
<!-- Tippy js-->
<script src="{{ asset('dashboard/plugins/tippy.js/tippy.all.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('dashboard/js/app.min.js') }}"></script>

<!-- Custom js -->
<script src="{{ asset('dashboard/js/custom.js') }}"></script>

@yield('script')

</body>
</html>
