@extends('layouts.master')
@section('css')
@endsection

@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">
                {{-- {{ $id == '1' ? ($id == '1' ? 'Admin' : 'TSR') : ($id == '2' ? 'TSR' : 'Pendamping') }} --}}
                @if ($id == '1')
                    Admin
                @endif
                @if ($id == '2')
                    TSR
                @endif
                @if ($id == '3')
                    Pendamping
                @endif
                @if ($id == '4')
                    Dokter
                @endif

            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fe fe-layers mr-2 fs-14"></i>Users</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">
                        @if ($id == '1')
                            Admin
                        @endif
                        @if ($id == '2')
                            TSR
                        @endif
                        @if ($id == '3')
                            Pendamping
                        @endif
                        @if ($id == '4')
                            Dokter
                        @endif
                    </a>
                </li>
            </ol>
        </div>

    </div>
    <!--End Page header-->
@endsection
@section('content')
    @livewire('wireuser', ['id' => $id])

    </div>
    </div><!-- end app-content-->
    </div>
@endsection
@section('js')
@endsection
