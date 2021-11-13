<div class="row">
    <div class="col-xl-3 col-lg-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tambah Hormon</div>
            </div>
            <div class="card-body">
                <div class="text-center mb-5">
                    <div class="widget-user-image">
                        <img alt="User Avatar" class="rounded-circle  mr-3"
                            src="{{ URL::asset('assets/images/users/2.jpg') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Hormon</label>
                    <input wire:model="name" type="text" class="form-control" placeholder="e.g: synovac">
                    @error('name')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Detail Hormon</label>
                    <input wire:model="detail" type="text" class="form-control" placeholder="e.g: imun corona">
                    @error('detail')
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
                    <div class="card-title">Tabel Hormon</div>
                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input wire:model="searchTerm" type="search" class="form-control" placeholder="Search…"
                                aria-label="Search">
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover card-table table-vcenter text-nowrap">

                        @if (count($datas) != 0)
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Hormon</th>
                                    <th>Keterangan</th>
                                    <th class="text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $item)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->detail }}</td>
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
                </div>
            </div>

        </div>
    </div>
</div>
