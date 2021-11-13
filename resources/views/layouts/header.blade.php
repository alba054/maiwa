<div class="app-header header">
    <div class="container-fluid">
        <div class="d-flex">
            <a class="header-brand" href="{{ url('/') }}">
                <img src="{{ URL::asset('assets/images/brand/logo.png') }}" class="header-brand-img desktop-lgo"
                    alt=" logo">
                <img src="{{ URL::asset('assets/images/brand/logo1.png') }}" class="header-brand-img dark-logo"
                    alt=" logo">
                <img src="{{ URL::asset('assets/images/brand/favicon.png') }}" class="header-brand-img mobile-logo"
                    alt=" logo">
                <img src="{{ URL::asset('assets/images/brand/favicon1.png') }}"
                    class="header-brand-img darkmobile-logo" alt=" logo">
            </a>
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="{{ url('/' . ($page = '#')) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-align-left header-icon mt-1">
                        <line x1="17" y1="10" x2="3" y2="10"></line>
                        <line x1="21" y1="6" x2="3" y2="6"></line>
                        <line x1="21" y1="14" x2="3" y2="14"></line>
                        <line x1="17" y1="18" x2="3" y2="18"></line>
                    </svg>
                </a>
            </div>

            <div class="mt-1">
                <form class="form-inline">
                    <div class="search-element">
                        <input type="search" class="form-control header-search" placeholder="Search…"
                            aria-label="Search" tabindex="1">
                        <button class="btn btn-primary-color" type="submit">
                            <svg class="header-icon search-icon" x="1008" y="1248" viewBox="0 0 24 24" height="100%"
                                width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path
                                    d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div><!-- SEARCH -->

            <!-- SEARCH -->
            <div class="d-flex order-lg-2 ml-auto">
                <a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch">
                    <svg class="header-icon search-icon" x="1008" y="1248" viewBox="0 0 24 24" height="100%"
                        width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                    </svg>
                </a>
                <div class="dropdown   header-fullscreen">
                    <a class="nav-link icon full-screen-link p-0" id="fullscreen-button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M10 4L8 4 8 8 4 8 4 10 10 10zM8 20L10 20 10 14 4 14 4 16 8 16zM20 14L14 14 14 20 16 20 16 16 20 16zM20 8L16 8 16 4 14 4 14 10 20 10z" />
                        </svg>
                    </a>
                </div>



                <div class="dropdown profile-dropdown">
                    <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                        <span>
                            <img src="{{ URL::asset('assets/images/users/2.jpg') }}" alt="img"
                                class="avatar avatar-md brround">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
                        <div class="text-center">
                            <a href="#"
                                class="dropdown-item text-center user pb-0 font-weight-bold">{{ auth()->user()->name }}</a>
                            <span
                                class="text-center user-semi-title">{{ auth()->user()->hak_akses == '1' ? (auth()->user()->hak_akses == '1' ? 'Admin' : 'TSR') : (auth()->user()->hak_akses == '2' ? 'TSR' : 'Pendamping') }}</span>
                            <div class="dropdown-divider"></div>
                        </div>
                        <a class="dropdown-item d-flex" href="#">
                            <svg class="header-icon mr-3" xmlns="http://www.w3.org/2000/svg" height="24"
                                viewBox="0 0 24 24" width="24">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.51.88 4.93 1.78C15.57 19.36 13.86 20 12 20s-3.57-.64-4.93-1.72zm11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33C4.62 15.49 4 13.82 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.49-1.64 4.83zM12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z" />
                            </svg>
                            <div class="">Profile</div>
                        </a>

                        <a class="dropdown-item d-flex" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                                                     document.getElementById('logout-form').submit();">
                            <svg class="header-icon mr-3" xmlns="http://www.w3.org/2000/svg"
                                enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24">
                                <g>
                                    <rect fill="none" height="24" width="24" />
                                </g>
                                <g>
                                    <path
                                        d="M11,7L9.6,8.4l2.6,2.6H2v2h10.2l-2.6,2.6L11,17l5-5L11,7z M20,19h-8v2h8c1.1,0,2-0.9,2-2V5c0-1.1-0.9-2-2-2h-8v2h8V19z" />
                                </g>
                            </svg>
                            <div class="">Sign Out</div>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
