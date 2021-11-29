<table class="table table-bordered mb-0 text-nowrap">
    <thead>
        <tr>
            <td colspan="15" style="text-align: center; border:none;"><b>DATA PERFORMA / RECORDING</b></td>

        </tr>
        <tr>
            <th>#</th>
            <th>Sapi</th>
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

            <th>Peternak</th>
            <th>Pendamping</th>
            <th>TSR</th>

        </tr>
    </thead>
    <tbody>

        @foreach ($datas as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ 'MBC-' . $item->sapi->generasi . '.' . $item->sapi->anak_ke . '-' . $item->sapi->eartag_induk . '-' . $item->sapi->eartag }}
                </td>
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
                <td>{{ $item->peternak->nama_peternak }}</td>
                <td>{{ $item->pendamping->user->name }}
                </td>
                <td>{{ $item->tsr->user->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
