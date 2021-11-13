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
    <link href="{{ asset('assets/plugins/morriscopy/morris.css') }}" rel=" stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#page-top">
                <img src="{{ URL::asset('assets/images/brand/mbc2.png') }}" height="30">
                MBC </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portfolio">News</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Statistics</a></li>
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>

                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>

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
                    <h1 class="text-white font-weight-bold">Maiwa Breeding Center (MBC)</h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    {{-- <p class="text-white-75 mb-5">Start Bootstrap can help you build better websites using the Bootstrap
                        framework! Just download a theme and start customizing, no strings attached!</p> --}}
                    <a class="btn btn-primary btn-xl" href="#about">Find Out More</a>
                </div>
            </div>
        </div>
    </header>
    <!-- About-->
    <section class="page-section" id="about">
        <div class="container-fluid px-3 px-lg-4">
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
    <section class="page-section" id="services">
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
    </section>
    <!-- Portfolio-->
    <section class="page-section" id="portfolio">
        <div class="container p-3 mb-3 mt-3">
            <h2 class="text-center mt-0">Our News</h2>
            <hr class="divider" />
            <div class="row">
                @foreach ($datas as $item)
                    <div class="col-md-6 col-xl-4">
                        <div class="card overflow-hidden">
                            <a href="{{ url('/' . ($page = '#')) }}"><img class="card-img-top "
                                    src="{{ url('storage/photos_thumb/' . $item->images) }}" alt="img"
                                    height="250px"></a>
                            <div class="card-body d-flex flex-column">
                                <h4><a class="btn-link" href="{{ url('/' . ($page = '#')) }}"
                                        style="text-decoration: none">{{ $item->title }}</a></h4>
                                <div class="text-muted">{!! Str::limit(strip_tags($item->detail), 150) !!}</div>
                                <a href="" class="mt-3 btn btn-lg btn-primary">Read more</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- Contact-->
    <section class="page-section" id="contact">
        <div class="container px-4 px-lg-5">
            <h2 class="text-center mt-0">Statistics</h2>
            <hr class="divider" />
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Data Kelahiran Sapi</div>
                        </div>
                        <div class="card-body">
                            <div class="morris-wrapper-demo" id="morrisLine1"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Persentase Kelahiran</div>
                        </div>
                        <div class="card-body">
                            <div class="morris-wrapper-demo" id="morrisBar1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="bg-light py-5">
        <div class="container px-4 px-lg-5">
            <div class="small text-center text-muted">Copyright &copy; 2021 - MBC</div>
        </div>
    </footer>
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
    <script src="{{ asset('assets/plugins/morriscopy/morris.js') }}"></script>
    <script src="{{ asset('assets/plugins/morriscopy/raphael-min.js') }}"></script>

    <script>
        $(function() {
            'use strict';
            var morrisData = [{
                y: '2019',
                a: 30.66,
                b: 0.33
            }, {
                y: '2020',
                a: 48.82,
                b: 0.50
            }, {
                y: '2021',
                a: 33.33,
                b: 0.15
            }];
            var morrisData2 = [{
                y: 'Jan',
                a: 18,
                b: 18,
                c: 1
            }, {
                y: 'Feb',
                a: 23,
                b: 22,
                c: 2
            }, {
                y: 'Mar',
                a: 19,
                b: 18,
                c: 0
            }, {
                y: 'Apr',
                a: 28,
                b: 28,
                c: 3
            }, {
                y: 'Mei',
                a: 33,
                b: 35,
                c: 0
            }, {
                y: 'Jun',
                a: 28,
                b: 28,
                c: 1
            }, {
                y: 'Jul',
                a: 18,
                b: 18,
                c: 0
            }];
            new Morris.Line({
                element: 'morrisLine1',
                data: morrisData2,
                xkey: 'y',
                ykeys: ['a', 'b', 'c'],
                labels: ['Data Kebuntingan', 'Data Kelahiran', 'Data Kematian'],
                lineColors: ['#705ec8', '#7ACB79', '#BC4739'],

                parseTime: false,
                lineWidth: 1,
                ymax: 'auto 50',
                gridTextSize: 11,
                hideHover: 'auto',
                resize: true
            });
            new Morris.Bar({
                element: 'morrisBar1',
                data: morrisData,
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Data Kelahiran', 'Data Kematian'],
                barColors: ['#7ACB79', '#BC4739'],
                gridTextSize: 11,
                hideHover: 'auto',
                units: '%',
                resize: true
            });
            new Morris.Area({
                element: 'morrisArea1',
                data: [{
                    y: '2006',
                    a: 30,
                    b: 18
                }, {
                    y: '2007',
                    a: 18,
                    b: 22
                }, {
                    y: '2008',
                    a: 15,
                    b: 18
                }, {
                    y: '2009',
                    a: 25,
                    b: 28
                }, {
                    y: '2010',
                    a: 30,
                    b: 35
                }, {
                    y: '2011',
                    a: 18,
                    b: 28
                }, {
                    y: '2012',
                    a: 12,
                    b: 18
                }],
                xkey: 'moon',
                ykeys: ['a', 'b'],
                labels: ['Series A', 'Series B'],
                lineColors: ['#705ec8', '#fb1c52'],
                lineWidth: 1,
                fillOpacity: 0.9,
                gridTextSize: 11,
                hideHover: 'auto',
                resize: true,
                ymax: 'auto 100',
            });


            var nReloads = 0;

            function data(offset) {
                var ret = [];
                for (var x = 0; x <= 360; x += 10) {
                    var v = (offset + x) % 360;
                    ret.push({
                        x: x,
                        y: Math.sin(Math.PI * v / 180).toFixed(4),
                        z: Math.cos(Math.PI * v / 180).toFixed(4)
                    });
                }
                return ret;
            }

            /*---- morrisBar6----*/
            var graph = Morris.Line({
                element: 'morrisBar6',
                data: data(0),
                xkey: 'x',
                ykeys: ['y', 'z'],
                labels: ['data1', 'data2'],
                lineColors: ['#705ec8', '#fb1c52'],
                parseTime: false,
                ymin: -1.0,
                ymax: 1.0,
                hideHover: true
            });

            function update() {
                nReloads++;
                graph.setData(data(5 * nReloads));
                $('#reloadStatus').text(nReloads + ' reloads');
            }
            setInterval(update, 100);

            /*---- morrisBar7----*/
            var day_data = [{
                    "period": "2012-10-01",
                    "licensed": 3407,
                    "sorned": 660
                },
                {
                    "period": "2012-09-30",
                    "licensed": 3351,
                    "sorned": 629
                },
                {
                    "period": "2012-09-29",
                    "licensed": 3269,
                    "sorned": 618
                },
                {
                    "period": "2012-09-20",
                    "licensed": 3246,
                    "sorned": 661
                },
                {
                    "period": "2012-09-19",
                    "licensed": 3257,
                    "sorned": 667
                },
                {
                    "period": "2012-09-18",
                    "licensed": 3248,
                    "sorned": 627
                },
                {
                    "period": "2012-09-17",
                    "licensed": 3171,
                    "sorned": 660
                },
                {
                    "period": "2012-09-16",
                    "licensed": 3171,
                    "sorned": 676
                },
                {
                    "period": "2012-09-15",
                    "licensed": 3201,
                    "sorned": 656
                },
                {
                    "period": "2012-09-10",
                    "licensed": 3215,
                    "sorned": 622
                }
            ];
            new Morris.Line({
                element: 'morrisBar7',

                data: day_data,
                xkey: 'period',
                ykeys: ['licensed', 'sorned'],
                labels: ['Licensed', 'SORN'],
                lineColors: ['#705ec8', '#fb1c52'],
            });

            new Morris.Donut({
                element: 'morrisDonut1',
                data: [{
                    label: 'Google',
                    value: 42
                }, {
                    label: 'Firefox',
                    value: 32
                }, {
                    label: 'IE',
                    value: 26
                }],
                colors: ['#fb1c52', '#705ec8', '#2dce89'],
                storke: ['#fb1c52', '#705ec8', '#2dce89'],
                resize: true,
                backgroundColor: 'rgba(119, 119, 142, 0.2)',
                labelColor: '#8e9cad',
            });
        });
    </script>

</body>

</html>
