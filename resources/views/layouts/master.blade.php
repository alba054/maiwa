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
    @include('layouts.head')
    @livewireStyles
</head>

<body class="app sidebar-mini">
    <!---Global-loader-->
    <div id="global-loader">
        <img src="{{ URL::asset('assets/images/svgs/loader.svg') }}" alt="loader">
    </div>
    <!--- End Global-loader-->
    <!-- Page -->
    <div class="page">
        <div class="page-main">
            @include('layouts.aside-menu')
            <!-- App-Content -->
            <div class="app-content main-content">
                <div class="side-app">
                    @include('layouts.header')
                    @yield('page-header')
                    @yield('content')
                    @include('layouts.footer')
                </div><!-- End Page -->
                @include('layouts.footer-scripts')
                @livewireScripts

                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10">
                </script>
                ...
                <x-livewire-alert::scripts />
</body>

</html>
