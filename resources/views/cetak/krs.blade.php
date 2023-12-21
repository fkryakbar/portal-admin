<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kartu Rencana Studi</title>
</head>
<style>
    * {
        font-family: 'Arial', sans-serif;
    }

    h1 {
        font-size: 20px
    }

    .table {
        border-collapse: collapse;
        border: 1px solid rgb(133, 133, 133);
        font-size: 8px;
    }

    .table th,
    .table td {
        border: 1px solid rgb(133, 133, 133);
        padding: 4px;
        font-size: 8px;
    }
</style>

<body>
    <table style="border: none; width:100%">
        <tr style="border: none">
            <th style="border: none">
                <img width="80px" src="https://siamad.stitastbr.ac.id/assets/image/logo.png" alt="">
            </th>
            <th style="border: none">
                <h1>STIT ASSUNNIYYAH TAMBARANGAN</h1>
                <h1>Kartu Rencana Studi</h1>
            </th>
        </tr>
    </table>
    <hr>
    <table style="border: none; font-size: 12px">
        <tr>
            <td style="border: none; padding: 3px">Nama</td>
            <td style="border: none; padding: 3px">: {{ $mahasiswa->name }}</td>
        </tr>
        <tr>
            <td style="border: none; padding: 3px">NIM</td>
            <td style="border: none; padding: 3px">: {{ $mahasiswa->username }}</td>
        </tr>
        <tr>
            <td style="border: none; padding: 3px">Program Studi</td>
            <td style="border: none; padding: 3px">: {{ $mahasiswa->biodata->jurusan->nama_jurusan }}</td>
        </tr>
        <tr>
            <td style="border: none; padding: 3px">Semester</td>
            <td style="border: none; padding: 3px">: {{ $tahun_ajaran->nama_tahun_ajaran }}</td>
        </tr>
    </table>
    <table width="100%" style="font-size: 10px; ; margin-top: 10px" class="table">
        <thead class="thead-light">
            <tr>
                <th class="text-center" style="vertical-align: middle;">No</th>
                <th style="vertical-align: middle;">Kode</th>
                <th style="vertical-align: middle;">Mata kuliah</th>
                <th class="text-center" style="vertical-align: middle;">W/P</th>
                <th class="text-center" style="vertical-align: middle;">SKS</th>
                <th class="text-center" style="vertical-align: middle;">Semester</th>
                <th class="text-center" style="vertical-align: middle;">Jadwal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($krs as $i => $r)
                <tr>
                    <td style="text-align: center;">{{ $i + 1 }}</td>
                    <td style="text-align: center;">{{ $r->kode_mata_kuliah }}</td>
                    <td>{{ $r->mata_kuliah->nama }}</td>
                    <td style="text-align: center;">{{ $r->mata_kuliah->jenis }}</td>
                    <td style="text-align: center;">{{ $r->mata_kuliah->jumlah_sks }}</td>
                    <td style="text-align: center;">{{ $r->mata_kuliah->semester }}</td>
                    <td style="text-align: center;">{{ $r->jadwal }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4">Jumlah</td>
                <td style="text-align: center;">{{ $total_sks }}</td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>

    <div style="position: fixed; right: 0; font-size: 12px">
        <br>
        <br>
        ................., {{ $tanggal }}
        <br>
        <br>
        <br>
        <br>
        <br>
        (...........................................)
        <br>
    </div>
</body>

</html>
