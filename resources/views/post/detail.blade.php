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
                            <div class="mt-0">Jan-18-2020</div>
                        </a>
                        <a href="{{ url('/' . ($page = '#')) }}" class="d-flex mb-2"><i
                                class="fe fe-user fs-16 mr-1"></i>
                            <div class="mt-0">Anna Ogden</div>
                        </a>
                        <div class="ml-auto mb-2">
                            <a class="mr-0 d-flex" href="{{ url('/' . ($page = '#')) }}"><i
                                    class="fe fe-message-square fs-16 mr-1"></i>
                                <div class="mt-0">12 Comments</div>
                            </a>
                        </div>
                    </div>
                    <a href="{{ url('/' . ($page = '#')) }}" class="mt-4">
                        <h5 class="font-weight-semibold">{{ $post->title }}</h5>
                    </a>
                    {!! $post->detail !!}
                    <div class="media py-3 mt-0 border-top">
                        <div class="media-user mr-2">
                            <div class="avatar-list avatar-list-stacked">
                                <span class="avatar brround"
                                    style="background-image: url({{ URL::asset('assets/images/users/12.jpg') }})"></span>
                                <span class="avatar brround"
                                    style="background-image: url({{ URL::asset('assets/images/users/2.jpg') }})"></span>
                                <span class="avatar brround"
                                    style="background-image: url({{ URL::asset('assets/images/users/9.jpg') }})"></span>
                                <span class="avatar brround"
                                    style="background-image: url({{ URL::asset('assets/images/users/2.jpg') }})"></span>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <div class="d-flex">
                                <a href="javascript:void(0)" class="new ml-3"><i
                                        class="fe fe-heart  fs-16 text-icon"></i></a>
                                <a href="javascript:void(0)" class="new ml-3"><i
                                        class="fe fe-thumbs-up  fs-16 text-icon"></i></a>
                                <a href="javascript:void(0)" class="new ml-3"><i
                                        class="fe fe-share-2  fs-16 text-icon"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Comments-->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">3 Comments</h3>
                </div>
                <div class="card-body">
                    <div class="d-sm-flex mt-0 p-5 sub-review-section border border-bottom-0 br-bl-0 br-br-0">
                        <div class="d-flex mr-3">
                            <a href="{{ url('/' . ($page = '#')) }}"><img class="media-object brround avatar-md"
                                    alt="64x64" src="{{ URL::asset('assets/images/users/1.jpg') }}"> </a>
                        </div>
                        <div class="media-body">
                            <h5 class="mt-0 mb-1 font-weight-semibold">Joanne Scott
                                <span class="fs-14 ml-0" data-toggle="tooltip" data-placement="top" title=""
                                    data-original-title="verified"><i class="fa fa-check-circle-o text-success"></i></span>
                                <span class="fs-14 ml-2"> 4.5 <i class="fa fa-star text-yellow"></i></span>
                            </h5>
                            <p class="font-13  mb-2 mt-2">
                                Lorem ipsum dolor sit amet, quis Neque porro quisquam est, nostrud exercitation ullamco
                                laboris commodo consequat.
                            </p>
                            <a href="{{ url('/' . ($page = '#')) }}" class="mr-2 mt-1"><span
                                    class="badge badge-primary">Helpful</span></a>
                            <a href="" class="mr-2 mt-1" data-toggle="modal" data-target="#Comment"><span
                                    class="badge badge-light">Comment</span></a>
                            <a href="" class="mr-2 mt-1" data-toggle="modal" data-target="#report"><span
                                    class="badge badge-light">Report</span></a>
                            <div class="btn-group btn-group-sm mb-1 ml-auto float-sm-right mt-1">
                                <button class="btn btn-light" type="button"><i
                                        class="fe fe-thumbs-up  fs-16 text-icon"></i></button>
                                <button class="btn btn-light" type="button"><i
                                        class="fe fe-thumbs-down  fs-16 text-icon"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="d-sm-flex p-5 sub-review-section border subsection-color br-tl-0 br-tr-0">
                        <div class="d-flex mr-3">
                            <a href="{{ url('/' . ($page = '#')) }}"><img class="media-object brround avatar-md"
                                    alt="64x64" src="{{ URL::asset('assets/images/users/2.jpg') }}"> </a>
                        </div>
                        <div class="media-body">
                            <h5 class="mt-0 mb-1 font-weight-semibold">Rose Slater <span class="fs-14 ml-0"
                                    data-toggle="tooltip" data-placement="top" title="" data-original-title="verified"><i
                                        class="fa fa-check-circle-o text-success"></i></span></h5>
                            <p class="font-13  mb-2 mt-2">
                                Lorem ipsum dolor sit amet nostrud exercitation ullamco laboris commodo consequat.
                            </p>
                            <a href="" data-toggle="modal" data-target="#Comment" class="mt-1"><span
                                    class="badge badge-light">Comment</span></a>
                            <div class="btn-group btn-group-sm mb-1 ml-auto float-sm-right mt-1">
                                <button class="btn btn-light" type="button"><i
                                        class="fe fe-thumbs-up  fs-16 text-icon"></i></button>
                                <button class="btn btn-light" type="button"><i
                                        class="fe fe-thumbs-down  fs-16 text-icon"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="d-sm-flex p-5 mt-4 border sub-review-section">
                        <div class="d-flex mr-3">
                            <a href="{{ url('/' . ($page = '#')) }}"><img class="media-object brround avatar-md"
                                    alt="64x64" src="{{ URL::asset('assets/images/users/3.jpg') }}"> </a>
                        </div>
                        <div class="media-body">
                            <h5 class="mt-0 mb-1 font-weight-semibold">Edward
                                <span class="fs-14 ml-0" data-toggle="tooltip" data-placement="top" title=""
                                    data-original-title="verified"><i class="fa fa-check-circle-o text-success"></i></span>
                                <span class="fs-14 ml-2"> 4 <i class="fa fa-star text-yellow"></i></span>
                            </h5>
                            <p class="font-13  mb-2 mt-2">
                                Lorem ipsum dolor sit amet, quis Neque porro quisquam est, nostrud exercitation ullamco
                                laboris commodo consequat.
                            </p>
                            <a href="{{ url('/' . ($page = '#')) }}" class="mr-2 mt-1"><span
                                    class="badge badge-primary">Helpful</span></a>
                            <a href="" class="mr-2 mt-1" data-toggle="modal" data-target="#Comment"><span
                                    class="badge badge-light">Comment</span></a>
                            <a href="" class="mr-2 mt-1" data-toggle="modal" data-target="#report"><span
                                    class="badge badge-light">Report</span></a>
                            <div class="btn-group btn-group-sm mb-1 ml-auto float-sm-right mt-1">
                                <button class="btn btn-light" type="button"><i
                                        class="fe fe-thumbs-up  fs-16 text-icon"></i></button>
                                <button class="btn btn-light" type="button"><i
                                        class="fe fe-thumbs-down  fs-16 text-icon"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/Comments-->

            <div class="card mb-lg-0">
                <div class="card-header">
                    <h3 class="card-title">Add a Comment</h3>
                </div>
                <div class="card-body">
                    <div class="mt-2">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name1" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="example-textarea-input" rows="6"
                                placeholder="Write Review"></textarea>
                        </div>
                        <a href="{{ url('/' . ($page = '#')) }}" class="btn btn-primary">Send Reply</a>
                    </div>
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
