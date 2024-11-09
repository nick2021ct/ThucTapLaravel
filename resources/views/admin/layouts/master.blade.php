<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from admin.pixelstrap.net/edmin/template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 21 Sep 2024 14:14:17 GMT -->
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Edmin admin is super flexible, powerful, clean &amp; modern responsive bootstrap admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Edmin admin template, best javascript admin, dashboard template, bootstrap admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <title>Edmin - Premium Admin Template</title>
    <!-- Favicon icon-->
    <link rel="icon" href="{{ asset('/') }}admin/assets/images/favicon/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/') }}admin/assets/images/favicon/favicon.png" type="image/x-icon">
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <!-- Font awesome icon css -->
    <link rel="stylesheet" href="{{ asset('/') }}admin/assets/css/vendors/%40fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}admin/assets/css/vendors/%40fortawesome/fontawesome-free/css/fontawesome.css">
    <link rel="stylesheet" href="{{ asset('/') }}admin/assets/css/vendors/%40fortawesome/fontawesome-free/css/brands.css">
    <link rel="stylesheet" href="{{ asset('/') }}admin/assets/css/vendors/%40fortawesome/fontawesome-free/css/solid.css">
    <link rel="stylesheet" href="{{ asset('/') }}admin/assets/css/vendors/%40fortawesome/fontawesome-free/css/regular.css">
    <!-- Ico Icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/assets/css/vendors/%40icon/icofont/icofont.css">
    <!-- Flag Icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/assets/css/vendors/flag-icon.css">
    <!-- Themify Icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/assets/css/vendors/themify-icons/themify-icons/css/themify.css">
    <!-- Animation css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/assets/css/vendors/animate.css/animate.css">
    <!-- Whether Icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/assets/css/vendors/weather-icons/css/weather-icons.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/assets/css/vendors/swiper/swiper-bundle.min.css">
    <!-- Apex Chart css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/assets/css/vendors/apexcharts/dist/apexcharts.css">
    <!-- Data Table css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/assets/css/vendors/simple-datatables/dist/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/assets/css/vendors/scrollbar.css">
    <!-- App css-->
    <link rel="stylesheet" href="{{ asset('/') }}admin/assets/css/style.css">
    <link id="color" rel="stylesheet" href="{{ asset('/') }}admin/assets/css/color-1.css" media="screen">
    <link rel="stylesheet" href="{{ asset('/') }}/admin/assets/css/vendors/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
    
    
  </head>
  <body>
    <!-- tap to top-->
    <div class="tap-top">
      <svg class="feather">
        <use href="https://admin.pixelstrap.net/edm{{ asset('/') }}admin/assets/svg/feather-icons/dist/feather-sprite.svg#arrow-up"></use>
      </svg>
    </div>
    <!-- loader-->
    <div class="loader-wrapper">
      <div class="loader"></div>
    </div>
    <main class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page header start -->
      @include('admin.layouts.header')
      <!-- Page header end-->
      <div class="page-body-wrapper">
        <!-- Page sidebar start-->
        @include('admin.layouts.sidebar')
        <!-- Page sidebar end-->
        
        @yield('content')

        {{-- footer start --}}
        @include('admin.layouts.footer')
        {{-- footer end --}}
      </div>
    </main>
    <!-- jquery-->
    <script src="{{ asset('/') }}admin/assets/js/vendors/jquery/dist/jquery.min.js"></script>
    <!-- bootstrap js-->
    <script src="{{ asset('/') }}admin/assets/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/') }}admin/assets/js/config.js"></script>
    <!-- Sidebar js-->
    <script src="{{ asset('/') }}admin/assets/js/sidebar.js"></script>
    <!-- Apexchart js-->
    <script src="{{ asset('/') }}admin/assets/js/vendors/apexcharts/dist/apexcharts.min.js"></script>
    <!-- Chart js-->
    <script src="{{ asset('/') }}admin/assets/js/vendors/chart.js/dist/chart.umd.js"></script>
    <!-- Datatable js-->
    <script src="{{ asset('/') }}admin/assets/js/vendors/simple-datatables/dist/umd/simple-datatables.js"></script>
    <!-- default dashboard js-->
    <script src="{{ asset('/') }}admin/assets/js/dashboard/default.js"></script>
     <!-- Height-equal js-->
     <script src="{{ asset('/') }}admin/assets/js/height-equal.js"></script>
     <!-- scrollbar js-->
     <script src="{{ asset('/') }}admin/assets/js/scrollbar/simplebar.js"></script>
     <script src="{{ asset('/') }}admin/assets/js/scrollbar/custom.js"></script>
     <!-- scrollable-->
     <script src="{{ asset('/') }}admin/assets/js/vendors/swiper/swiper-bundle.min.js"></script>
     <script src="{{ asset('/') }}admin/assets/js/product/custom-swiper.js"></script>
    <!-- scrollable-->
    <!-- customizer-->
    {{-- <script src="{{ asset('/') }}admin/assets/js/theme-customizer/customizer.js"></script> --}}
    <!-- custom script -->
    <script src="{{ asset('/') }}admin/assets/js/script.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

    <script src="{{ asset('/') }}/admin/assets/js/vendors/flatpickr/dist/flatpickr.min.js"></script>
    <script src="{{ asset('/') }}admin/assets/js/custom-flatpickr.js"></script>
    
    @yield('scripts')
  </body>

<!-- Mirrored from admin.pixelstrap.net/edmin/template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 21 Sep 2024 14:15:02 GMT -->
</html>