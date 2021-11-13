<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Form Performa (Recording)</h5>
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="py-1">
            <form class="form" novalidate="">
                <div class="text-center mb-5">
                    <div class="widget-user-image">
                        <img alt="User Avatar" class="rounded-circle  mr-3"
                            src="{{ URL::asset('assets/images/users/2.jpg') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Tinggi Badan<span class="text-danger">*</span></label>
                    <input wire:model="tinggi_badan" type="number" class="form-control" placeholder="e.g: 100CM">
                    @error('tinggi_badan')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Berat Badan<span class="text-danger">*</span></label>
                    <input wire:model="berat_badan" type="number" class="form-control" placeholder="e.g: 100KG">
                    @error('berat_badan')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Panjang Badan<span class="text-danger">*</span></label>
                    <input wire:model="panjang_badan" type="number" class="form-control" placeholder="e.g: 100CM">
                    @error('panjang_badan')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Lingkar Dada<span class="text-danger">*</span></label>
                    <input wire:model="lingkar_dada" type="number" class="form-control" placeholder="e.g: 100CM">
                    @error('lingkar_dada')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">BCS<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="bsc">
                        <option value="">Please Choose</option>
                        <option value="1"> 1 </option>
                        <option value="2"> 2 </option>
                        <option value="3"> 3 </option>
                        <option value="4"> 4 </option>
                        <option value="5"> 5 </option>

                    </select>
                    @error('bsc')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Pilih Sapi<span class="text-danger">*</span></label>
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
                <button wire:click="save" class="btn btn-primary" type="submit">Submit</button>
            </div>
        </div>
    </div>
</div>
