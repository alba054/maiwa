@extends('layouts.master')
@section('css')

@endsection
@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">
                Detail Post
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fe fe-layers mr-2 fs-14"></i>Post</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Detail Post</a>
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

    {{-- @livewire('post.index') --}}
    <!-- Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card overflow-hidden">
                <div class="item7-card-img px-4 pt-4">
                    <a href="{{ url('/' . ($page = '#')) }}"></a>
                    <img src="{{ url('storage/photos/' . $post->images) }}" alt="img" class="cover-image br-7 w-100"
                        height="500px">
                </div>
                <div class="card-body">
                    <div class="item7-card-desc d-md-flex mb-5">
                        <a href="{{ url('/' . ($page = '#')) }}" class="d-flex mr-4 mb-2"><i
                                class="fe fe-calendar fs-16 mr-1"></i>
                            <div class="mt-0"> {{ $post->created_at->format('Y-m-d') }}</div>
                        </a>
                        <a href="{{ url('/' . ($page = '#')) }}" class="d-flex mb-2"><i
                                class="fe fe-user fs-16 mr-1"></i>
                            <div class="mt-0">Admin</div>
                        </a>
                        {{-- <div class="ml-auto mb-2">
                            <a class="mr-0 d-flex" href="{{ url('/' . ($page = '#')) }}"><i
                                    class="fe fe-message-square fs-16 mr-1"></i>
                                <div class="mt-0">12 Comments</div>
                            </a>
                        </div> --}}

                    </div>
                    <a href="{{ url('/' . ($page = '#')) }}" class="mt-4">
                        <h5 class="font-weight-semibold">{{ $post->title }}</h5>
                    </a>
                    {!! $post->detail !!}
                </div>
            </div>


        </div>
    </div>
    <!--End Row-->
    </div>
    </div><!-- end app-content-->
    </div>
@endsection
@section('js')

@endsection
