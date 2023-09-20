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

    .font-base {
        font-size: 12px
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
                <h1>Rekap Presensi Dosen</h1>
            </th>
        </tr>
    </table>
    <hr>

    {{-- <p class="font-base">{{ $i + 1 }}. {{ $d->name }}</p> --}}
    <p class="font-base" style="text-align: center; margin: 0px">Semester</p>
    <p class="font-base" style="text-align: center; margin-top: 5px; font-weight: 700">
        {{ $tahun_ajaran->nama_tahun_ajaran }}</p>
    <div>
        @php
            $nomer = 1;
        @endphp
        @foreach ($presensi as $i => $p)
            <p class="font-base">{{ $nomer }}. {{ $i }}</p>
            @php
                $nomer += 1;
            @endphp
            <table class="table" style="width: 100%; margin-left: 15px">
                <!-- head -->
                <thead>
                    <tr class="bg-gray-100 font-bold text-black">
                        <th>No</th>
                        <th>Waktu Perkuliahan</th>
                        <th>Mata Kuliah</th>
                        <th>Jumlah Mahasiswa</th>
                        <th>Mahasiswa Tidak Hadir</th>
                        <th>Aktivitas Perkuliahan</th>
                        <th>SKS</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_sks = 0;
                    @endphp
                    @foreach ($p as $i => $item)
                        <tr>
                            <td style="white-space: nowrap; text-align: center">
                                {{ $i + 1 }}</td>
                            <td style="text-align: center">
                                {{ $item->waktu_perkuliahan }}
                            </td>
                            <td>{{ $item->mata_kuliah }}</td>
                            <td style="text-align: center">{{ $item->jumlah_mahasiswa }}</td>
                            <td style="text-align: center">{{ $item->mahasiswa_tidak_hadir }}</td>
                            <td>{{ $item->aktivitas }}</td>
                            <td style="text-align: center">
                                @if ($item->jumlah_sks)
                                    @php
                                        $total_sks += (int) $item->jumlah_sks;
                                    @endphp
                                    {{ $item->jumlah_sks }} SKS
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <td colspan="6" style="text-align: center">Total SKS</td>
                    <td style="text-align: center">{{ $total_sks }} SKS</td>
                </tbody>
            </table>
        @endforeach
    </div>


</body>

</html>
