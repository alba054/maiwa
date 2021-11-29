<table class="table table-bordered mb-0 text-nowrap">
    <thead>
        <tr>
            <td colspan="9" style="text-align: center; border:none;"><b>DATA PERIKSA KEBUNTINGAN</b></td>
            <td colspan="9" style="text-align: center; border:none;"></td>

        </tr>
        <tr>
            <th>#</th>
            <th>Waktu PKB</th>
            <th>Metode</th>
            <th>Hasil</th>
            <th>IB / Kawin Alam</th>
            <th>Sapi</th>
            <th>Peternak</th>
            <th>Pendamping</th>
            <th>TSR</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($datas as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->waktu_pk }}</td>
                <td>{{ $item->metode->metode }}</td>
                <td>{{ $item->hasil->hasil }}</td>
                <td>{{ $item->status ? 'IB' : 'Kawin Alam' }}</td>
                <td>{{ 'MBC-' . $item->sapi->generasi . '.' . $item->sapi->anak_ke . '-' . $item->sapi->eartag_induk . '-' . $item->sapi->eartag }}
                </td>
                <td>{{ $item->peternak->nama_peternak }}</td>
                <td>{{ $item->pendamping->user->name }}
                </td>
                <td>{{ $item->tsr->user->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
