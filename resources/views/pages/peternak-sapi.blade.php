@extends('layouts.master')
@section('css')
<!-- INTERNAL Select2 css -->
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

@endsection
@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">
                Peternak - Sapi
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fe fe-layers mr-2 fs-14"></i>Tabel
                        Relasi</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Peternak - Sapi</a>
                </li>
            </ol>
        </div>

    </div>
    <!--End Page header-->
@endsection
@section('content')
    @livewire('relasi.wire-peternak-sapi')
    </div>
    </div><!-- end app-content-->
    </div>
@endsection
@section('js')
<!-- INTERNAL Select2 js -->
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>
@endsection
