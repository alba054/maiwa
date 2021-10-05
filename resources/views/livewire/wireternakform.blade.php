<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Create User</h5>
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="py-1">
            <form class="form" novalidate="">
                <div class="form-group">
                    <label class="form-label">Nama Peternak<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="peternak_id">
                        <option value="">Please Choose</option>
                        @foreach ($peternaks as $item)
                            <option value="{{ $item->id }}"> {{ $item->name }} </option>
                        @endforeach
                    </select>
                    @error('peternak_id')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Foto Depan<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="formFile" wire:model="photo_depan">
                            @error('photo_depan')
                                <small class="mt-2 text-danger">{{ $message }}</small>
                            @enderror

                            @if ($photo_depan)
                                <img src="{{ $photo_depan->temporaryUrl() }}" width="100%" class="mt-2">
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Foto Belakang<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="formFile" wire:model="photo_belakang">
                            @error('photo_belakang')
                                <small class="mt-2 text-danger">{{ $message }}</small>
                            @enderror

                            @if ($photo_belakang)
                                <img src="{{ $photo_belakang->temporaryUrl() }}" width="100%" class="mt-2">
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Foto Samping Kiri<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="formFile" wire:model="photo_kiri">
                            @error('photo_kiri')
                                <small class="mt-2 text-danger">{{ $message }}</small>
                            @enderror

                            @if ($photo_kiri)
                                <img src="{{ $photo_kiri->temporaryUrl() }}" width="100%" class="mt-2">
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Foto Samping Kanan<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="formFile" wire:model="photo_kanan">
                            @error('photo_kanan')
                                <small class="mt-2 text-danger">{{ $message }}</small>
                            @enderror

                            @if ($photo_kanan)
                                <img src="{{ $photo_kanan->temporaryUrl() }}" width="100%" class="mt-2">
                            @endif
                        </div>
                    </div>


                </div>

                <div class="form-group">
                    <label class="form-label">Kode Ternak</label>
                    <input wire:model="kode" type="text" class="form-control" placeholder="e.g: T001">
                    @error('kode')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Ternak</label>
                    <input wire:model="name" type="text" class="form-control" placeholder="e.g: Sapi Asep">
                    @error('name')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Induk Ternak</label>
                    <input wire:model="induk" type="text" class="form-control" placeholder="e.g: Sapi Asep">
                    @error('induk')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">No Ertag</label>
                    <input wire:model="ertag" type="text" class="form-control" placeholder="e.g: JKH/90JBA/SDFG">
                    @error('ertag')
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
                    @error('tgl_lahir')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Jenis Kelamin</label>
                    <input wire:model="kelamin" type="text" class="form-control" placeholder="e.g: Cowok">
                    @error('kelamin')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Jenis</label>
                    <input wire:model="jenis" type="text" class="form-control" placeholder="e.g: Jenis">
                    @error('jenis')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <input wire:model="jenis" type="text" class="form-control" placeholder="e.g: Status">
                    @error('status')
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
