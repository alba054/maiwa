<table class="table table-bordered mb-0 text-nowrap">
    <thead>
        <tr>
            <td colspan="2" style="text-align: center; border:none;"><b>DAFTAR KELOMPOK PETERNAK</b></td>
            <td colspan="2" style="text-align: center; border:none;"></td>
        </tr>
        <tr>
            <th>#</th>
            <th>Nama Kelompok</th>

        </tr>
    </thead>
    <tbody>

        @foreach ($datas as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
