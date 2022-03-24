<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Form Insiminasi Buatan</h5>
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
                <div class="position-relative form-group">
                    <div>
                        <div class="form-group mb-0">
                            <label class="form-label">Pilih Sapi<span class="text-danger">*</span></label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fe fe-search text-primary"></i>
                                    </div>
                                </div>
                                <input wire:keydown.escape="resetQuery" wire:model.debounce.500ms="query" type="text"
                                    class="form-control" placeholder="Cari Eartag sapi atau nama sapi....">
                            </div>
                        </div>
                    </div>

                    <div wire:loading class="position-absolute mt-1 border-0" style="z-index: 1;left: 0;right: 0;">
                        <div class="card-body shadow">
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (!empty($query))
                        <div wire:click="resetQuery" class="position-fixed w-100 h-100"
                            style="left: 0; top: 0; right: 0; bottom: 0;z-index: 1;"></div>
                        @if ($search_results->isNotEmpty())
                            <div class="card position-absolute mt-1" style="z-index: 2;left: 0;right: 0;border: 0;">
                                <div class="card-body shadow">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($search_results as $result)
                                            <li class="list-group-item list-group-item-action">
                                                <a wire:click="resetQuery"
                                                    wire:click.prevent="selectSapi({{ $result->id }})" href="#">
                                                    {{ 'MBC-' . $result->generasi . '.' . $result->anak_ke . '-' . $result->eartag_induk . '-' . $result->eartag }}
                                                    | {{ $result->nama_sapi }}
                                                </a>
                                            </li>
                                        @endforeach
                                        @if ($search_results->count() >= $how_many)
                                            <li class="list-group-item list-group-item-action text-center">
                                                <a wire:click.prevent="loadMore" class="btn btn-primary btn-sm"
                                                    href="#">
                                                    Load More <i class="bi bi-arrow-down-circle"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        @else
                            <div class="card position-absolute mt-1 border-0" style="z-index: 1;left: 0;right: 0;">
                                <div class="card-body shadow">
                                    <div class="alert alert-warning mb-0">
                                        No Sapi Found....
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                    @error('sapi_id')
                        <small class="mt text-danger text-center">{{ $message }}</small>
                    @enderror


                </div>

                <h2 class="text-muted  text-center">{{ $sapiEartag }}</h2>


                <div class="form-group">
                    <label class="form-label">Pilih Straw<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="strow_id">
                        <option value="">Please Choose</option>
                        @foreach ($strows as $item)
                            <option value="{{ $item->id }}"> {{ $item->kode_batch }} </option>
                        @endforeach
                    </select>
                    @error('strow_id')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- <div class="form-group">
                    <label class="form-label">Pilih Sapi<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="sapi_id">
                        <option value="">Please Choose</option>
                        @foreach ($sapis as $item)
                            <option value="{{ $item->id }}">
                                {{ 'MBC-' . $item->generasi . '.' . $item->anak_ke . '-' . $item->eartag_induk . '-' . $item->eartag }}
                            </option>
                        @endforeach
                    </select>
                    @error('sapi_id')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div> --}}
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
                <button wire:click="save" class="btn btn-outline-primary" type="submit">Submit</button>
            </div>
        </div>
    </div>
</div>
