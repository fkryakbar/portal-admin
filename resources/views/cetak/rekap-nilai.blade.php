<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daftar Nilai Mahasiswa</title>
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
                <h1>Daftar Nilai Mahasiswa</h1>
            </th>
        </tr>
    </table>
    <hr>
    <table style="border: none; font-size: 12px">
        <tr>
            <td style="border: none; padding: 3px">Tahun Ajaran</td>
            <td style="border: none; padding: 3px">: {{ $kelas->tahun_ajaran->nama_tahun_ajaran }}</td>
        </tr>
        <tr>
            <td style="border: none; padding: 3px">Kelas</td>
            <td style="border: none; padding: 3px">: {{ $kelas->nama }}</td>
        </tr>
        <tr>
            <td style="border: none; padding: 3px">Kode</td>
            <td style="border: none; padding: 3px">: {{ $kelas->mata_kuliah->kode }}</td>
        </tr>
        <tr>
            <td style="border: none; padding: 3px">Mata Kuliah</td>
            <td style="border: none; padding: 3px">: {{ $kelas->mata_kuliah->nama }}</td>
        </tr>
        <tr>
            <td style="border: none; padding: 3px">Semester</td>
            <td style="border: none; padding: 3px">: {{ $kelas->mata_kuliah->semester }}</td>
        </tr>
        <tr>
            <td style="border: none; padding: 3px">SKS</td>
            <td style="border: none; padding: 3px">: {{ $kelas->mata_kuliah->jumlah_sks }}</td>
        </tr>
    </table>
    <div style="font-size: 12px">
        <p>Dosen Pengampu :</p>
        @php
            $index = 1;
        @endphp
        @forelse ($kelas->dosen as $i => $p)
            @if ($p->role == 'dosen')
                <p class="text-gray-600 text-sm ml-3" style="margin-left: 12px">{{ $index }}. {{ $p->name }}
                </p>
                @php
                    $index++;
                @endphp
            @endif
        @empty
            <p class="text-xs text-gray-400">Belum ada dosen yang dipilih</p>
        @endforelse
    </div>
    <table width="100%" style="font-size: 10px; ; margin-top: 10px" class="table">
        <thead class="thead-light">
            <tr>
                <th class="text-center" style="vertical-align: middle;">No</th>
                <th style="vertical-align: middle;">NIM</th>
                <th style="vertical-align: middle;">Nama</th>
                <th class="text-center" style="vertical-align: middle;">Tugas</th>
                <th class="text-center" style="vertical-align: middle;">MT</th>
                <th class="text-center" style="vertical-align: middle;">FT</th>
                <th class="text-center" style="vertical-align: middle;">Angka</th>
                <th class="text-center" style="vertical-align: middle;">Bobot</th>
                <th class="text-center" style="vertical-align: middle;">Huruf</th>
            </tr>
        </thead>
        <tbody>
            @php
                $index = 1;
            @endphp
            @foreach ($mahasiswa as $i => $m)
                <tr>
                    <td style="text-align: center;">{{ $i + 1 }}</td>
                    <td style="text-align: center;">{{ $m->username }}</td>
                    <td>{{ $m->name }}</td>
                    <td style="text-align: center;">{{ $m->kartu_studi[0]->tugas }}</td>
                    <td style="text-align: center;">{{ $m->kartu_studi[0]->uts }}</td>
                    <td style="text-align: center;">{{ $m->kartu_studi[0]->uas }}</td>
                    <td style="text-align: center;">{{ $m->kartu_studi[0]->angka }}</td>
                    <td style="text-align: center;">{{ $m->kartu_studi[0]->bobot }}</td>
                    <td style="text-align: center;">{{ $m->kartu_studi[0]->huruf }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="position: fixed; right: 0; font-size: 12px">
        <br>
        <br>
        Mengetahui, ................., {{ $tanggal }}
        <br>
        <br>
        <br>
        <br>
        <br>
        (...........................................)
        <br>
        NIP.
    </div>
</body>

</html>
