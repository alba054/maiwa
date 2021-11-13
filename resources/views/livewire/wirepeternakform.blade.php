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
                    <label class="form-label">Nama Peternak</label>
                    <input wire:model="nama_peternak" type="text" class="form-control" placeholder="e.g: Asep Sunarya">
                    @error('nama_peternak')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor HP</label>
                    <input wire:model="no_hp" type="number" class="form-control" placeholder="e.g: 08xxxxx">
                    @error('no_hp')
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
                    <label class="form-label">Jumlah Anggota</label>
                    <input wire:model="jumlah_anggota" type="text" class="form-control" placeholder="e.g : 100">
                    @error('jumlah_anggota')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Luas Lahan</label>
                    <input wire:model="luas_lahan" type="text" class="form-control" placeholder="e.g : 100 Ha">
                    @error('luas_lahan')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <hr>

                <div class="form-group">
                    <label class="form-label">Kelompok<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="kelompok_id">
                        <option value="">Pilih Kelompok</option>
                        @foreach ($kelompoks as $item)
                            <option value="{{ $item->id }}"> {{ $item->name }} </option>
                        @endforeach
                    </select>
                    @error('kelompok_id')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <hr>

                <div class="form-group">
                    <label class="form-label">Pendamping<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="pendamping_id">
                        <option value="">Pilih Pendamping</option>
                        @foreach ($pendampings as $item)
                            <option value="{{ $item->id }}"> {{ $item->user->name }} </option>
                        @endforeach
                    </select>
                    @error('pendamping_id')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <hr>

                <div class="form-group">
                    <label class="form-label">Kabupaten<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="kabupaten_id">
                        <option value="">Please Choose</option>
                        @foreach ($kabupatens as $item)
                            <option value="{{ $item->id }}"> {{ $item->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Kecamatan<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="kecamatan_id">
                        <option value="">Please Choose</option>
                        @foreach ($kecamatans as $item)
                            <option value="{{ $item->id }}"> {{ $item->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Desa<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="desa_id">
                        <option value="">Please Choose</option>
                        @foreach ($desas as $item)
                            <option value="{{ $item->id }}"> {{ $item->name }} </option>
                        @endforeach
                    </select>
                    @error('desa_id')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="dimmer active" style="height: 5px; margin-top: 0;" wire:loading>
                    <div class="spinner4">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="modal-footer">
        <div class="row">
            <div class="col d-flex justify-content-end">
                <button wire:click="save" class="btn btn-outline-primary" type="submit">Submit</button>
            </div>
        </div>
    </div>
</div>
