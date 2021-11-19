<table class="table table-bordered mb-0 text-nowrap">
    <thead>
        <tr>
            <td colspan="22" style="text-align: center; border:none;"><b>DAFTAR POPULASI SAPI</b></td>
            <td colspan="22" style="text-align: center; border:none;"></td>

        </tr>
        <tr>
            <th rowspan="2">#</th>
            <th rowspan="2"><b>EARTAG</b></th>
            <th rowspan="2"><b>NAMA SAPI</b></th>
            <th rowspan="2"><b>TANGGAL LAHIR</b></th>
            <th rowspan="2"><b>UMUR</b></th>
            <th rowspan="2"><b>KELAMIN</b></th>
            <th rowspan="2"><b>JENIS SAPI</b></th>
            <th rowspan="2"><b>STATUS SAPI</b></th>
            <th rowspan="2"><b>PETERNAK</b></th>
            <th rowspan="2"><b>PENDAMPING</b></th>
            <th colspan="2"><b>IB</b></th>
            <th colspan="3"><b>PKB</b></th>
            <th colspan="2"><b>PERFORMA</b></th>
            <th colspan="2"><b>PERLAKUAN</b></th>
            <th colspan="3"><b>PANEN</b></th>
        </tr>
        <tr>
            <th><b>TANGGAL</b></th>
            <th><b>STRAW</b></th>

            <th><b>TANGGAL</b></th>
            <th><b>METODE</b></th>
            <th><b>HASIL</b></th>

            <th><b>TANGGAL</b></th>
            <th><b>KETERANGAN</b></th>

            <th><b>TANGGAL</b></th>
            <th><b>KETERANGAN</b></th>

            <th><b>TANGGAL</b></th>
            <th><b>FREKUENSI</b></th>
            <th><b>KETERANGAN</b></th>
        </tr>

    </thead>
    <tbody>

        @foreach ($sapis as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->eartag }}
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
                <td>{{ $item->status_sapi->status }}</td>
                <td>{{ $item->peternak->nama_peternak }}</td>
                <td>{{ $item->peternak->pendamping->user->name }}</td>
                <td>{{ $item->ib->last() ? $item->ib->last()->waktu_ib : '-' }}
                </td>
                <td>{{ $item->ib->last() ? $item->ib->last()->strow->kode_batch : '-' }}
                </td>
                <td>{{ $item->pkb->last() ? $item->pkb->last()->waktu_pk : '-' }}
                </td>
                <td>{{ $item->pkb->last() ? $item->pkb->last()->metode->metode : '-' }}
                </td>
                <td>{{ $item->pkb->last() ? $item->pkb->last()->hasil->hasil : '-' }}
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
                <td>{{ $item->panens->last() ? $item->panens->last()->frek_panen : '-' }}
                </td>
                <td>{{ $item->panens->last() ? $item->panens->last()->ket_panen : '-' }}
                </td>


            </tr>

        @endforeach

    </tbody>
</table>
