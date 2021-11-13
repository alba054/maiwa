<div class="row">
    <div class="col-xl-3 col-lg-4">

        <div class="card">
            <div class="card-header">
                <div class="card-title">Tambah Data</div>
            </div>
            <div class="card-body">
                <div class="text-center mb-5">
                    <div class="widget-user-image">
                        <img alt="User Avatar" class="rounded-circle  mr-3"
                            src="{{ URL::asset('assets/images/users/2.jpg') }}">
                    </div>
                </div>



                <div class="form-group">
                    <label class="form-label">Pilih Peternak<span class="text-danger">*</span></label>
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
                <div class="dimmer active" style="height: 5px; margin-top: 0;" wire:loading>
                    <div class="spinner4">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>

            </div>
            <div class="card-footer text-right">
                <button wire:click="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-lg-8">
        <div class="card">
            <div class="card-header">
                <div class="col">
                    <div class="card-title">Tabel Data</div>

                </div>

            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-sm-4">
                        <div class="form-group">
                            <select class="custom-select" wire:model="pendampingId">
                                <option value="">Please Choose</option>
                                @foreach ($pendampings as $item)
                                    <option value="{{ $item->id }}"> {{ $item->user->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <select class="custom-select" wire:model="peternakId">
                                <option value="">Please Choose</option>
                                @foreach ($peternaks as $item)
                                    <option value="{{ $item->id }}"> {{ $item->nama_peternak }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <select class="custom-select" wire:model="sapiId">
                                <option value="">Please Choose</option>
                                @foreach ($sapis as $item)
                                    <option value="{{ $item->id }}"> {{ $item->eartag }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover card-table table-vcenter text-nowrap">

                        @if (count($datas) != 0)
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Nama TSR</th>
                                    <th>Nama Pendamping</th>
                                    <th>Nama Peternak</th>
                                    <th>Eartag Sapi</th>
                                    <th class="text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->tsr->user->name }}</td>
                                        <td>{{ $item->pendamping->user->name }}</td>
                                        <td>{{ $item->peternak->nama_peternak }}</td>
                                        <td>{{ $item->sapi->eartag }}</td>


                                        <td class="text-right">
                                            <i wire:click="selectedItem({{ $item->id }},'update')"
                                                class="fe fe-edit f-16 btn btn-success" style="cursor:pointer"></i>
                                            <i wire:click="selectedItem({{ $item->id }},'delete')"
                                                class="fe fe-trash-2 f-16 btn btn-danger" style="cursor:pointer"></i>
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
