<table class="table table-bordered mb-0 text-nowrap">
    <thead>
        <tr>
            <td colspan="10" style="text-align: center; border:none;"><b>DAFTAR SAPI</b></td>
            <td colspan="10" style="text-align: center; border:none;"></td>

        </tr>
        <tr>
            <th>#</th>
            <th>Eartag</th>
            <th>Nama Sapi</th>
            <th>Tgl Lahir</th>
            <th>Umur</th>
            <th>Kelamin</th>
            <th>Jenis Sapi</th>
            <th>Status Sapi</th>
            <th>Peternak</th>
            <th>Pendamping</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($datas as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <a href="{{ route('sapi.show', $item->eartag) }}">

                        {{ 'MBC-' . $item->generasi . '.' . $item->anak_ke . '-' . $item->eartag_induk . '-' . $item->eartag }}
                    </a>
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
            </tr>
        @endforeach
    </tbody>
</table>
