@extends('layouts.master')
@section('css')

@endsection
@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">
                Our News
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fe fe-layers mr-2 fs-14"></i>Post</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Our News</a>
                </li>
            </ol>
        </div>

    </div>
    <!--End Page header-->
@endsection
@section('content')

    <!-- Row -->
    <div class="row">
        @foreach ($datas as $item)
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="card overflow-hidden">
                    <div class="item7-card-img">
                        <a href="#"></a>
                        <img src="{{ url('storage/photos_thumb/' . $item->images) }}" alt="img" class="cover-image w-100">
                    </div>
                    <div class="card-body">
                        <div class="item7-card-desc d-flex mb-5">
                            <a href="#" class="d-flex"><i class="fe fe-calendar fs-16 mr-1"></i>
                                {{ $item->created_at->format('Y-m-d') }}</a>

                        </div>
                        <a href="{{ route('posts.show', $item) }}" class="mt-4">
                            <h5 class="font-weight-semibold">{{ $item->title }}</h5>
                        </a>
                        <p>{!! Str::limit(strip_tags($item->detail), 150) !!}</p>
                    </div>

                </div>
            </div>
        @endforeach


    </div>
    <!--End Row-->

    </div>
    </div><!-- end app-content-->
    </div>
@endsection
@section('js')

@endsection
