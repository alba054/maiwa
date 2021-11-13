<div>
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title col-xl-3">Tabel Notifikasi</div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover card-table table-vcenter text-nowrap">

                        @if (count($datas) != 0)
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Eartag Sapi</th>
                                    <th>Peternak</th>
                                    <th>Pendamping</th>
                                    <th>TSR</th>
                                    <th>Pesan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->sapi->eartag }}</td>
                                        <td>{{ $item->sapi->peternak->nama_peternak }}</td>
                                        <td>{{ $item->sapi->peternak->pendamping->user->name }}</td>
                                        <td>{{ $item->sapi->peternak->pendamping->tsr->user->name }}</td>
                                        <td>{{ $item->pesan }}</td>
                                        <td>{{ $item->status == 'no' ? 'Belum' : 'Sudah' }}</td>
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

    <!-- User Form Modal -->
    <div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
        <div class="modal-dialog" role="document">
            @livewire('wirepeternakform')

        </div>
    </div>
</div>
