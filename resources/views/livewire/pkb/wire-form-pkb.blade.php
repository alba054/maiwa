<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Form PKB</h5>
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
                    <label class="form-label">Pilih Metode<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="metode_id">
                        <option value="">Please Choose</option>
                        @foreach ($metodes as $item)
                            <option value="{{ $item->id }}"> {{ $item->metode }} </option>
                        @endforeach
                    </select>
                    @error('metode_id')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Pilih Hasil<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="hasil_id">
                        <option value="">Please Choose</option>
                        @foreach ($hasils as $item)
                            <option value="{{ $item->id }}"> {{ $item->hasil }} </option>
                        @endforeach
                    </select>
                    @error('hasil_id')
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
