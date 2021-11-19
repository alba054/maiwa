@extends('layouts.master')
@section('css')
    <!-- Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <!-- Slect2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

@endsection
@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">
                Data Post
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fe fe-layers mr-2 fs-14"></i>Post</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Data Post</a>
                </li>
            </ol>
        </div>
        {{-- <div class="page-rightheader">
            <div class="btn btn-list">
                <a href="#" class="btn btn-info"><i class="fe fe-settings mr-1"></i> General Settings </a>
                <a href="#" class="btn btn-danger"><i class="fe fe-printer mr-1"></i> Print </a>
                <a href="#" class="btn btn-warning"><i class="fe fe-shopping-cart mr-1"></i> Buy Now </a>
            </div>
        </div> --}}
    </div>
    <!--End Page header-->
@endsection
@section('content')

    {{-- @livewire('post.index') --}}
    <div>

        <div class="col-6 mb-4">
            <a href="{{ route('posts.create') }}" class="btn btn-primary"><i class="fe fe-plus"></i>
                Tambahkan Post Baru</a>
        </div>

        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title col-xl-3">Tabel Post</div>

                </div>
                <div class="card-body">

                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert"><button type="button" class="close"
                                data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="fa fa-check-circle-o mr-2" aria-hidden="true"></i> {{ Session::get('message') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0" width="5%">#</th>
                                    <th class="border-bottom-0">title</th>
                                    <th class="border-bottom-0">tags</th>
                                    <th class="border-bottom-0">detail</th>
                                    <th class="border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('posts.show', $item) }}">{{ $item->title }}</a></td>
                                        <td>{{ $item->tags()->get()->implode('name', ',') }}</td>
                                        <td>{!! Str::limit(strip_tags($item->detail), 50) !!}</td>
                                        <td class="text-right">
                                            <a href="{{ route('posts.edit', $item) }}">
                                                <i wire:click="selectemItem({{ $item->id }},'update')"
                                                    class="fe fe-edit f-16 btn btn-success" style="cursor:pointer"></i>
                                            </a>

                                            <a href="#" data-id="{{ $item->id }}" class="delete">
                                                <i class="fe fe-trash-2 f-16 btn btn-danger" style="cursor:pointer"></i></a>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>


    </div>


    </div>
    </div><!-- end app-content-->
    </div>
@endsection
@section('js')
    <!-- INTERNAL Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables.js') }}"></script>

    <!-- INTERNAL Select2 js -->
    <script src="{{ URL::asset('assets/plugins/select2/select2.full.min.js') }}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.delete').click(function() {

                var data = $(this).attr('data-id');


                Swal.fire({
                    title: 'Yakin ?',
                    text: "Anda akan menghapus data ini !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "post/delete/" + data;

                    }
                })

            });


        });
    </script>


@endsection
