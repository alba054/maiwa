<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card overflow-hidden">
            <div class="item7-card-img px-4 pt-4">
                <a href="{{ url('/' . ($page = '#')) }}"></a>
                <img src="{{ url('storage/photos/' . $sapi->foto_depan) }}" alt="img" class="cover-image br-7 w-100"
                    height="500px">
            </div>
            <div class="card-body">
                <div class="item7-card-desc d-md-flex mb-5">
                    <a href="{{ url('/' . ($page = '#')) }}" class="d-flex mr-4 mb-2"><i
                            class="fe fe-calendar fs-16 mr-1"></i>
                        <div class="mt-0">{{ $sapi->tanggal_lahir }}</div>
                    </a>
                    <a href="{{ url('/' . ($page = '#')) }}" class="d-flex mb-2"><i
                            class="fe fe-user fs-16 mr-1"></i>
                        <div class="mt-0">@php
                            date_default_timezone_set('Asia/Makassar');
                            $now = now()->format('Y/m/d');
                            $bday = Carbon\Carbon::parse($sapi->tanggal_lahir);
                            echo $bday->diffInYears($now) . ' Tahun, ' . $bday->diffInMonths($now) . ' Bulan, ' . $bday->diffInDays($now) . ' Hari';
                        @endphp</div>
                    </a>
                    <div class="ml-auto mb-2">
                        <a class="mr-0 d-flex" href="{{ url('/' . ($page = '#')) }}"><i
                                class="fe fe-user fs-16 mr-1"></i>
                            <div class="mt-0">{{ $sapi->peternak->pendamping->user->name }}</div>
                        </a>
                    </div>
                </div>
                <a href="{{ url('/' . ($page = '#')) }}" class="mt-4">
                    <h5 class="font-weight-semibold">{{ $sapi->eartag }}</h5>
                </a>
                Nama Sapi {!! $sapi->nama_sapi !!}
                <div>
                    Jenis Sapi {!! $sapi->jenis_sapi->jenis !!}

                </div>
                <div>
                    Status Sapi {!! $sapi->status_sapi->status . ' , ' . $sapi->status_sapi->ket_status !!}

                </div>

            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Performa (Recording)</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover card-table table-vcenter text-nowrap">

                        @if (count($sapi->performa) != 0)
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal Performa</th>
                                    <th>Tinggi Badan</th>
                                    <th>Berat Badan</th>
                                    <th>Panjang Badan</th>
                                    <th>Lingkar Dada</th>
                                    <th>BCS</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sapi->performa as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tanggal_performa }}</td>
                                        <td>{{ $item->tinggi_badan }} cm</td>
                                        <td>{{ $item->berat_badan }} kg</td>
                                        <td>{{ $item->panjang_badan }} cm</td>
                                        <td>{{ $item->lingkar_dada }} cm</td>
                                        <td>{{ $item->bsc }}</td>


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

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Perlakuan Kesehatan</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover card-table table-vcenter text-nowrap">

                        @if (count($sapi->perlakuan) != 0)
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tgl Perlakuan</th>
                                    <th>Jenis Obat</th>
                                    <th>Dosis Obat</th>
                                    <th>Vaksin</th>
                                    <th>Dosis Vaksin</th>
                                    <th>Vitamin</th>
                                    <th>Dosis Vitamin</th>
                                    <th>Hormon</th>
                                    <th>Dosis Hormon</th>
                                    <th>Ket Perlakuan</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sapi->perlakuan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tgl_perlakuan }}</td>
                                        <td>{{ $item->obat->name }}</td>
                                        <td>{{ $item->dosis_obat }}</td>
                                        <td>{{ $item->vaksin->name }}</td>
                                        <td>{{ $item->dosis_vaksin }}</td>
                                        <td>{{ $item->vitamin->name }}</td>
                                        <td>{{ $item->dosis_vitamin }}</td>
                                        <td>{{ $item->hormon->name }}</td>
                                        <td>{{ $item->dosis_hormon }}</td>
                                        <td>{{ $item->ket_perlakuan }}</td>
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

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Insiminiasi Buatan</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover card-table table-vcenter text-nowrap">

                        @if (count($sapi->ib) != 0)
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Waktu IB</th>
                                    <th>S/C</th>
                                    <th>Strow</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sapi->ib as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->waktu_ib }}</td>
                                        <td>{{ $item->dosis_ib }}</td>
                                        <td>{{ $item->strow->kode_batch }}</td>


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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Periksa Kebuntingan</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover card-table table-vcenter text-nowrap">

                        @if (count($sapi->pkb) != 0)
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Waktu PKB</th>
                                    <th>Metode</th>
                                    <th>Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sapi->pkb as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->waktu_pk }}</td>
                                        <td>{{ $item->metode->metode }}</td>
                                        <td>{{ $item->hasil->hasil }}</td>
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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Panen</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover card-table table-vcenter text-nowrap">

                        @if (count($sapi->panens) != 0)
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Waktu Panen</th>
                                    <th>Panen Ke</th>
                                    <th>Keterangan Panen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sapi->panens as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tgl_panen }}</td>
                                        <td>{{ $item->frek_panen }}</td>
                                        <td>{{ $item->ket_panen }}</td>
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
