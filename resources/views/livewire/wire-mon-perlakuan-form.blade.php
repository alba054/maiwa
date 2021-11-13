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
                            <option value="{{ $item->id }}"> {{ $item->eartag }} </option>
                        @endforeach
                    </select>
                    @error('sapi_id')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Jenis Obat<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="obat_id">
                        <option value="">Please Choose</option>
                        @foreach ($obats as $item)
                            <option value="{{ $item->id }}"> {{ $item->name }} </option>
                        @endforeach
                    </select>
                    @error('obat_id')
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
                    <label class="form-label">Jenis Vaksin<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="vaksin_id">
                        <option value="">Please Choose</option>
                        @foreach ($vaksins as $item)
                            <option value="{{ $item->id }}"> {{ $item->name }} </option>
                        @endforeach
                    </select>
                    @error('vaksin_id')
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
                    <label class="form-label">Jenis Vitamin<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="vitamin_id">
                        <option value="">Please Choose</option>
                        @foreach ($vitamins as $item)
                            <option value="{{ $item->id }}"> {{ $item->name }} </option>
                        @endforeach
                    </select>
                    @error('vaksin_id')
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
                    <label class="form-label">Jenis Hormon<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="hormon_id">
                        <option value="">Please Choose</option>
                        @foreach ($hormons as $item)
                            <option value="{{ $item->id }}"> {{ $item->name }} </option>
                        @endforeach
                    </select>
                    @error('hormon_id')
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

                <div class="form-group">
                    <label>Foto Perlakuan<span class="text-danger">*</span></label>
                    <input class="form-control" type="file" id="formFile" wire:model="foto">
                    @error('foto')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror

                    @if ($foto)
                        <img src="{{ $foto->temporaryUrl() }}" class="mt-2">
                    @endif
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
