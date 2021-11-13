<div class="row">
    <div class="col-xl-3 col-lg-4">

        <div class="card">
            <div class="card-header">
                <div class="card-title">Tambah Status Sapi</div>
            </div>
            <div class="card-body">
                <div class="text-center mb-5">
                    <div class="widget-user-image">
                        <img alt="User Avatar" class="rounded-circle  mr-3"
                            src="{{ URL::asset('assets/images/users/2.jpg') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Status Sapi<span class="text-danger">*</span></label>
                    <input wire:model="status" type="text" class="form-control" placeholder="e.g: Sapi Asep">
                    @error('status')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Keterangan Status<span class="text-danger">*</span></label>
                    <input wire:model="ket_status" type="text" class="form-control" placeholder="e.g: Sapi Asep">
                    @error('ket_status')
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
                    <div class="card-title">Tabel Status Sapi</div>

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

                        @if (count($statussapis) != 0)
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th>Keterangan Status</th>
                                    <th class="text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statussapis as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->ket_status }}</td>

                                        <td class="text-right">
                                            <i wire:click="selectedItem({{ $item->id }},'update')"
                                                class="fe fe-edit f-16 btn btn-outline-success"
                                                style="cursor:pointer"></i>
                                            <i wire:click="selectedItem({{ $item->id }},'delete')"
                                                class="fe fe-trash-2 f-16 btn btn-outline-danger"
                                                style="cursor:pointer"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @else
                            There no Data Yet
                        @endif



                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
