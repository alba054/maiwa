@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">
                Jenis Sapi
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fe fe-layers mr-2 fs-14"></i>Data
                        Master</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Data Jenis Sapi</a>
                </li>
            </ol>
        </div>
        <div class="page-rightheader">
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
    @livewire('wire-jenis-sapi')
    </div>
    </div><!-- end app-content-->
    </div>
@endsection
@section('js')
@endsection
