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
                <label>Tanggal</label>
                <div wire:ignore class="input-group date mb-2" id="appointmentDateStart" data-target-input="nearest"
                    data-appointmentdatestart="@this">
                    <input type="text" class="form-control datetimepicker-input" data-target="#appointmentDateStart"
                        id="appointmentDateStartInput" data-toggle="datetimepicker" placeholder="Start Date">

                </div>
                <div wire:ignore class="input-group date" id="appointmentDateEnd" data-target-input="nearest"
                    data-appointmentdateend="@this">
                    <input type="text" class="form-control datetimepicker-input" data-target="#appointmentDateEnd"
                        id="appointmentDateEndInput" data-toggle="datetimepicker" placeholder="Date To">

                </div>
            </div>

            <div class="form-group">
                <select class="custom-select" wire:model="sapiId">
                    <option value="">Pilih Sapi</option>
                    @foreach ($sapis as $item)
                        <option value="{{ $item->id }}">
                            {{ 'MBC-' . $item->generasi . '.' . $item->anak_ke . '-' . $item->eartag_induk . '-' . $item->eartag }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <select class="custom-select" wire:model="status">
                    <option value="">Pilih Keterangan</option>

                    <option value="Sakit">Sakit</option>

                    <option value="Sembuh">Sembuh</option>

                </select>

            </div>
            <div class="form-group">
                <select class="custom-select" wire:model="peternakId">
                    <option value="">Pilih Peternak</option>
                    @foreach ($peternaks as $item)
                        <option value="{{ $item->id }}"> {{ $item->nama_peternak }} </option>
                    @endforeach
                </select>
            </div>
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

        </div>
    </div>
    <div class="modal-footer">
        <div class="row">
            <div class="col d-flex justify-content-end">
                <button wire:click="submit" class="btn btn-primary" type="submit">Submit</button>
            </div>
        </div>
    </div>
</div>
