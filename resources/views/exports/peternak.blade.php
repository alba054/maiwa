<table class="table table-bordered mb-0 text-nowrap">
    <thead>
        <tr>
            <td colspan="12" style="text-align: center; border:none;"><b>DAFTAR PETERNAK</b></td>
            <td colspan="12" style="text-align: center; border:none;"></td>

        </tr>
        <tr>
            <th>#</th>
            <th>Kode</th>
            <th>Pendamping</th>
            <th>Nama Peternak</th>
            <th>Tgl Lahir</th>
            <th>Nomor HP</th>
            <th>Anggota</th>
            <th>Luas Lahan</th>
            <th>Kelompok</th>
            <th>Kabupaten</th>
            <th>Kecamatan</th>
            <th>Desa</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($datas as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kode_peternak }}</td>
                <td>{{ $item->pendamping->user->name }}</td>
                <td>{{ $item->nama_peternak }}</td>
                <td>{{ $item->tgl_lahir }}</td>
                <td>{{ $item->no_hp }}</td>
                <td>{{ $item->jumlah_anggota }}</td>
                <td>{{ $item->luas_lahan }}</td>
                <td>{{ $item->kelompok->name }}</td>
                <td>{{ $item->desa->kecamatan->kabupaten->name }}</td>
                <td>{{ $item->desa->kecamatan->name }}</td>
                <td>{{ $item->desa->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
