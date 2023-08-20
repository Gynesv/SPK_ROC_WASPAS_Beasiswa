<!DOCTYPE html>
<html lang="en">
<head>
    <title>PENILAIAN</title>
    <style type="text/css">

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .table td {
            padding-top: .1rem;
            padding-bottom: .1rem;
            padding-left: .75rem;
            padding-right: .75rem;
            font-size: 1px;
        }

        .table td {
            vertical-align: middle;
            font-size:15px;
        }

        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }

        td{
            font-size: 2px;
        }
        
    </style>
    
</head>
<body>
    <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        
                <td style="text-align: center;">
                    <h3>LAPORAN HASIL PENILAIAN <br>
                        PENERIMA BEASISWA <br>
                        SMAN 9 PADANG
                    </h3>
                </td>

                {{-- <tr>
                    <td style="width: 100px;">Tanggal</td>
                    <td style="width: 5px;">:</td>
                    <td style="width: 200px;">{{ f_tgl_indo($data->transaksi_tgl_masuk) }}</td>
                </tr>

                <tr>
                    <td style="width: 100px;">Admin</td>
                    <td style="width: 5px;">:</td>
                    <td style="width: 200px;">{{ Auth::user()->name }}</td>
                </tr> --}}
    </table>

    <br>

    <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                <td style="font-size:12px; text-align: center">{{ $data->siswa_nama }}</td>
                <td style="font-size:12px; text-align: center">{{ $data->kelas_nama }}</td>
                <td style="font-size:12px; text-align: center">{{ $data->sigma_kali_jumlah }}</td>
                <td style="font-size:12px; text-align: left">{{ $data->sigma_nilai_kali_jumlah }}</td>
                <td style="font-size:12px; text-align: left">{{ $data->sigma_kali_pangkat }}</td>
                <td style="font-size:12px; text-align: left">{{ $data->sigma_nilai_kali_pangkat }}</td>
                <td style="font-size:12px; text-align: center">{{ $data->nilai_qi }}</td>
            </tr>
            @endforeach 
        </tbody>
    </table>

    <br>

 

</body>
</html>