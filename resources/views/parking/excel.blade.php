<table>
    <thead>
        <tr>
            <td rowspan=2 colspan=11 style="text-align:center"><b>REKAP LAPORAN PARKIR <br> PERIODE </b></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>No.</td>
            <td>Jenis Kendaraan</td>
            <td>Operator</td>
            <td>Plat Nomor</td>
            <td>Tanggal</td>
            <td>Jam Masuk</td>
            <td>Jam Masuk</td>
            <td>Tagihan</td>
            <td>Status</td>
        </tr>
        @php
        $i = 0;
        @endphp
        @foreach($parking as $parkings)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $parkings->Vehicle->name }}</td>
            <td>{{ $parkings->User->name }}</td>
            <td>{{ $parkings->vehicle_number }}</td>
            <td>{{ $parkings->date }}</td>
            <td>{{ $parkings->time_in }}</td>
            <td>{{ $parkings->time_out }}</td>
            <td>{{ $parkings->bill }}</td>
            <td>
                @if ($parkings->time_out == null)
                    Belum Keluar
                @else
                    Sudah Keluar
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>