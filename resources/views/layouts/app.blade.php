<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!--fontAwesome-->
    <link rel="stylesheet" href="{{ asset('dist/css/all.min.css') }}">
    <!--bootstrap-->
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}">
    <!--vendor-->
    <link rel="stylesheet" href="{{ asset('dist/css/vendor.min.css') }}">
    <!--main style-->
    <link rel="stylesheet" href="{{ asset('dist/css/main.min.css') }}">
</head>
<body>


@yield('content')

@if(request()->route()->getName() != 'register' && request()->route()->getName() != 'login')
    @include("includes.footer")
@endif

<!--jquery and bootstrap-->
<script src="{{ asset('dist/js/jquery.min.js') }}"></script>
<script src="{{ asset('dist/js/popper.min.js') }}"></script>
<script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
<!--vendor-->
<script src="{{ asset('dist/js/vendor.min.js') }}"></script>
<!--main scripts-->
<script src="{{ asset('dist/js/main.min.js') }}"></script>
<!--player js-->
<script src="{{ asset('dist/js/playerjs.js') }}"></script>
<script>


    $('#banner .movies').owlCarousel({
        loop: true,
        nav: false,
        items: 1,
        dots: false
    });

    $('.listing .movies').owlCarousel({
        loop: true,
        nav: false,
        margin: 15,
        stagePadding: 50,
        responsive: {
            0: {
                items: 1,
            },
            400: {
                items: 2,
            },
            750: {
                items: 3,
            },
            1000: {
                items: 4,
            },
            1200: {
                items: 5,
            }
        },
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true
    });
    $(document).ready(function () {
        $(window).on('scroll', function () {
            if ($(this).scrollTop() > 100) {
                $('#banner .navbar').addClass('navbar-bg-transparent')
            } else {
                $('#banner .navbar').removeClass('navbar-bg-transparent')
            }
        });
    });

</script>

@stack('script')
</body>
</html>
