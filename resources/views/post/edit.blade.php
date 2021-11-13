@extends('layouts.master')
@section('css')
    <link href="{{ URL::asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

    <!-- INTERNAL File Uploads css -->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/fileupload/css/fileupload.css') }}" rel="stylesheet" type="text/css" />


    <!-- INTERNAl Quill css -->
    <link href="{{ URL::asset('assets/plugins/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/quill/quill.bubble.css') }}" rel="stylesheet">

    <!-- INTERNAl WYSIWYG Editor css -->
    <link href="{{ URL::asset('assets/plugins/wysiwyag/richtext.css') }}" rel="stylesheet" />

@endsection
@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">
                Create Post
            </h4>

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fe fe-layers mr-2 fs-14"></i>Post</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Update Post </a>
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

    {{-- @livewire('post.create') --}}
    <form class="card" action="{{ route('posts.edit', $post->slug) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card-header">
            <h3 class="card-title">Update Post</h3>
        </div>
        <div class="card-body ">
            <div class="form-group row">
                <div class="col-md-12">
                    <label class="form-label">Post Title</label>
                    <input wire:model="state.title" class="form-control @error('title') is-invalid @enderror"
                        placeholder="Post title" autofocus name="title" value="{{ $post->title }}">

                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label>Select Tags</label>
                    <div class="@error('tags') is-invalid @enderror">
                        <select id="tags" multiple="multiple" data-placeholder="Select Tags" style="width: 100%;"
                            class="select2" name="tags[]">
                            @foreach ($tags as $item)
                                <option {{ $post->tags()->find($item->id) ? 'selected' : '' }}
                                    value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('tags')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Post Image</label>
                <input type="file" name="image" class="form-control dropify" value="{{ old('image') }}">
                @error('image')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="form-group">
                <label class="form-label">Post Detail</label>


                <textarea class="content @error('detail') is-invalid @enderror" name="detail"
                    id="detail">{{ $post->detail }}</textarea>

                @if ($errors->has('detail'))
                    <small class="text-danger">{{ $errors->first('detail') }}</small>

                @endif


            </div>



        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-success"><i class="fe fe-plus"></i> Update</button>
                    <a class="btn btn-light" href="#">Cancel</a>
                </div>
            </div>
        </div>


    </form>

    </div>
    </div><!-- end app-content-->
    </div>
@endsection
@section('js')



    <!-- INTERNAL Select2 js -->
    <script src="{{ URL::asset('assets/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>

    <!-- INTERNAL File uploads js -->
    <script src="{{ URL::asset('assets/plugins/fileupload/js/dropify.js') }}"></script>
    <script src="{{ URL::asset('assets/js/filupload.js') }}"></script>

    <!-- INTERNAL quill js -->
    <script src="{{ URL::asset('assets/plugins/quill/quill.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/form-editor2.js') }}"></script>

    <!-- INTERNAL WYSIWYG Editor js -->
    <script src="{{ URL::asset('assets/plugins/wysiwyag/jquery.richtext.js') }}"></script>
    <script src="{{ URL::asset('assets/js/form-editor.js') }}"></script>

    <script>
        $(function() {
            $('.select2').select().on('change', function() {


            });
        })
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong appended.'
            },
            error: {
                'fileSize': 'The file size is too big (2M max).'
            }
        });
    </script>
    @stack('script')


@endsection
