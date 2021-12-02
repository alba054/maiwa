<div>
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">Data Notifikasi</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . ($page = '#')) }}"><i
                            class="fe fe-layers mr-2 fs-14"></i>Notifikasi</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Data Notifikasi</a>
                </li>
            </ol>
        </div>
        <div class="page-rightheader">
            <div class="btn btn-list">

                <button wire:click="openSearchModal" class="btn btn-outline-danger"><i class="fe fe-search mr-1"></i>
                    Pencarian
                </button>
                <button wire:click="exportToExcel" class="btn btn-outline-success"><i class="fe fe-printer"></i>
                    Export to Excel</button>

            </div>
        </div>
    </div>
    <!--End Page header-->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title col-xl-3">Tabel Notifikasi</div>
                    <div class="card-options">

                        <input wire:model="searchTerm" type="search" class="form-control"
                            placeholder="Cari Perlakuan ..." aria-label="Search">

                    </div>

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
                                            <td>{{ 'MBC-' . $item->sapi->generasi . '.' . $item->sapi->anak_ke . '-' . $item->sapi->eartag_induk . '-' . $item->sapi->eartag }}
                                            </td>
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
        <div class="modal fade" role="dialog" tabindex="-1" id="search-form-modal">
            <div class="modal-dialog" role="document">
                @livewire('notif.wire-notif-search')

            </div>
        </div>

        <!-- User Form Modal -->
        <div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
            <div class="modal-dialog" role="document">
                @livewire('wirepeternakform')

            </div>
        </div>
    </div>

</div>
