<div class="modal-content" wire:ignore>
    <div class="modal-header">
        <h5 class="modal-title">Grafik Periksa Kebuntingan</h5>
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="py-1">
            <div wire:ignore id="echart2" class="chart-tasks chart-dropshadow text-center"></div>
            <div class="text-center mt-2">

                <span><span class="dot-label bg-warning"></span>Data Kinerja</span>
            </div>
        </div>
    </div>

</div>

@push('sc')


@endpush
