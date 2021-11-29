@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">
                Form Sapi
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fe fe-layers mr-2 fs-14"></i>Data
                        Master</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Form Sapi</a>
                </li>
            </ol>
        </div>

    </div>
    <!--End Page header-->
@endsection
@section('content')
    @livewire('wire-sapi')
    </div>
    </div><!-- end app-content-->
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <script>
        window.addEventListener('openModal', event => {
            $("#user-form-modal").modal('show');

        });
        window.addEventListener('closeModal', event => {
            $("#user-form-modal").modal('hide');

        });
        window.addEventListener('openModalSearch', event => {
            $("#search-form-modal").modal('show');

        });
        window.addEventListener('closeModalSearch', event => {
            $("#search-form-modal").modal('hide');

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#user-form-modal").on('hidden.bs.modal', function() {
                livewire.emit('forceCloseModal');
            });
            $("#search-form-modal").on('hidden.bs.modal', function() {
                livewire.emit('forceCloseModal');
            });
        });
    </script>
    <script>
        $('#appointmentDate').datetimepicker({
            // format: 'L',
            format: 'YYYY/MM/DD'
        });

        $('#appointmentDate').on("change.datetimepicker", function(e) {
            let date = $(this).data('appointmentdate');
            eval(date).set('tanggal_lahir', $('#appointmentDateInput').val());
        });
    </script>
@endsection
