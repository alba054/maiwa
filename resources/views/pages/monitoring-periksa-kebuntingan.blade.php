@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">
                Periksa Kebuntingan
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i
                            class="fe fe-layers mr-2 fs-14"></i>Monitoring</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Periksa Kebuntingan</a>
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
    @livewire('wire-mon-periksa-kebuntingan')
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
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#user-form-modal").on('hidden.bs.modal', function() {
                livewire.emit('forceCloseModal');
            });


        });
    </script>

    <script>
        window.addEventListener('cleanTgl', event => {
            $('#appointmentDateInput').val('');
            $('#appointmentDateInputStart').val('');
        });
    </script>
    <script>
        $('#appointmentDate').datetimepicker({
            // format: 'L',
            format: 'YYYY/MM/DD'
        });

        $('#appointmentDate').on("change.datetimepicker", function(e) {
            let date = $(this).data('appointmentdate');
            eval(date).set('waktu_pk', $('#appointmentDateInput').val());

        });

        $('#appointmentDateStart').datetimepicker({
            // format: 'L',
            format: 'YYYY/MM/DD'
        });
        $('#appointmentDateStart').on("change.datetimepicker", function(e) {
            let date = $(this).data('appointmentdatestart');
            eval(date).set('startDate', $('#appointmentDateStartInput').val());

        });
        $('#appointmentDateEnd').datetimepicker({
            format: 'YYYY/MM/DD'
        });

        $('#appointmentDateEnd').on("change.datetimepicker", function(e) {
            let date = $(this).data('appointmentdateend');
            eval(date).set('endDate', $('#appointmentDateEndInput').val());
        });
    </script>
@endsection
