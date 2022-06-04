<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>MBC - Maiwa Breeding Center</title>
    <!-- Favicon-->
    {{-- <link rel="icon" type="image/x-icon" href="assets/favicon.ico" /> --}}
    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
        rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('assets/home/styles.css?k=' . time()) }}" rel="stylesheet" />
    {{-- <link href="{{ asset('assets/plugins/morriscopy/morris.css') }}" rel=" stylesheet" /> --}}

    <link rel="icon" href="{{ URL::asset('assets/images/brand/mbc2.png') }}" type="image/x-icon" />
    <!---Icons css-->
    <link href="{{ URL::asset('assets/css/icons.css') }}" rel="stylesheet" />
    <!--Bootstrap css -->
    {{-- <link href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css?k=' . time()) }}" rel="stylesheet"> --}}
    <!-- Style css -->
    <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/dark.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/skin-modes.css') }}" rel="stylesheet" />



    @livewireStyles

</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#page-top">
                <img src="{{ URL::asset('assets/images/brand/mbc2.png') }}" height="30">
                MBC </a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse bg-transparent" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="#services">Services</a></li> --}}
                    <li class="nav-item"><a class="nav-link" href="#portfolio">News</a></li>
                    <li class="nav-item"><a class="nav-link" href="#statistics">Statistics</a></li>
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>

                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('home','0') }}">Home</a></li>

                    @endguest
                </ul>
            </div>


        </div>
    </nav>

    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">

            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    {{-- <h1 class="text-white font-weight-bold">MBC</h1> --}}

                </div>
                <div class="col-lg-8 align-self-baseline">
                    <h1 class="text-white font-weight-bold">Maiwa Breeding Center (MBC)</h1>

                    {{-- <p class="text-white-75 mb-5">Start Bootstrap can help you build better websites using the Bootstrap
                        framework! Just download a theme and start customizing, no strings attached!</p> --}}
                    {{-- <a class="btn btn-primary btn-xl" href="#about">Find Out More</a> --}}
                </div>
            </div>
        </div>
    </header>

    <!-- About-->
    <section class="page-section" id="about">
        <div class="container px-3 px-lg-4">
            <h2 class="text-center mt-0">About Us</h2>
            <hr class="divider" />
            <div class="ibox-content">
                <div class="row mb-3">
                    <div class="col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="bg-light text-center br-4">
                                    <div class="p-2">
                                        <img src="{{ URL::asset('assets/home/img/k1.jpeg') }}" alt="img"
                                            class="img-fluid w-100">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h3 class="mb-1">
                                    <a class="btn-link" href="#" class="text-navy"
                                        style="text-decoration: none">
                                        Maiwa Breeding Center (MBC)
                                    </a>
                                </h3>
                                <div class="mb-3">
                                    <a href="#"><i class="fa fa-star text-warning"></i></a>
                                    <a href="#"><i class="fa fa-star text-warning"></i></a>
                                    <a href="#"><i class="fa fa-star text-warning"></i></a>
                                    <a href="#"><i class="fa fa-star text-warning"></i></a>
                                    <a href="#"><i class="fa fa-star-o text-warning"></i></a>
                                    <span class="fs-16 ml-3">3.5 <small>(45 Reviews)</small></span>
                                </div>
                                <div>
                                    <h5>Description</h5>
                                    <p align="justify">Maiwa Breeding Center (MBC) Fakultas Peternakan Universitas
                                        Hasanuddin sebagai salah satu unit bisnis memperoleh kesempatan presentasi
                                        kegiatan dan programnya pada kegiatan Knowledge Sharing Seminar (KSS) yang
                                        diselenggarakan oleh Research Center for Biotechnology Indonesian Institute of
                                        Sciences (LIPI). Kegiatan tersebut berlangsung secara virtual melalui aplikasi
                                        zoom pada Selasa (25/05).</p>

                                    <p align="justify">Dr. Syahdar Baba, S.Pt., M.Si sebagai pengelola MBC Unhas
                                        menyampaikan bahwa kegiatan ini telah diinisiasi dalam kurun waktu yang panjang.
                                        Berbagai kegiatan yang mendahuluinya seperti IPTEKDA LIPI, riset yang memperoleh
                                        pembiayaan dari LPDP Kemenkeu, Meat and Milk Pro dalam menyediakan peralatan
                                        untuk riset dasar dan riset pengembangan di bidang peternakan.</p>

                                    <p align="justify">“Pengalaman membawa pada pemahaman bahwa riset dan pengabdian
                                        masyarakat hanya dapat berkelanjutan ketika proyek yang sifatnya cost center
                                        beralih menjadi profit center. Dengan demikian, perlu ada transformasi dari
                                        proyek yang didanai menjadi proyek yang didukung sepenuhnya oleh unit bisnis
                                        atau profit center,” kata Syahdar.</p>

                                    <p align="justify">Saat ini, MBC tengah berada di masa transisi, dimana sedang ada
                                        peralihan manajemen yang dikelola oleh dosen menjadi kegiatan bisnis yang
                                        dikelola oleh lembaga professional yaitu PT Hasanuddin Agrivisi Internusa.
                                        Keberhasilan proses transformasi, menentukan keberhasilan kegiatan pembibitan
                                        sapi di MBC Unhas.</p>

                                    <p align="justify">Peran Ristek/BRIN dalam memfasilitasi dan menjadikan MBC Unhas
                                        sebagai salah satu kegiatan Inovasi Perguruan Tinggi merupakan terobosan yang
                                        pada akhirnya bisa menjadikan MBC Unhas sebagai pusat kolaborasi nasional untuk
                                        pembibitan sapi yang teintegrasi dari hulu ke hilir dengan melibatkan sebanyak
                                        179 orang di tiga kabupaten yaitu Barru, Soppeng dan Enrekang.</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services-->
    {{-- <section class="page-section" id="services">
        <div class="container px-4 px-lg-5">
            <h2 class="text-center mt-0">At Your Service</h2>
            <hr class="divider" />
            <div class="row gx-4 gx-lg-5">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class="bi-gem fs-1 text-primary"></i></div>
                        <h3 class="h4 mb-2">Sturdy Themes</h3>
                        <p class="text-muted mb-0">Our themes are updated regularly to keep them bug free!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class="bi-laptop fs-1 text-primary"></i></div>
                        <h3 class="h4 mb-2">Up to Date</h3>
                        <p class="text-muted mb-0">All dependencies are kept current to keep things fresh.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class="bi-globe fs-1 text-primary"></i></div>
                        <h3 class="h4 mb-2">Ready to Publish</h3>
                        <p class="text-muted mb-0">You can use this design as is, or you can make changes!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class="bi-heart fs-1 text-primary"></i></div>
                        <h3 class="h4 mb-2">Made with Love</h3>
                        <p class="text-muted mb-0">Is it really open source if it's not made with love?</p>
                    </div>
                </div>
            </div>
            <hr class="divider" />
            <div class="row gx-4 gx-lg-5">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class="bi-gem fs-1 text-primary"></i></div>
                        <h3 class="h4 mb-2">Sturdy Themes</h3>
                        <p class="text-muted mb-0">Our themes are updated regularly to keep them bug free!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class="bi-laptop fs-1 text-primary"></i></div>
                        <h3 class="h4 mb-2">Up to Date</h3>
                        <p class="text-muted mb-0">All dependencies are kept current to keep things fresh.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class="bi-globe fs-1 text-primary"></i></div>
                        <h3 class="h4 mb-2">Ready to Publish</h3>
                        <p class="text-muted mb-0">You can use this design as is, or you can make changes!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class="bi-heart fs-1 text-primary"></i></div>
                        <h3 class="h4 mb-2">Made with Love</h3>
                        <p class="text-muted mb-0">Is it really open source if it's not made with love?</p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Portfolio-->
    <section class="page-section" id="portfolio">
        <div class="container p-3 mb-3 mt-3">
            <h2 class="text-center mt-0">Our News</h2>
            <hr class="divider" />


            <div class="row">
                <a href="{{ route('posts.userPostAll') }}" class=" text-right float-right">
                    <h4>Lihat Selengkapnya <i class="fe fe-chevron-right"></i></h4>
                </a>
                @foreach ($datas as $item)
                    <div class="col-md-6 col-xl-4">
                        <div class="card overflow-hidden">
                            <a href="{{ url('/' . ($page = '#')) }}"><img class="card-img-top "
                                    src="{{ url('storage/photos_thumb/' . $item->images) }}" alt="img"
                                    height="250px"></a>
                            <div class="card-body d-flex flex-column">
                                <h4><a class="btn-link" href="{{ route('posts.userPostDetail', $item) }}"
                                        style="text-decoration: none">{{ $item->title }}</a></h4>
                                <div class="text-muted">{!! Str::limit(strip_tags($item->detail), 80) !!}</div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- Statistics-->
    <section class="page-section" id="statistics">
        <div class="container px-4 px-lg-5">
            <h2 class="text-center mt-0">Statistics</h2>
            <hr class="divider" />
            @livewire('wirewelcome')

        </div>
    </section>

    <!-- Footer-->
    @include('layouts.footer')

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('assets/home/scripts.js') }}"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/morriscopy/morris.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/morriscopy/raphael-min.js') }}"></script> --}}


    <!-- Bootstrap4 js-->
    <script src="{{ URL::asset('assets/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!--INTERNAL Peitychart js-->
    <script src="{{ URL::asset('assets/plugins/peitychart/jquery.peity.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/peitychart/peitychart.init.js') }}"></script>

    <!--INTERNAL Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>

    <!--INTERNAL ECharts js-->
    <script src="{{ URL::asset('assets/plugins/echarts/echarts.js') }}"></script>

    <!--INTERNAL Chart js -->
    <script src="{{ URL::asset('assets/plugins/chart/chart.bundle.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/chart/utils.js') }}"></script>

    <!-- INTERNAL Select2 js -->
    <script src="{{ URL::asset('assets/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>

    <!--INTERNAL Moment js-->
    <script src="{{ URL::asset('assets/plugins/moment/moment.js') }}"></script>

    <!--INTERNAL Index js-->
    <script src="{{ URL::asset('assets/js/index1.js') }}"></script>

    {{-- @include('home.cart1') --}}

    @stack('script')

    @livewireScripts

    <script>
        $(document).ready(function() {

            $('.year').click(function() {

                var year = $(this).attr('data-id');

                // alert(data);

                window.location = "/#statistics/" + year;



            });


        });
    </script>

</body>

</html>
