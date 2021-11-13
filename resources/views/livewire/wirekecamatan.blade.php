<div class="row">

    <div class="col-xl-3 col-lg-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tambah Kecamatan
                </div>
            </div>
            <div class="card-body">
                <div class="text-center mb-5">
                    <div class="widget-user-image">
                        <img alt="User Avatar" class="rounded-circle  mr-3"
                            src="{{ URL::asset('assets/images/users/2.jpg') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Kabupaten<span class="text-danger">*</span></label>
                    <select class="custom-select" wire:model="kabupaten_id">
                        <option value="">Pilih Kabupaten</option>
                        @foreach ($kabupatens as $item)
                            <option value="{{ $item->id }}"> {{ $item->name }} </option>
                        @endforeach
                    </select>
                    @error('kabupaten_id')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Kecamatan</label>
                    <input wire:model="name" type="text" class="form-control" placeholder="e.g: Kecamatan Asep">
                    @error('name')
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
            </div>
            <div class="card-footer text-right">
                <button wire:click="save" class="btn btn-outline-primary">Submit</button>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-lg-8">
        <div class="card">
            <div class="card-header">
                <div class="col">
                    <div class="card-title">Tabel Kecamatan</div>
                </div>

            </div>
            <div class="card-body">

                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <select class="custom-select" wire:model="kabupatenId">
                                <option value="">Pilih Kabupaten</option>
                                @foreach ($kabupatens as $item)
                                    <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input wire:model="searchTerm" type="search" class="form-control"
                                placeholder="Cara Nama Kecamatan . . " aria-label="Search">
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover card-table table-vcenter text-nowrap">

                        @if (count($datas) != 0)
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kabupaten</th>
                                    <th>Nama Kecamatan</th>
                                    <th class="text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $item)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $item->kabupaten->name }}</td>
                                        <td>{{ $item->name }}</td>
                                        </td>
                                        <td class="text-right">
                                            <i wire:click="selectedItem({{ $item->id }},'update')"
                                                class="fe fe-edit f-16 btn btn-outline-success" style="cursor:
                            pointer"></i>
                                            <i wire:click="selectedItem({{ $item->id }},'delete')"
                                                class="fe fe-trash-2 f-16 btn btn-outline-danger" style="cursor:
                            pointer"></i>
                                        </td>
                                    </tr>
                            </tbody>
                        @endforeach
                    @else
                        There no Data Yet
                        @endif
                    </table>
                    {{ $datas->links() }}

                </div>
            </div>

        </div>
    </div>
</div>
