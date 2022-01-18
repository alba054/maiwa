<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="Admitro - Admin Panel HTML template" name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="keywords"
        content="admin panel ui, user dashboard template, web application templates, premium admin templates, html css admin templates, premium admin templates, best admin template bootstrap 4, dark admin template, bootstrap 4 template admin, responsive admin template, bootstrap panel template, bootstrap simple dashboard, html web app template, bootstrap report template, modern admin template, nice admin template" />

    <!-- Title -->
    <title>MBC - Maiwa Breeding Center</title>

    <!--Favicon -->
    {{-- <link rel="icon" href="assets/images/brand/favicon.ico" type="image/x-icon" /> --}}

    {{-- @include('layouts.head') --}}
    <!--Bootstrap css -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Style css -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/skin-modes.css') }}" rel="stylesheet" />

    <!-- Animate css -->
    <link href="{{ asset('assets/css/animated.css') }}" rel="stylesheet" />

    <!-- P-scroll bar css-->
    <link href="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet" />

    <!---Icons css-->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" />

    <!-- Color Skin css -->
    <link id="theme" href="{{ asset('assets/colors/color1.css') }}" rel="stylesheet" type="text/css" />


</head>

<body class="app main-body">

    <!---Global-loader-->
    <div id="global-loader">
        <img src="{{ asset('assets/images/svgs/loader.svg') }}" alt="loader">
    </div>
    <!--- End Global-loader-->

    <!-- Page -->
    <div class="page">
        <div class="page-main">
            <!--header-->
            <div class="hor-header header top-header">
                <div class="container">
                    <div class="d-flex">
                        <a class="animated-arrow hor-toggle horizontal-navtoggle"><span></span></a>
                        <a class="header-brand" href="{{ url('/') }}">
                            <img src="{{ URL::asset('assets/images/brand/mbc.png') }}"
                                class="header-brand-img desktop-lgo" alt=" logo">
                            <img src="{{ URL::asset('assets/images/brand/mb1.png') }}"
                                class="header-brand-img dark-logo" alt=" logo">
                            <img src="{{ URL::asset('assets/images/brand/mbc2.png') }}"
                                class="header-brand-img mobile-logo" alt=" logo">
                            <img src="{{ URL::asset('assets/images/brand/mbc2.png') }}"
                                class="header-brand-img darkmobile-logo" alt="logo">
                        </a>

                    </div>
                </div>
            </div>
            <!--/header-->

            <!-- Hor-Content -->
            <div class="hor-content main-content">
                <div class="container">

                    <!--Page header-->
                    <div class="page-header">

                    </div>
                    <!--End Page header-->

                    <!-- Row -->
                    <div class="row">
                        <div class="col-md-12 wrapper wrapper-content">
                            <div class="ibox card">
                                <div class="card-body">
                                    <div class="ibox-content">
                                        <div class="row mb-3">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="bg-light text-center br-4">
                                                            <div class="p-2">

                                                                <img src="{{ url('storage/photos_thumb/' . $post->images) }}"
                                                                    alt="img" class="img-fluid w-100">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-8">
                                                        <h3 class="mb-1">
                                                            <a href="#" class="text-navy">
                                                                {{ $post->title }}
                                                            </a>
                                                        </h3>
                                                        <div class="item7-card-desc d-md-flex mb-5">
                                                            <a href="{{ url('/' . ($page = '#')) }}"
                                                                class="d-flex mr-4 mb-2"><i
                                                                    class="fe fe-calendar fs-16 mr-1"></i>
                                                                <div class="mt-0">
                                                                    {{ $post->created_at->format('Y-m-d') }}</div>
                                                            </a>
                                                            <a href="{{ url('/' . ($page = '#')) }}"
                                                                class="d-flex mb-2"><i
                                                                    class="fe fe-user fs-16 mr-1"></i>
                                                                <div class="mt-0">Admin</div>
                                                            </a>


                                                        </div>

                                                        <div>
                                                            <h5>Description</h5>
                                                            {!! $post->detail !!}
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- End Row -->

                </div>
            </div><!-- End hor-content-->

        </div>

        @include('layouts.footer')


        {{-- @include('layouts.footer-scripts') --}}


    </div>
    <!-- End Page -->

    <!-- Back to top -->
    <a href="#top" id="back-to-top"><i class="fe fe-chevrons-up"></i></a>

    <!-- Jquery js-->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>

    <!-- Bootstrap4 js-->
    <script src="{{ asset('assets/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!--Othercharts js-->
    <script src="{{ asset('assets/plugins/othercharts/jquery.sparkline.min.js') }}"></script>

    <!-- Circle-progress js-->
    <script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>

    <!-- Jquery-rating js-->
    <script src="{{ asset('assets/plugins/rating/jquery.rating-stars.js') }}"></script>

    <!--Horizontal-menu js-->
    <script src="{{ asset('assets/plugins/horizontal-menu/horizontal-menu.js') }}"></script>

    <!-- Sticky js-->
    <script src="{{ asset('assets/js/stiky.js') }}"></script>

    <!-- P-scroll js-->
    <script src="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/plugins/p-scrollbar/p-scroll.js') }}"></script>

    <!-- Custom js-->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

</body>

</html>
