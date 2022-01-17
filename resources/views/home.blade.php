@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">Dashboard</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fe fe-layers mr-2 fs-14"></i>Apps</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Dashboard</a></li>
            </ol>
        </div>
        <div class="page-rightheader" hidden>
            <div class="btn btn-list">
                <a href="#" class="btn btn-info"><i class="fe fe-settings mr-1"></i> General Settings </a>
                <a href="#" class="btn btn-danger"><i class="fe fe-printer mr-1"></i> Print </a>
                <a href="#" class="btn btn-warning"><i class="fe fe-shopping-cart mr-1"></i> Buy Now </a>
            </div>
        </div>
    </div>
    <!--End Page header-->
@endsection
@section('content')
    <!-- Row-1 -->
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden dash1-card border-0">
                <div class="card-body">
                    <p class=" mb-1">Total TSR</p>
                    <h2 class="mb-1 number-font">{{ $countTsr . ' Orang' }}</h2>
                    {{-- <small class="fs-12 text-muted">Compared to Last Month</small> --}}
                    {{-- <span class="ratio bg-success">53%</span> --}}
                    {{-- <span class="ratio-text text-muted">Goals Reached</span> --}}
                </div>
                <div id="spark4"></div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden dash1-card border-0">
                <div class="card-body">
                    <p class=" mb-1 ">Total Pendamping</p>
                    <h2 class="mb-1 number-font">{{ $countPendamping . ' Orang' }}</h2>
                    {{-- <small class="fs-12 text-muted">Compared to Last Month</small> --}}
                    {{-- <span class="ratio bg-warning">76%</span> --}}
                    {{-- <span class="ratio-text text-muted">Goals Reached</span> --}}
                </div>
                <div id="spark1"></div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden dash1-card border-0">
                <div class="card-body">
                    <p class=" mb-1 ">Total Peternak</p>
                    <h2 class="mb-1 number-font">{{ $countPeternak . ' Orang' }}</h2>
                    {{-- <small class="fs-12 text-muted">Compared to Last Month</small> --}}
                    {{-- <span class="ratio bg-info">85%</span> --}}
                    {{-- <span class="ratio-text text-muted">Goals Reached</span> --}}
                </div>
                <div id="spark2"></div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden dash1-card border-0">
                <div class="card-body">
                    <p class=" mb-1 ">Total Sapi</p>
                    <h2 class="mb-1 number-font">{{ $countSapi . ' Ekor' }}</h2>
                    {{-- <small class="fs-12 text-muted">Compared to Last Month</small> --}}
                    {{-- <span class="ratio bg-danger">62%</span> --}}
                    {{-- <span class="ratio-text text-muted">Goals Reached</span> --}}
                </div>
                <div id="spark3"></div>
            </div>
        </div>

    </div>
    <!-- End Row-1 -->


    @livewire('wirehome')

    </div>
    </div><!-- end app-content-->
    </div>
@endsection
@section('js')
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
@endsection
