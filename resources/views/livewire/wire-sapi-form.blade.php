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
                    <label class="form-label">Peternak<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="peternak_id">
                        <option value="">Please Choose</option>
                        @foreach ($peternaks as $item)
                            <option value="{{ $item->id }}"> {{ $item->nama_peternak }} </option>
                        @endforeach
                    </select>
                    @error('peternak_id')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Ertag<span class="text-danger">*</span></label>
                    <input wire:model="ertag" type="text" class="form-control" placeholder="e.g: T001/QAZ/007">
                    @error('ertag')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Ertag Induk<span class="text-danger">*</span></label>
                    <input wire:model="ertag_induk" type="text" class="form-control" placeholder="e.g: T001/QAZ/007">
                    @error('ertag_induk')
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
                    <label class="form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                    <input wire:model="kelamin" type="text" class="form-control" placeholder="e.g: Jantan/Betina">
                    @error('kelamin')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Kondisi Lahir<span class="text-danger">*</span></label>
                    <input wire:model="kondisi_lahir" type="text" class="form-control" placeholder="e.g: Aman">
                    @error('kondisi_lahir')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Anak Ke -<span class="text-danger">*</span></label>
                    <input wire:model="anak_ke" type="number" class="form-control" placeholder="e.g: 10">
                    @error('anak_ke')
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
                            <label>Foto Belakang<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="formFile" wire:model="foto_belakang">
                            @error('foto_belakang')
                                <small class="mt-2 text-danger">{{ $message }}</small>
                            @enderror

                            @if ($foto_belakang)
                                <img src="{{ $foto_belakang->temporaryUrl() }}" width="100%" class="mt-2">
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Foto Samping Kiri<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="formFile" wire:model="foto_kiri">
                            @error('foto_kiri')
                                <small class="mt-2 text-danger">{{ $message }}</small>
                            @enderror

                            @if ($foto_kiri)
                                <img src="{{ $foto_kiri->temporaryUrl() }}" width="100%" class="mt-2">
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Foto Samping Kanan<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="formFile" wire:model="foto_kanan">
                            @error('foto_kanan')
                                <small class="mt-2 text-danger">{{ $message }}</small>
                            @enderror

                            @if ($foto_kanan)
                                <img src="{{ $foto_kanan->temporaryUrl() }}" width="100%" class="mt-2">
                            @endif
                        </div>
                    </div>
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
