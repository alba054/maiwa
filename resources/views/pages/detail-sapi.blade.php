@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">
                Detail Sapi
                {{ 'MBC-' . $sapi->generasi . '.' . $sapi->anak_ke . '-' . $sapi->eartag_induk . '-' . $sapi->eartag }}
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fe fe-layers mr-2 fs-14"></i>Sapi</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Detail Sapi
                        {{ 'MBC-' . $sapi->generasi . '.' . $sapi->anak_ke . '-' . $sapi->eartag_induk . '-' . $sapi->eartag }}</a>
                </li>
            </ol>
        </div>

    </div>
    <!--End Page header-->
@endsection
@section('content')
    @livewire('wire-detail-sapi',['sapi' => $sapi])

    </div>
    </div><!-- end app-content-->
    </div>
@endsection
@section('js')
    <script>
        window.addEventListener('openModal', event => {
            $("#user-form-modal").modal('show');

        });
        window.addEventListener('closeModal', event => {
            $("#user-form-modal").modal('hide');

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#user-form-modal").on('hidden.bs.modal', function() {
                livewire.emit('forceCloseModal');
            });


        });
    </script>
@endsection
