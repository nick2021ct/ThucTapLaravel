<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <title>One Shop || e-Commerce HTML Template</title>
    <link rel="icon" type="image/png" href="{{ asset('/') }}/user/images/favicon.png">
    <link rel="stylesheet" href="{{ asset('/') }}/user/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}/user/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}/user/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}/user/css/slick.css">
    <link rel="stylesheet" href="{{ asset('/') }}/user/css/jquery.nice-number.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}/user/css/jquery.calendar.css">
    <link rel="stylesheet" href="{{ asset('/') }}/user/css/add_row_custon.css">
    <link rel="stylesheet" href="{{ asset('/') }}/user/css/mobile_menu.css">
    <link rel="stylesheet" href="{{ asset('/') }}/user/css/jquery.exzoom.css">
    <link rel="stylesheet" href="{{ asset('/') }}/user/css/multiple-image-video.css">
    <link rel="stylesheet" href="{{ asset('/') }}/user/css/ranger_style.css">
    <link rel="stylesheet" href="{{ asset('/') }}/user/css/jquery.classycountdown.css">
    <link rel="stylesheet" href="{{ asset('/') }}/user/css/venobox.min.css">

    <link rel="stylesheet" href="{{ asset('/') }}/user/css/style.css">
    <link rel="stylesheet" href="{{ asset('/') }}/user/css/responsive.css">
    <link rel="stylesheet" href="{{ asset('/') }}/user/css/order_strike.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

    <!-- <link rel="stylesheet" href="css/rtl.css"> -->
</head>

<body>

    <!--============================
        HEADER START
    ==============================-->
    @include('user.layouts.header')
    <!--============================
        HEADER END
    ==============================-->


    <!--============================
        MAIN MENU START
    ==============================-->
    @include('user.layouts.menu')

    <!--============================
        MAIN MENU END
    ==============================-->


    <!--============================
        MOBILE MENU START
    ==============================-->
    @include('user.layouts.mobile_menu')

    <!--============================
        MOBILE MENU END
    ==============================-->

    <!--============================
        BREADCRUMB START
    ==============================-->
    @include('user.layouts.breadcrumb')
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        PRODUCT PAGE START
    ==============================-->
    @yield('content')
    <!--============================
        PRODUCT PAGE END
    ==============================-->


    <!--============================
        FOOTER PART START
    ==============================-->
    @include('user.layouts.footer')
    <!--============================
        FOOTER PART END
    ==============================-->


    <!--============================
        SCROLL BUTTON START
    ==============================-->
    <div class="wsus__scroll_btn">
        <i class="fas fa-chevron-up"></i>
    </div>
    <!--============================
        SCROLL BUTTON  END
    ==============================-->


    <!--jquery library js-->
    <script src="{{ asset('/') }}/user/js/jquery-3.6.0.min.js"></script>
    <!--bootstrap js-->
    <script src="{{ asset('/') }}/user/js/bootstrap.bundle.min.js"></script>
    <!--font-awesome js-->
    <script src="{{ asset('/') }}/user/js/Font-Awesome.js"></script>
    <!--select2 js-->
    <script src="{{ asset('/') }}/user/js/select2.min.js"></script>
    <!--slick slider js-->
    <script src="{{ asset('/') }}/user/js/slick.min.js"></script>
    <!--simplyCountdown js-->
    <script src="{{ asset('/') }}/user/js/simplyCountdown.js"></script>
    <!--product zoomer js-->
    <script src="{{ asset('/') }}/user/js/jquery.exzoom.js"></script>
    <!--nice-number js-->
    <script src="{{ asset('/') }}/user/js/jquery.nice-number.min.js"></script>
    <!--counter js-->
    <script src="{{ asset('/') }}/user/js/jquery.waypoints.min.js"></script>
    <script src="{{ asset('/') }}/user/js/jquery.countup.min.js"></script>
    <!--add row js-->
    <script src="{{ asset('/') }}/user/js/add_row_custon.js"></script>
    <!--multiple-image-video js-->
    <script src="{{ asset('/') }}/user/js/multiple-image-video.js"></script>
    <!--sticky sidebar js-->
    <script src="{{ asset('/') }}/user/js/sticky_sidebar.js"></script>
    <!--price ranger js-->
    <script src="{{ asset('/') }}/user/js/ranger_jquery-ui.min.js"></script>
    <script src="{{ asset('/') }}/user/js/ranger_slider.js"></script>
    <!--isotope js-->
    <script src="{{ asset('/') }}/user/js/isotope.pkgd.min.js"></script>
    <!--venobox js-->
    <script src="{{ asset('/') }}/user/js/venobox.min.js"></script>
    <!--classycountdown js-->
    <script src="{{ asset('/') }}/user/js/jquery.classycountdown.js"></script>

    <!--main/custom js-->
    <script src="{{ asset('/') }}/user/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('user.layouts.scripts')
    @yield('scripts')
</body>

</html>