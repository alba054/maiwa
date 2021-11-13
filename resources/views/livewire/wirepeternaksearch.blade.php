<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Filter Pencarian</h5>
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="py-1">

            <div class="form-group">
                <select class="custom-select" wire:model="pendampingId">
                    <option value="">Pilih Pendamping</option>
                    @foreach ($pendampings as $item)
                        <option value="{{ $item->id }}"> {{ $item->user->name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select class="custom-select" wire:model="tsrId">
                    <option value="">Pilih TSR</option>
                    @foreach ($tsrs as $item)
                        <option value="{{ $item->id }}"> {{ $item->user->name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select class="custom-select" wire:model="kabupatenId">
                    <option value="">Pilih Kabupaten</option>
                    @foreach ($kabupatens as $item)
                        <option value="{{ $item->id }}"> {{ $item->name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select class="custom-select" wire:model="kecamatanId">
                    <option value="">Pilih Kecamatan</option>
                    @foreach ($kecamatans as $item)
                        <option value="{{ $item->id }}"> {{ $item->name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select class="custom-select" wire:model="desaId">
                    <option value="">Pilih Desa</option>
                    @foreach ($desas as $item)
                        <option value="{{ $item->id }}"> {{ $item->name }} </option>
                    @endforeach
                </select>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <div class="row">
            <div class="d-flex justify-content-end">
                <button wire:click="submit" class="btn btn-outline-primary" type="submit">Submit</button>
            </div>
            <div class="col d-flex justify-content-end">
                <button wire:click="clearFilter" class="btn btn-outline-warning" type="submit">Clear</button>
            </div>
        </div>
    </div>
</div>
