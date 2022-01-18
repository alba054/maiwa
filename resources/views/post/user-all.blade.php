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

                    <!-- Row -->
                    <div class="row mt-3">
                        @foreach ($datas as $item)
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="card overflow-hidden">
                                    <div class="item7-card-img">
                                        <a href="#"></a>
                                        <img src="{{ url('storage/photos_thumb/' . $item->images) }}" alt="img"
                                            class="cover-image w-100">
                                    </div>
                                    <div class="card-body">
                                        <div class="item7-card-desc d-flex mb-5">
                                            <a href="#" class="d-flex"><i class="fe fe-calendar fs-16 mr-1"></i>
                                                {{ $item->created_at->format('Y-m-d') }}</a>

                                        </div>
                                        <a href="{{ route('posts.userPostDetail', $item) }}" class="mt-4">
                                            <h5 class="font-weight-semibold">{{ $item->title }}</h5>
                                        </a>
                                        <p>{!! Str::limit(strip_tags($item->detail), 120) !!}</p>
                                    </div>

                                </div>
                            </div>
                        @endforeach


                    </div>
                    <!--End Row-->
                </div>
            </div><!-- End hor-content-->

            @include('layouts.footer')

        </div>

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
