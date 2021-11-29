<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Filter Pencarian</h5>
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="py-1">
            <form class="form" novalidate="">
                <div class="form-group">
                    <label>Tanggal</label>
                    <div class="row">
                        <div class="col">
                            <div wire:ignore class="input-group date" id="appointmentDateStart"
                                data-target-input="nearest" data-appointmentdatestart="@this">
                                <input type="text" class="form-control datetimepicker-input"
                                    data-target="#appointmentDateStart" id="appointmentDateStartInput"
                                    data-toggle="datetimepicker" placeholder="Start Date">

                            </div>
                        </div>
                        <div class="col">
                            <div wire:ignore class="input-group date" id="appointmentDateEnd"
                                data-target-input="nearest" data-appointmentdateend="@this">
                                <input type="text" class="form-control datetimepicker-input"
                                    data-target="#appointmentDateEnd" id="appointmentDateEndInput"
                                    data-toggle="datetimepicker" placeholder="Date To">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <select class="custom-select" wire:model="obatId">
                        <option value="">Pilih Obat</option>
                        @foreach ($obats as $item)
                            <option value="{{ $item->id }}"> {{ $item->name }} </option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <select class="custom-select" wire:model="vitaminId">
                        <option value="">Pilih Vitamin</option>
                        @foreach ($vitamins as $item)
                            <option value="{{ $item->id }}"> {{ $item->name }} </option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <select class="custom-select" wire:model="vaksinId">
                        <option value="">Pilih Vaksin</option>
                        @foreach ($vaksins as $item)
                            <option value="{{ $item->id }}"> {{ $item->name }} </option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <select class="custom-select" wire:model="hormonId">
                        <option value="">Pilih Hormon</option>
                        @foreach ($hormons as $item)
                            <option value="{{ $item->id }}"> {{ $item->name }} </option>
                        @endforeach
                    </select>

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

            </form>
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
