@extends('layouts.main')

@section('title', 'Portal Admin')

@section('content')
    <div class="p-5 min-h-screen">
        <div class="flex justify-between items-center">
            <div class="flex gap-2 items-center text-gray-500  mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path fill-rule="evenodd"
                        d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zM9.75 17.25a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-.75zm2.25-3a.75.75 0 01.75.75v3a.75.75 0 01-1.5 0v-3a.75.75 0 01.75-.75zm3.75-1.5a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-5.25z"
                        clip-rule="evenodd" />
                    <path
                        d="M14.25 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0016.5 7.5h-1.875a.375.375 0 01-.375-.375V5.25z" />
                </svg>
                <h1 class="font-bold text-2xl">Presensi</h1>
            </div>
        </div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="p-3 bg-red-400 rounded-lg my-2">
                    <li>{{ $error }}</li>
                </div>
            @endforeach

        @endif
        @if (session()->has('message'))
            <div class="p-3 bg-green-500 text-white rounded-lg my-2">
                <p>{{ session('message') }}</p>
            </div>
        @endif
        <div class="text-sm breadcrumbs">
            <ul>
                <li><a href="/presensi-dosen">Presensi Dosen</a></li>
                <li>Dosen</li>
            </ul>
        </div>
        <div class="flex justify-between items-center mt-4">
            <p class="hidden lg:block font-bold text-gray-700 text-xl">Data Presensi</p>
            <div class="flex gap-2 items-center">
                <p>Semester</p>
                <select id="tahun-ajaran"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    @foreach ($tahun_ajaran as $i => $tahun)
                        <option @selected($i == 0) value="{{ $tahun->kode_tahun_ajaran }}">
                            {{ $tahun->nama_tahun_ajaran }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-10">
            <div class="overflow-x-auto">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>Waktu Perkuliahan</th>
                            <th>Mata Kuliah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="data_presensi">
                        <tr>
                            <td>Loading...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        const tahun_ajaran_toggle = document.getElementById('tahun-ajaran');
        $(document).ready(function() {
            $('#tahun-ajaran').select2().on('change', function(e) {
                getData(e.target.value)
            });;
        })

        function getData(tahun_ajaran) {
            document.getElementById('data_presensi').innerHTML = `<tr>
                            <td>Loading...</td>
                        </tr>`;
            fetch(`/api/presensi-dosen/{{ $dosen->username }}/${tahun_ajaran}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json'
                    }
                }).then(response => response.json())
                .then(data => {
                    if (data.data.length > 0) {
                        let html = ''
                        data.data.forEach((d) => {
                            html += `<tr>
                                        <td>${d.waktu_perkuliahan}</td>
                                        <td>${d.mata_kuliah}</td>
                                        <td class="flex gap-2">
                                            <div class="bg-blue-500 p-2 rounded-lg w-fit text-white">
                                                <a href="/presensi-dosen/{{ $dosen->username }}/${d.kode_pertemuan}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="bg-red-500 p-2 rounded-lg w-fit text-white">
                                                <button onclick="delete_data('${d.kode_pertemuan}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>`
                        })
                        document.getElementById('data_presensi').innerHTML = html
                    } else {
                        document.getElementById('data_presensi').innerHTML = `<tr>
                            <td>Belum ada data</td>
                        </tr>`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('data_presensi').innerHTML = `<tr>
                            <td>Error</td>
                        </tr>`;
                });
        }
        getData(tahun_ajaran_toggle.value)

        function delete_data(kode_pertemuan) {
            Swal.fire({
                title: 'Yakin mau menghapus data?',
                text: "Data tidak akan bisa dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/presensi-dosen/${kode_pertemuan}/hapus`
                }
            })
        }
    </script>
@endsection
