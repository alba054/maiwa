<table class="table table-bordered mb-0 text-nowrap">
    <thead>
        <tr>
            <td colspan="11" style="text-align: center; border:none;"><b>DATA PERFORMA / RECORDING</b></td>

        </tr>
        <tr>
            <th>#</th>
            <th>Tanggal Performa</th>
            <th>Sapi</th>
            <th>Tinggi Badan</th>
            <th>Berat Badan</th>
            <th>Panjang Badan</th>
            <th>Lingkar Dada</th>
            <th>BCS</th>
            <th>Peternak</th>
            <th>Pendamping</th>
            <th>TSR</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($datas as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->tanggal_performa }}</td>
                <td>{{ 'MBC-' . $item->sapi->generasi . '.' . $item->sapi->anak_ke . '-' . $item->sapi->eartag_induk . '-' . $item->sapi->eartag }}
                </td>
                <td>{{ $item->tinggi_badan }}</td>
                <td>{{ $item->berat_badan }}</td>
                <td>{{ $item->panjang_badan }}</td>
                <td>{{ $item->lingkar_dada }}</td>
                <td>{{ $item->bsc }}</td>
                <td>{{ $item->peternak->nama_peternak }}</td>
                <td>{{ $item->pendamping->user->name }}
                </td>
                <td>{{ $item->tsr->user->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
