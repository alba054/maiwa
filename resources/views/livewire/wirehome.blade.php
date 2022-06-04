<div>

    <!--Row-->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Sapi {{ $year }}</h3>

                    <div class="card-options">
                        <a href="{{ url('/' . ($page = '#')) }}" class="option-dots" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-horizontal fs-20"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <span wire:click="exportToExcel" class="dropdown-item">Export To Excel</span>
                            <span wire:click="allData" class="dropdown-item">Semua Data</span>

                            @php
                                $last = date('Y') - 5;
                                $now = date('Y');
                            @endphp

                            @for ($i = $now; $i >= $last; $i--)
                                <span class="dropdown-item year" style="cursor:pointer"
                                    data-id="{{ $i }}" id="year">{{ $i }}</span>
                            @endfor
                        </div>


                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter text-nowrap mb-0 table-striped table-bordered border-top">
                            @if (count($sapis) != 0)
                                <thead>
                                    <tr>
                                        <th rowspan="2">#</th>
                                        <th rowspan="2">Eartag</th>
                                        <th rowspan="2">Nama Sapi</th>
                                        <th rowspan="2">Tgl Lahir</th>
                                        <th rowspan="2">Umur</th>
                                        <th rowspan="2">Kelamin</th>
                                        <th rowspan="2">Jenis Sapi</th>
                                        <th rowspan="2">Status Sapi</th>
                                        <th rowspan="2">Jumlah Anak</th>
                                        <th rowspan="2">Peternak</th>
                                        <th rowspan="2">Pendamping</th>
                                        <th colspan="4">PKB</th>
                                        <th colspan="2">IB</th>
                                        <th colspan="2">Performa</th>
                                        <th colspan="2">Perlakuan</th>
                                        <th colspan="3">Panen</th>
                                    </tr>
                                    <tr>
                                        <th>tanggal</th>
                                        <th>metode</th>
                                        <th>hasil</th>
                                        <th>Umur</th>

                                        <th>tanggal</th>
                                        <th>strow</th>



                                        <th>tanggal</th>
                                        <th>keterangan</th>

                                        <th>tanggal</th>
                                        <th>keterangan</th>

                                        <th>tanggal</th>
                                        <th>status</th>
                                        <th>keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sapis as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td><a
                                                    href="{{ route('sapi.show', $item->eartag) }}">{{ 'MBC-' . $item->generasi . '.' . $item->anak_ke . '-' . $item->eartag_induk . '-' . $item->eartag }}</a>
                                            </td>
                                            <td>{{ $item->nama_sapi }}</td>
                                            <td>{{ $item->tanggal_lahir }}</td>
                                            <td>
                                                @php
                                                    date_default_timezone_set('Asia/Makassar');
                                                    $now = now()->format('Y/m/d');
                                                    $bday = Carbon\Carbon::parse($item->tanggal_lahir);
                                                    echo $bday->diffInYears($now) . ' Tahun, ' . $bday->diffInMonths($now) . ' Bulan, ' . $bday->diffInDays($now) . ' Hari';
                                                @endphp
                                            </td>
                                            <td>{{ $item->kelamin }}</td>
                                            <td>{{ $item->jenis_sapi->jenis }}</td>
                                            <td>{{ count($item->panens) == 0 ? 'Budidaya' : $item->panens->last()->status }}
                                            </td>
                                            <td>{{ count($item->anaks) }}</td>
                                            <td>{{ $item->peternak->nama_peternak }}</td>
                                            <td>{{ $item->peternak->pendamping->user->name }}</td>

                                            <td>{{ $item->pkb->last() ? $item->pkb->last()->waktu_pk : '-' }}
                                            </td>
                                            <td>{{ $item->pkb->last() ? $item->pkb->last()->metode->metode : '-' }}
                                            </td>
                                            <td>{{ $item->pkb->last() ? $item->pkb->last()->hasil->hasil : '-' }}
                                            </td>
                                            <td>

                                                @php
                                                    if ($item->pkb->last() && $item->pkb->last()->hasil_id == 1) {
                                                        date_default_timezone_set('Asia/Makassar');
                                                        $now = now()->format('Y/m/d');
                                                        $day = Carbon\Carbon::parse($item->pkb->last()->waktu_pk)
                                                            ->adddays(90)
                                                            ->format('Y/m/d');
                                                        $bday = Carbon\Carbon::parse($day);
                                                        // echo $bday;
                                                        echo $bday->diffInMonths($now) . ' Bulan/ ' . $bday->diffInDays($now) . ' Hari';
                                                    } else {
                                                        echo '-';
                                                    }
                                                    
                                                @endphp

                                            </td>

                                            <td>{{ $item->ib->last() ? $item->ib->last()->waktu_ib : '-' }}
                                            </td>
                                            <td>{{ $item->ib->last() ? $item->ib->last()->strow->kode_batch : '-' }}
                                            </td>

                                            <td>{{ $item->performa->last() ? $item->performa->last()->tanggal_performa : '-' }}
                                            </td>
                                            <td>{{ $item->performa->last() ? $item->performa->last()->bsc : '-' }}
                                            </td>
                                            <td>{{ $item->perlakuan->last() ? $item->perlakuan->last()->tgl_perlakuan : '-' }}
                                            </td>
                                            <td>{{ $item->perlakuan->last() ? $item->perlakuan->last()->ket_perlakuan : '-' }}
                                            </td>

                                            <td>{{ $item->panens->last() ? $item->panens->last()->tgl_panen : '-' }}
                                            </td>
                                            <td>{{ $item->panens->last() ? $item->panens->last()->status : '-' }}
                                            </td>
                                            <td>{{ $item->panens->last() ? $item->panens->last()->keterangan : '-' }}
                                            </td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                There no Data Yet
                            @endif
                        </table>
                        <div class="mt-3">
                            {{ $sapis->links() }}

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--End row-->


    <!-- Row-2 -->
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Analisis Sapi {{ $year }}</h3>

                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-xl-3 col-6">
                            <p class="mb-1">Total Sapi</p>
                            <h3 class="mb-0 fs-20 number-font1">{{ $countSapi . ' Ekor' }}</h3>

                        </div>
                        <div class="col-xl-3 col-6 ">
                            <p class=" mb-1">Total Data Kematian</p>
                            <h3 class="mb-0 fs-20 number-font1">{{ $countKematian . ' Ekor' }}</h3>

                        </div>
                        <div class="col-xl-3 col-6">
                            <p class=" mb-1">Total Data Panen</p>
                            <h3 class="mb-0 fs-20 number-font1">{{ $countPanen . ' Ekor' }}</h3>

                        </div>

                    </div>
                    <div id="echart1" class="chart-tasks chart-dropshadow text-center" wire:ignore></div>
                    <div class="text-center mt-2">
                        <span class="mr-4"><span class="dot-label bg-primary"></span>Data Kelahiran</span>
                        <span><span class="dot-label bg-secondary"></span>Data Kematian</span>
                        <span><span class="dot-label bg-warning"></span>Data Panen</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Activity</h3>
                </div>
                <div class="card-body">
                    <div class="latest-timeline scrollbar3" id="scrollbar3">
                        <ul class="timeline mb-0">
                            @foreach ($laporansPaginate as $item)
                                <li class="mt-0">
                                    <div class="d-flex"><span
                                            class="time-data">{{ $item->perlakuan }}</span><span
                                            class="ml-auto text-muted fs-11">{{ $item->tanggal }}</span></div>
                                    <p class="text-muted fs-12"><span
                                            class="text-info">{{ $item->pendamping->user->name }}</span>
                                        finished
                                        task
                                        on<a href="{{ url('/' . ($page = '#')) }}" class="font-weight-semibold">
                                            {{ 'MBC-' .$item->sapi->generasi .'.' .$item->sapi->anak_ke .'-' .$item->sapi->eartag_induk .'-' .$item->sapi->eartag }}</a>
                                    </p>
                                </li>
                            @endforeach


                        </ul>
                        <div>
                            {{ $laporansPaginate->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row-2 -->
    <!-- Row-3 -->
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Analisis Upah Pendamping</h3>
                    <div class="card-options">
                        <div class="btn-group p-0">
                            <button class="btn btn-outline-light btn-sm" type="button">Week</button>
                            <button class="btn btn-light btn-sm" type="button">Month</button>
                            <button class="btn btn-outline-light btn-sm" type="button">Year</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-xl-3 col-6">
                            <p class="mb-1">Total Pendamping</p>
                            <h3 class="mb-0 fs-20 number-font1">{{ $countPendamping }} Orang</h3>

                        </div>
                        <div class="col-xl-6 col-6 ">
                            <p class=" mb-1">Total Upah Kinerja</p>
                            <h3 class="mb-0 fs-20 number-font1">Rp. {{ number_format($laporans->sum('upah')) }}</h3>

                        </div>

                    </div>
                    <div id="echart2" class="chart-tasks chart-dropshadow text-center" wire:ignore></div>
                    <div class="text-center mt-2">

                        <span><span class="dot-label bg-warning"></span>Data Kinerja</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Analisis Jenis Kelamin Sapi</h3>
                    <div class="card-options">
                        <div class="btn-group p-0">
                            <button class="btn btn-outline-light btn-sm" type="button">Week</button>
                            <button class="btn btn-light btn-sm" type="button">Month</button>
                            <button class="btn btn-outline-light btn-sm" type="button">Year</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">

                        <div class="col-xl-3 col-6 ">
                            <p class=" mb-1">Total Sapi Jantan</p>
                            <h3 class="mb-0 fs-20 number-font1">{{ $sapis->where('kelamin', 'Jantan')->count() }}
                                Ekor
                            </h3>

                        </div>
                        <div class="col-xl-3 col-6 ">
                            <p class=" mb-1">Total Sapi Betina</p>
                            <h3 class="mb-0 fs-20 number-font1">{{ $sapis->where('kelamin', 'Betina')->count() }}
                                Ekor
                            </h3>

                        </div>

                        {{-- <div class="col-xl-3 col-6">
                            <p class=" mb-1">Maximum Units Sold</p>
                            <h3 class="mb-0 fs-20 number-font1">5,876</h3>
                            <p class="fs-12 text-muted"><span class="text-success mr-1"><i
                                        class="fe fe-arrow-up"></i>0.06%</span>this month</p>
                        </div> --}}
                    </div>
                    <div id="echart3" class="chart-tasks chart-dropshadow text-center" wire:ignore></div>
                    <div class="text-center mt-2">
                        <span class="mr-4"><span class="dot-label bg-primary"></span>Data Sapi Jantan</span>
                        <span><span class="dot-label bg-secondary"></span>Data Sapi Betina</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row-3 -->


</div>

@push('script')
    @include('livewire.home.cart1')
    @include('livewire.home.cart2')
    @include('livewire.home.cart3')
    
    <script>
        $(".year").on('click', function(event){
            var data = $(this).attr('data-id');

            @this.set('year', data);

            
        });
    </script>
@endpush
