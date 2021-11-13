    <!--/Horizontal-main -->
    <div class="sticky">
        <div class="horizontal-main hor-menu clearfix">
            <div class="horizontal-mainwrapper container clearfix">
                <!--Nav-->
                <nav class="horizontalMenu clearfix">
                    <ul class="horizontalMenu-list">
                        <li aria-haspopup="true">
                            <a href="{{ url('/') }}" class="sub-icon">
                                <svg class="hor-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                                    width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M19 5v2h-4V5h4M9 5v6H5V5h4m10 8v6h-4v-6h4M9 17v2H5v-2h4M21 3h-8v6h8V3zM11 3H3v10h8V3zm10 8h-8v10h8V11zm-10 4H3v6h8v-6z" />
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li aria-haspopup="true">
                            <a href="{{ URL('/' . ($page = '#')) }}" class="">
                                <svg class="hor-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                                    width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M16.66 4.52l2.83 2.83-2.83 2.83-2.83-2.83 2.83-2.83M9 5v4H5V5h4m10 10v4h-4v-4h4M9 15v4H5v-4h4m7.66-13.31L11 7.34 16.66 13l5.66-5.66-5.66-5.65zM11 3H3v8h8V3zm10 10h-8v8h8v-8zm-10 0H3v8h8v-8z" />
                                </svg>
                                Users <i class="fa fa-angle-down horizontal-icon"></i>
                            </a>
                            <ul class="sub-menu">
                                <li aria-haspopup="true"><a href="{{ url('/users/1') }}">
                                        Data
                                        Admin</a>
                                </li>
                                <li aria-haspopup="true"><a href="{{ url('/users/2') }}"> Data
                                        Pendamping</a>
                                </li>
                                <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'peternak')) }}"> Data
                                        Peternak</a>
                                </li>
                            </ul>
                        </li>

                        <li aria-haspopup="true">
                            <a href="{{ url('/' . ($page = '#')) }}" class="sub-icon">
                                <svg class="hor-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                                    width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z" />
                                </svg>
                                Data Master <i class="fa fa-angle-down horizontal-icon"></i>
                            </a>
                            <ul class="sub-menu">
                                {{-- <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'ternak')) }}"> Form
                                        Ternak</a></li> --}}
                                <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'jenis-sapi')) }}">Form
                                        Jenis Sapi</a></li>
                                <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'sapi')) }}">Form
                                        Sapi</a>
                                </li>
                                <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'status-sapi')) }}">Form
                                        Status Sapi</a>
                                </li>
                                <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'strow')) }}">Form
                                        Strow</a>
                                </li>
                            </ul>
                        </li>
                        <li aria-haspopup="true">
                            <a href="{{ url('/' . ($page = '#')) }}" class="sub-icon">
                                <svg class="hor-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                                    width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M11.99 18.54l-7.37-5.73L3 14.07l9 7 9-7-1.63-1.27zM12 16l7.36-5.73L21 9l-9-7-9 7 1.63 1.27L12 16zm0-11.47L17.74 9 12 13.47 6.26 9 12 4.53z" />
                                </svg>
                                Data Monitoring <i class="fa fa-angle-down horizontal-icon"></i>
                            </a>
                            <ul class="sub-menu">
                                <li aria-haspopup="true"><a
                                        href="{{ url('/' . ($page = 'monitoring-periksa-kebuntingan')) }}">
                                        Periksa
                                        Kebuntingan</a></li>
                                <li aria-haspopup="true"><a
                                        href="{{ url('/' . ($page = 'monitoring-performa')) }}">Performa</a>
                                </li>
                                <li aria-haspopup="true"><a
                                        href="{{ url('/' . ($page = 'monitoring-insiminasi-buatan')) }}">Insiminasi
                                        Buatan</a>
                                </li>
                                <li aria-haspopup="true"><a
                                        href="{{ url('/' . ($page = 'monitoring-perlakuan')) }}">Perlakuan</a>
                                </li>
                            </ul>
                        </li>
                        <li aria-haspopup="true">
                            <a href="{{ url('/' . ($page = '#')) }}" class="sub-icon">
                                <svg class="hor-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                                    width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M11.99 18.54l-7.37-5.73L3 14.07l9 7 9-7-1.63-1.27zM12 16l7.36-5.73L21 9l-9-7-9 7 1.63 1.27L12 16zm0-11.47L17.74 9 12 13.47 6.26 9 12 4.53z" />
                                </svg>
                                Notifikasi <i class="fa fa-angle-down horizontal-icon"></i>
                            </a>
                            <ul class="sub-menu">

                                <li aria-haspopup="true"><a
                                        href="{{ url('/' . ($page = 'notifikasi-generate')) }}">Generate
                                        Notifikasi</a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </nav>
                <!--Nav-->
            </div>
        </div>
    </div>
    <!--/Horizontal-main -->
