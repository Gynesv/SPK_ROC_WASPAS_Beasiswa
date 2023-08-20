<!DOCTYPE html>
<html lang="en">
<head>
    <title>HASIL PENILAIAN</title>
</head>


<body>
<h3>HASIL PENILAIAN</h3>
<br>
<table>
    <thead>
        <tr>
            <th style="text-align: center" rowspan="2">RANKING</th>
            <th style="text-align: center" colspan="3">SISWA</th>
            <th style="text-align: center" colspan="4">NILAI SIGMA</th>
            <th style="text-align: center" rowspan="2">Nilai Qi</th>
        </tr>
        <tr>
            <th style="text-align: center">NISN</th>
            <th style="text-align: center">NAMA</th>
            <th style="text-align: center">KELAS</th>

            <th style="text-align: center">NILAI TAMBAH</th>
            <th style="text-align: center">NILAI KALI [0.5]</th>
            <th style="text-align: center">NILAI PANGKAT</th>
            <th style="text-align: center">NILAI KALI [0.5]</th>

        </tr>
    </thead>
    <tbody>
        {{ $no=1 }}
            @foreach($data_sigma as $data)
            <tr>
                <td style="font-size:12px; text-align: center">{{ $no++ }}</td>
                <td style="font-size:12px; text-align: left">{{ $data->siswa_nisn }}</td>
                <td style="font-size:12px; text-align: left">{{ $data->siswa_nama }}</td>
                <td style="font-size:12px; text-align: center">{{ $data->kelas_nama }}</td>
                <td style="font-size:12px; text-align: center">{{ $data->sigma_kali_jumlah }}</td>
                <td style="font-size:12px; text-align: center">{{ $data->sigma_nilai_kali_jumlah }}</td>
                <td style="font-size:12px; text-align: center">{{ $data->sigma_kali_pangkat }}</td>
                <td style="font-size:12px; text-align: center">{{ $data->sigma_nilai_kali_pangkat }}</td>
                <td style="font-size:12px; text-align: center">{{ $data->nilai_qi }}</td>
            </tr>
            @endforeach
    </tbody>
</table>
</body>
</html>