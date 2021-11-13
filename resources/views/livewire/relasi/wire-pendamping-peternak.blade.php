<div class="row">

    <div class="col-xl-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <div class="col">
                    <div class="card-title">Tabel Data</div>

                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">

                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <select class="custom-select" wire:model="tsrId">
                                <option value="">Pilih TSR</option>
                                @foreach ($tsrs as $item)
                                    <option value="{{ $item->id }}"> {{ $item->user->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <select class="custom-select" wire:model="pendampingId">
                                <option value="">Pilih Pendamping</option>
                                @foreach ($pendampings as $item)
                                    <option value="{{ $item->id }}"> {{ $item->user->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <select class="custom-select" wire:model="peternakId">
                                <option value="">Pilih Peternak</option>
                                @foreach ($peternaks as $item)
                                    <option value="{{ $item->id }}"> {{ $item->nama_peternak }} </option>
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



                                    </tr>
                                @endforeach
                            </tbody>
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
