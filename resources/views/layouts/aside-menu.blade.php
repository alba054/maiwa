    <aside class="app-sidebar" style="overflow:scroll !important">
        <div class="app-sidebar__logo">
            <a class="header-brand" href="{{ url('/') }}">
                <img src="{{ URL::asset('assets/images/brand/mbc.png') }}" class="header-brand-img desktop-lgo"
                    alt=" logo">
                <img src="{{ URL::asset('assets/images/brand/mb1.png') }}" class="header-brand-img dark-logo"
                    alt=" logo">
                <img src="{{ URL::asset('assets/images/brand/mbc2.png') }}" class="header-brand-img mobile-logo"
                    alt=" logo">
                <img src="{{ URL::asset('assets/images/brand/mbc2.png') }}" class="header-brand-img darkmobile-logo"
                    alt="logo">
            </a>
        </div>
        <div class="app-sidebar__user">
            <div class="dropdown user-pro-body text-center">
                <div class="user-pic">
                    <img src="{{ URL::asset('assets/images/users/2.jpg') }}" alt="user-img"
                        class="avatar-xl rounded-circle mb-1">
                </div>
                <div class="user-info">
                    <h5 class=" mb-1"> {{ auth()->user()->name }} <i
                            class="ion-checkmark-circled  text-success fs-12"></i></h5>
                    <span
                        class="text-muted app-sidebar__user-name text-sm">{{ auth()->user()->hak_akses == '1'? (auth()->user()->hak_akses == '1'? 'Admin': 'TSR'): (auth()->user()->hak_akses == '2'? 'TSR': 'Pendamping') }}</span>
                </div>
            </div>
            <div class="sidebar-navs">
                <ul class="nav nav-pills-circle">
                    <li class="nav-item" data-placement="top" data-toggle="tooltip" title="Support">
                        <a class="icon" href="{{ url('/' . ($page = '#')) }}">
                            <i class="las la-life-ring header-icons"></i>
                        </a>
                    </li>
                    <li class="nav-item" data-placement="top" data-toggle="tooltip" title="Documentation">
                        <a class="icon" href="{{ url('/' . ($page = '#')) }}">
                            <i class="las  la-file-alt header-icons"></i>
                        </a>
                    </li>
                    <li class="nav-item" data-placement="top" data-toggle="tooltip" title="Projects">
                        <a href="{{ url('/' . ($page = '#')) }}" class="icon">
                            <i class="las la-project-diagram header-icons"></i>
                        </a>
                    </li>
                    <li class="nav-item" data-placement="top" data-toggle="tooltip" title="Settins">
                        <a class="icon" href="{{ url('/' . ($page = '#')) }}">
                            <i class="las la-cog header-icons"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="side-menu app-sidebar3">
            <li class="side-item side-item-category mt-4">Main</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/home/0') }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M19 5v2h-4V5h4M9 5v6H5V5h4m10 8v6h-4v-6h4M9 17v2H5v-2h4M21 3h-8v6h8V3zM11 3H3v10h8V3zm10 8h-8v10h8V11zm-10 4H3v6h8v-6z" />
                    </svg>
                    <span class="side-menu__label">Dashboard</span></a>
            </li>
            <li class="side-item side-item-category">Tabel Master</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/pages/' . ($page = '#')) }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z" />
                    </svg>
                    <span class="side-menu__label"> Data Daerah </span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu ">
                    <li><a href="{{ url('/pages/' . ($page = 'kabupaten')) }}" class="slide-item"> Data Kabupaten
                        </a></li>
                    <li><a href="{{ url('/pages/' . ($page = 'kecamatan')) }}" class="slide-item"> Data Kecamatan
                        </a></li>
                    <li><a href="{{ url('/pages/' . ($page = 'desa')) }}" class="slide-item"> Data Desa </a></li>
                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/pages/' . ($page = '#')) }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M14.25 2.26l-.08-.04-.01.02C13.46 2.09 12.74 2 12 2 6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10c0-4.75-3.31-8.72-7.75-9.74zM19.41 9h-7.99l2.71-4.7c2.4.66 4.35 2.42 5.28 4.7zM13.1 4.08L10.27 9l-1.15 2L6.4 6.3C7.84 4.88 9.82 4 12 4c.37 0 .74.03 1.1.08zM5.7 7.09L8.54 12l1.15 2H4.26C4.1 13.36 4 12.69 4 12c0-1.85.64-3.55 1.7-4.91zM4.59 15h7.98l-2.71 4.7c-2.4-.67-4.34-2.42-5.27-4.7zm6.31 4.91L14.89 13l2.72 4.7C16.16 19.12 14.18 20 12 20c-.38 0-.74-.04-1.1-.09zm7.4-3l-4-6.91h5.43c.17.64.27 1.31.27 2 0 1.85-.64 3.55-1.7 4.91z" />
                    </svg>
                    <span class="side-menu__label"> Users </span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu ">
                    <li><a href="{{ url('/users/1') }}" class="slide-item"> Admin </a></li>
                    <li><a href="{{ url('/users/2') }}" class="slide-item"> TSR </a></li>
                    <li><a href="{{ url('/users/3') }}" class="slide-item"> Pendamping </a></li>
                    <li><a href="{{ url('/users/4') }}" class="slide-item"> Dokter </a></li>

                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/pages/' . ($page = '#')) }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M19 5v2h-4V5h4M9 5v6H5V5h4m10 8v6h-4v-6h4M9 17v2H5v-2h4M21 3h-8v6h8V3zM11 3H3v10h8V3zm10 8h-8v10h8V11zm-10 4H3v6h8v-6z" />
                    </svg>
                    <span class="side-menu__label"> Peternak & Kinerja </span><i
                        class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu ">
                    <li><a href="{{ url('/pages/' . ($page = 'kelompok')) }}" class="slide-item"> Data Kelompok
                        </a></li>
                    <li><a href="{{ url('/pages/' . ($page = 'peternak')) }}" class="slide-item"> Data Peternak
                        </a></li>
                    <li><a href="{{ url('/pages/' . ($page = 'upah')) }}" class="slide-item"> Data Kinerja
                        </a></li>

                </ul>
            </li>



            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/pages/' . ($page = '#')) }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M19 15v4H5v-4h14m1-2H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h16c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1zM7 18.5c-.82 0-1.5-.67-1.5-1.5s.68-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM19 5v4H5V5h14m1-2H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h16c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1zM7 8.5c-.82 0-1.5-.67-1.5-1.5S6.18 5.5 7 5.5s1.5.68 1.5 1.5S7.83 8.5 7 8.5z" />
                    </svg>
                    <span class="side-menu__label">Master PKB</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu ">
                    <li><a href="{{ url('/pages/' . ($page = 'metode')) }}" class="slide-item"> Metode </a></li>
                    <li><a href="{{ url('/pages/' . ($page = 'hasil')) }}" class="slide-item"> Hasil </a></li>
                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/pages/' . ($page = '#')) }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M17.73 12.02l3.98-3.98c.39-.39.39-1.02 0-1.41l-4.34-4.34c-.39-.39-1.02-.39-1.41 0l-3.98 3.98L8 2.29C7.8 2.1 7.55 2 7.29 2c-.25 0-.51.1-.7.29L2.25 6.63c-.39.39-.39 1.02 0 1.41l3.98 3.98L2.25 16c-.39.39-.39 1.02 0 1.41l4.34 4.34c.39.39 1.02.39 1.41 0l3.98-3.98 3.98 3.98c.2.2.45.29.71.29.26 0 .51-.1.71-.29l4.34-4.34c.39-.39.39-1.02 0-1.41l-3.99-3.98zM12 9c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm-4.71 1.96L3.66 7.34l3.63-3.63 3.62 3.62-3.62 3.63zM10 13c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm2 2c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm2-4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2.66 9.34l-3.63-3.62 3.63-3.63 3.62 3.62-3.62 3.63z" />
                    </svg>
                    <span class="side-menu__label">Master Perlakuan</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu ">
                    <li><a href="{{ url('/pages/' . ($page = 'obat')) }}" class="slide-item"> Obat </a></li>
                    <li><a href="{{ url('/pages/' . ($page = 'vitamin')) }}" class="slide-item"> Vitamin </a>
                    </li>
                    <li><a href="{{ url('/pages/' . ($page = 'vaksin')) }}" class="slide-item"> Vaksin </a></li>
                    <li><a href="{{ url('/pages/' . ($page = 'hormon')) }}" class="slide-item"> Hormon </a></li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
                    </svg>
                    <span class="side-menu__label">Master Sapi</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu ">
                    <li><a href="{{ url('/pages/' . ($page = 'jenis-sapi')) }}" class="slide-item"> Jenis Sapi
                        </a>
                    </li>
                    <li><a href="{{ url('/pages/' . ($page = 'status-sapi')) }}" class="slide-item"> Status Sapi
                        </a>
                    </li>
                    <li><a href="{{ url('/pages/' . ($page = 'sapi')) }}" class="slide-item"> Sapi </a>
                    </li>
                    <li><a href="{{ url('/pages/' . ($page = 'strow')) }}" class="slide-item"> Straw </a>
                    </li>

                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M20 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h15c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 2v3H5V5h15zm-5 14h-5v-9h5v9zM5 10h3v9H5v-9zm12 9v-9h3v9h-3z" />
                    </svg>
                    <span class="side-menu__label">Table Relasi</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li><a href="{{ url('/pages/' . ($page = 'tsr-pendamping')) }}" class="slide-item"> TSR -
                            Pendamping</a></li>
                    <li><a href="{{ url('/pages/' . ($page = 'pendamping-peternak')) }}" class="slide-item">
                            Pendamping - Peternak</a></li>
                    <li><a href="{{ url('/pages/' . ($page = 'peternak-sapi')) }}" class="slide-item">
                            Peternak - Sapi</a></li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="{{ url('/pages/' . ($page = 'notifikasi')) }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z" />
                    </svg>
                    <span class="side-menu__label">Data Notifikasi</span>
                </a>
            </li>
            <li class="side-item side-item-category">Monitoring</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/pages/' . ($page = 'monitoring-periksa-kebuntingan')) }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M11.99 18.54l-7.37-5.73L3 14.07l9 7 9-7-1.63-1.27zM12 16l7.36-5.73L21 9l-9-7-9 7 1.63 1.27L12 16zm0-11.47L17.74 9 12 13.47 6.26 9 12 4.53z" />
                    </svg>
                    <span class="side-menu__label">Periksa Kebuntingan</span>
                </a>
                <a class="side-menu__item" href="{{ url('/pages/' . ($page = 'monitoring-performa')) }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M11.99 18.54l-7.37-5.73L3 14.07l9 7 9-7-1.63-1.27zM12 16l7.36-5.73L21 9l-9-7-9 7 1.63 1.27L12 16zm0-11.47L17.74 9 12 13.47 6.26 9 12 4.53z" />
                    </svg>
                    <span class="side-menu__label">Performa (Recording)</span>
                </a>
                <a class="side-menu__item" href="{{ url('/pages/' . ($page = 'monitoring-insiminasi-buatan')) }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M11.99 18.54l-7.37-5.73L3 14.07l9 7 9-7-1.63-1.27zM12 16l7.36-5.73L21 9l-9-7-9 7 1.63 1.27L12 16zm0-11.47L17.74 9 12 13.47 6.26 9 12 4.53z" />
                    </svg>
                    <span class="side-menu__label">Insiminasi Buatan</span>
                </a>
                <a class="side-menu__item" href="{{ url('/pages/' . ($page = 'monitoring-perlakuan')) }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M11.99 18.54l-7.37-5.73L3 14.07l9 7 9-7-1.63-1.27zM12 16l7.36-5.73L21 9l-9-7-9 7 1.63 1.27L12 16zm0-11.47L17.74 9 12 13.47 6.26 9 12 4.53z" />
                    </svg>
                    <span class="side-menu__label">Perlakuan Kesehatan</span>
                </a>
                <a class="side-menu__item" href="{{ url('/pages/' . ($page = 'monitoring-panen')) }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M11.99 18.54l-7.37-5.73L3 14.07l9 7 9-7-1.63-1.27zM12 16l7.36-5.73L21 9l-9-7-9 7 1.63 1.27L12 16zm0-11.47L17.74 9 12 13.47 6.26 9 12 4.53z" />
                    </svg>
                    <span class="side-menu__label">Panen</span>
                </a>
                <a class="side-menu__item" href="{{ url('/pages/' . ($page = 'monitoring-mati')) }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M11.99 18.54l-7.37-5.73L3 14.07l9 7 9-7-1.63-1.27zM12 16l7.36-5.73L21 9l-9-7-9 7 1.63 1.27L12 16zm0-11.47L17.74 9 12 13.47 6.26 9 12 4.53z" />
                    </svg>
                    <span class="side-menu__label">Data Kematian</span>
                </a>
                <a class="side-menu__item" href="{{ url('/pages/' . ($page = 'monitoring-sakit')) }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M11.99 18.54l-7.37-5.73L3 14.07l9 7 9-7-1.63-1.27zM12 16l7.36-5.73L21 9l-9-7-9 7 1.63 1.27L12 16zm0-11.47L17.74 9 12 13.47 6.26 9 12 4.53z" />
                    </svg>
                    <span class="side-menu__label">Data Sakit</span>
                </a>
            </li>
            <hr>
            <li class="side-item side-item-category">Post</li>

            <li class="slide">
                <a class="side-menu__item" href="{{ url('/pages/' . ($page = 'tags')) }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M19 15v4H5v-4h14m1-2H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h16c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1zM7 18.5c-.82 0-1.5-.67-1.5-1.5s.68-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM19 5v4H5V5h14m1-2H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h16c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1zM7 8.5c-.82 0-1.5-.67-1.5-1.5S6.18 5.5 7 5.5s1.5.68 1.5 1.5S7.83 8.5 7 8.5z" />
                    </svg>
                    <span class="side-menu__label">Tags</span></a>
            </li>
            <li class="slide">
                <a class="side-menu__item" href="{{ route('posts.index') }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M19 5v2h-4V5h4M9 5v6H5V5h4m10 8v6h-4v-6h4M9 17v2H5v-2h4M21 3h-8v6h8V3zM11 3H3v10h8V3zm10 8h-8v10h8V11zm-10 4H3v6h8v-6z" />
                    </svg>
                    <span class="side-menu__label">Post</span>
                </a>

            </li>
            <li class="side-item side-item-category">Aplikasi</li>

            <li class="slide">
                <a class="side-menu__item" href="{{ url('download') }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
                    </svg>
                    <span class="side-menu__label">Apk versi 1.0.0</span></a>
            </li>

        </ul>
    </aside>
    <!--aside closed-->
