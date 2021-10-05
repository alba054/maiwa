<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Tambah Perlakuan</h5>
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="py-1">
            <form class="form" novalidate="">

                <div class="form-group">
                    <label class="form-label">Sapi<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="sapi_id">
                        <option value="">Please Choose</option>
                        @foreach ($sapis as $item)
                            <option value="{{ $item->id }}"> {{ $item->nama_sapi }} </option>
                        @endforeach
                    </select>
                    @error('sapi_id')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Tanggal Perlakuan<span class="text-danger">*</span></label>
                    <div wire:ignore class="date" id="appointmentDate" data-target-input="nearest"
                        data-appointmentdate="@this">
                        <input type="text" class="form-control datetimepicker-input" data-target="#appointmentDate"
                            id="appointmentDateInput" data-toggle="datetimepicker" placeholder="Tanggal Perlakuan">
                    </div>
                    @error('tgl_perlakuan')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Jenis Obat</label>
                    <input wire:model="jenis_obat" type="text" class="form-control" placeholder="e.g: Paracetamol">
                    @error('jenis_obat')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Dosis Obat</label>
                    <input wire:model="dosis_obat" type="number" class="form-control" placeholder="e.g: 100mg">
                    @error('dosis_obat')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Vaksin</label>
                    <input wire:model="vaksin" type="text" class="form-control" placeholder="e.g: Silovak">
                    @error('vaksin')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Dosis Vaksin</label>
                    <input wire:model="dosis_vaksin" type="number" class="form-control" placeholder="e.g: 100mg">
                    @error('dosis_vaksin')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Vitamin</label>
                    <input wire:model="vitamin" type="text" class="form-control" placeholder="e.g: ABC">
                    @error('vitamin')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Dosis Vitamin</label>
                    <input wire:model="dosis_vitamin" type="number" class="form-control" placeholder="e.g: 100mg">
                    @error('dosis_vitamin')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Hormon</label>
                    <input wire:model="hormon" type="text" class="form-control" placeholder="e.g: ABC">
                    @error('hormon')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Dosis Hormon</label>
                    <input wire:model="dosis_hormon" type="number" class="form-control" placeholder="e.g: 100mg">
                    @error('dosis_hormon')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Keterangan Perlakuan</label>
                    <input wire:model="ket_perlakuan" type="text" class="form-control"
                        placeholder="e.g: Keterangan Mengenai Perlakuan">
                    @error('ket_perlakuan')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>


            </form>
        </div>
    </div>
    <div class="modal-footer">
        <div class="row">
            <div class="col d-flex justify-content-end">
                <button wire:click="save" class="btn btn-primary" type="submit">Save Changes</button>
            </div>
        </div>
    </div>
</div>
