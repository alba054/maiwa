<table class="table table-bordered mb-0 text-nowrap">
    <thead>
        <tr>
            <td colspan="8" style="text-align: center; border:none;"><b>DATA NOTIFIKASI</b></td>

        </tr>
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
</table>
