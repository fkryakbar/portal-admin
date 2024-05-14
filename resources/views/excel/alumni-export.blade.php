<table>
    <thead>
        <tr>
            <th>No Ijazah</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jenjang Pendidikan</th>
            <th>Program Studi</th>
            <th>Tanggal Lulus</th>
            <th>Link Verifikasi</th>
            <th>Link QR Code</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($alumni as $a)
            <tr>
                <td>{{ $a->no_ijazah }}</td>
                <td>{{ $a->nama }}</td>
                <td>{{ $a->nim }}</td>
                <td>{{ $a->jenjang_pendidikan }}</td>
                <td>{{ $a->program_studi }}</td>
                <td>{{ $a->tanggal_lulus }}</td>
                <td><a
                        href="https://ijazah.stitastbr.ac.id/verifikasi/{{ $a->u_id }}">https://ijazah.stitastbr.ac.id/verifikasi/{{ $a->u_id }}</a>
                </td>
                <td>
                    <a
                        href="https://api.qrserver.com/v1/create-qr-code/?size=150x150&amp;data=https://ijazah.stitastbr.ac.id/verifikasi/{{ $a->u_id }}">https://api.qrserver.com/v1/create-qr-code/?size=150x150&amp;data=https://ijazah.stitastbr.ac.id/verifikasi/{{ $a->u_id }}</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
