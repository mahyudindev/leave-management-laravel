<table>
    <thead>
        <tr>
            <th colspan="6" style="text-align: center; font-weight: bold;">LAPORAN CUTI BULAN {{ strtoupper($namaBulan) }}</th>
        </tr>
        <tr>
            <th>Nama Karyawan</th>
            <th>Departemen</th>
            <th>Jabatan</th>
            <th>Jumlah Cuti</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Berakhir</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($laporan as $cuti)
            <tr>
                <td>{{ $cuti->user->name }}</td>
                <td>{{ $cuti->user->departemen->nama ?? '-' }}</td>
                <td>{{ $cuti->user->jabatan->nama ?? '-' }}</td>
                <td>{{ $cuti->jumlah }}</td>
                <td>{{ \Carbon\Carbon::parse($cuti->tanggal_awal)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($cuti->tanggal_akhir)->format('d/m/Y') }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6" style="text-align: right; font-style: italic;">Dicetak pada: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
        </tr>
    </tfoot>
</table>
