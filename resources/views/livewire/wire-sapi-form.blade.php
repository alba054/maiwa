<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Tambah Sapi</h5>
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="py-1">
            <form class="form" novalidate="">
                <div class="form-group">
                    <label class="form-label">Peternak<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="peternak_id">
                        <option value="">Pilih Peternak</option>
                        @foreach ($peternaks as $item)
                            <option value="{{ $item->id }}"> {{ $item->nama_peternak }} </option>
                        @endforeach
                    </select>
                    @error('peternak_id')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Jenis Sapi<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="jenis_sapi_id">
                        <option value="">Please Choose</option>
                        @foreach ($jenis_sapis as $item)
                            <option value="{{ $item->id }}"> {{ $item->jenis }} </option>
                        @endforeach
                    </select>
                    @error('jenis_sapi_id')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir<span class="text-danger">*</span></label>
                    <div wire:ignore class="date" id="appointmentDate" data-target-input="nearest"
                        data-appointmentdate="@this">
                        <input type="text" class="form-control datetimepicker-input" data-target="#appointmentDate"
                            id="appointmentDateInput" data-toggle="datetimepicker" placeholder="Tanggal Lahir">
                    </div>
                    @error('tanggal_lahir')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Anak Ke <span class="text-danger">*</span></label>
                    <input wire:model="anak_ke" type="number" class="form-control" placeholder="e.g: 10">
                    @error('anak_ke')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Generasi Ke <span class="text-danger">*</span></label>
                    <input wire:model="generasi" type="text" class="form-control" placeholder="e.g: F10">
                    @error('generasi')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">eartag Induk<span class="text-danger">*</span></label>
                    <input wire:model="eartag_induk" type="text" class="form-control" placeholder="e.g: 007">
                    @error('eartag_induk')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">eartag<span class="text-danger">*</span></label>
                    <input wire:model="eartag" type="text" class="form-control" placeholder="e.g: T001/QAZ/007">
                    @error('eartag')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Sapi<span class="text-danger">*</span></label>
                    <input wire:model="nama_sapi" type="text" class="form-control" placeholder="e.g: Sapi Asep">
                    @error('nama_sapi')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label class="form-label">Jenis Kelamin<span class="text-danger">*</span></label>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                            wire:model="kelamin" value="Jantan">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Jantan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                            wire:model="kelamin" value="Betina">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Betina
                        </label>
                    </div>
                    @error('kelamin')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Kondisi Lahir<span class="text-danger">*</span></label>

                    <select class="custom-select" wire:model="kondisi_lahir">
                        <option value="">Pilih Kondisi Lahir</option>
                        <option value="Normal">Normal</option>
                        <option value="Mati">Mati</option>
                        <option value="Operasi Sesar">Operasi Sesar</option>

                    </select>
                    @error('kondisi_lahir')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Foto Depan<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="formFile" wire:model="foto_depan">
                            @error('foto_depan')
                                <small class="mt-2 text-danger">{{ $message }}</small>
                            @enderror

                            @if ($foto_depan)
                                <img src="{{ $foto_depan->temporaryUrl() }}" width="100%" class="mt-2">
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Foto Samping<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="formFile" wire:model="foto_samping">
                            @error('foto_samping')
                                <small class="mt-2 text-danger">{{ $message }}</small>
                            @enderror

                            @if ($foto_samping)
                                <img src="{{ $foto_samping->temporaryUrl() }}" width="100%" class="mt-2">
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Foto Peternak dgn Sapi<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="formFile" wire:model="foto_peternak">
                            @error('foto_peternak')
                                <small class="mt-2 text-danger">{{ $message }}</small>
                            @enderror

                            @if ($foto_peternak)
                                <img src="{{ $foto_peternak->temporaryUrl() }}" width="100%" class="mt-2">
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Foto Rumah Peternak<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="formFile" wire:model="foto_rumah">
                            @error('foto_rumah')
                                <small class="mt-2 text-danger">{{ $message }}</small>
                            @enderror

                            @if ($foto_rumah)
                                <img src="{{ $foto_rumah->temporaryUrl() }}" width="100%" class="mt-2">
                            @endif
                        </div>
                    </div>
                </div>


            </form>
        </div>

        <div class="dimmer active" wire:target="save" style="height: 5px; margin-top: 0;" wire:loading>
            <div class="spinner4">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <div class="row">
            <div class="col d-flex justify-content-end">
                <button wire:click="save" class="btn btn-outline-primary" type="submit"
                    wire:loading.attr="disabled">Save Changes</button>
            </div>
        </div>
    </div>
</div>
