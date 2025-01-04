<!DOCTYPE html>
<html lang="en">

<head>
    <title>Rekapitulasi Hasil Studi</title>
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
                <h1>Rekapitulasi Hasil Studi</h1>
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

    </table>
    <table width="100%" style="font-size: 10px; ; margin-top: 10px">
        <tbody>
            <tr>
                <td style="padding: 0px; vertical-align: top;">
                    <table class="table" width="@if (count($rekap) > 33) 49% @else 100% @endif">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" style="vertical-align: middle;">No</th>
                                <th style="vertical-align: middle;">Kode</th>
                                <th style="vertical-align: middle;">Mata kuliah</th>
                                <th class="text-center" style="vertical-align: middle;">K</th>
                                <th class="text-center" style="vertical-align: middle;">N</th>
                                <th class="text-center" style="vertical-align: middle;">KxN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekap as $i => $r)
                                <tr>
                                    <td style="text-align: center;">{{ $i + 1 }}</td>
                                    <td style="text-align: center;">{{ $r->kode_mata_kuliah }}</td>
                                    <td>{{ $r->mata_kuliah->nama }}</td>
                                    <td style="text-align: center;">{{ $r->mata_kuliah->jumlah_sks }}</td>
                                    <td style="text-align: center;">{{ $r->huruf }}</td>
                                    <td style="text-align: center;">{{ $r->bobot }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">Jumlah</td>
                                <td style="text-align: center;">{{ $total_sks }}</td>
                                <td></td>
                                <td style="text-align: center;">{{ $total_bobot }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">IPK</td>
                                <td colspan="3" style="text-align: center;">{{ $mahasiswa->ipk() }}</td>
                            </tr>
                            {{-- @if (count($rekap) <= 33)
                                <tr>
                                    <td colspan="3">Jumlah</td>
                                    <td style="text-align: center;">{{ $total_sks }}</td>
                                    <td></td>
                                    <td style="text-align: center;">{{ $total_bobot }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">IPK</td>
                                    <td colspan="3" style="text-align: center;">{{ $mahasiswa->ipk() }}</td>
                                </tr>
                            @endif --}}
                        </tbody>
                    </table>
                </td>
                {{-- @if (count($rekap) > 33)
                    <td width="2%" style="padding: 0px;">&nbsp;</td>
                    <td style="padding: 0px; vertical-align: top;">
                        <table class="table table-condensed table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" style="vertical-align: middle;">No</th>
                                    <th style="vertical-align: middle;">Kode</th>
                                    <th style="vertical-align: middle;">Matakuliah</th>
                                    <th class="text-center" style="vertical-align: middle;">K</th>
                                    <th class="text-center" style="vertical-align: middle;">N</th>
                                    <th class="text-center" style="vertical-align: middle;">KxN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align: center;">34</td>
                                    <td style="text-align: center;">AKBK3421</td>
                                    <td>EKONOMETRIKA*)</td>
                                    <td style="text-align: center;">2</td>
                                    <td style="text-align: center;">A</td>
                                    <td style="text-align: center;">8</td>
                                </tr>
                                @if (count($rekap) > 33)
                                    <tr>
                                        <td colspan="3">Jumlah</td>
                                        <td style="text-align: center;">{{ $total_sks }}</td>
                                        <td></td>
                                        <td style="text-align: center;">{{ $total_bobot }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">IPK</td>
                                        <td colspan="3" style="text-align: center;">{{ $mahasiswa->ipk() }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </td>
                @endif --}}
            </tr>
        </tbody>
    </table>

    <div style="position: fixed; right: 0; font-size: 12px">
        <br>
        <br>
        ................., {{ $tanggal }}
        <br>
        Ketua Program Studi PAI
        <br>
        <br>
        <br>
        <br>
        <br>
        Tri Dina Kartinasari, S.Pd., Gr., M.M
        <br>
    </div>
</body>

</html>
