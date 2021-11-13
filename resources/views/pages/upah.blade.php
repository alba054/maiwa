@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">
                Data Upah
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fe fe-layers mr-2 fs-14"></i>Data
                        Master</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Data Upah</a>
                </li>
            </ol>
        </div>

    </div>
    <!--End Page header-->
@endsection
@section('content')
    @livewire('wire-upah')
    </div>
    </div><!-- end app-content-->
    </div>
@endsection
@section('js')
@endsection
