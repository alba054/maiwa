@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
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

    <!--INTERNAL ECharts js-->
    <script src="{{ URL::asset('assets/plugins/echarts/echarts.js') }}"></script>

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
        window.addEventListener('openModalAdd', event => {
            $("#add-form-modal").modal('show');

        });
        window.addEventListener('closeModalAdd', event => {
            $("#add-form-modal").modal('hide');

        });
        window.addEventListener('openModalGrafik', event => {
            $("#grafik-modal").modal('show');

        });
        window.addEventListener('closeModalGrafik', event => {
            $("#grafik-modal").modal('hide');

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#user-form-modal").on('hidden.bs.modal', function() {
                livewire.emit('forceCloseModal');
            });
            $("#add-form-modal").on('hidden.bs.modal', function() {
                livewire.emit('forceCloseModal');
            });


        });
    </script>

    <script>
        window.addEventListener('cleanTgl', event => {
            $('#appointmentDateInput').val('');
        });
    </script>
    <script>
        $('#appointmentDate').datetimepicker({
            // format: 'L',
            format: 'YYYY/MM/DD'
        });

        $('#appointmentDate').on("change.datetimepicker", function(e) {
            let date = $(this).data('appointmentdate');
            eval(date).set('waktu_ib', $('#appointmentDateInput').val());

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

    @stack('script')

@endsection
