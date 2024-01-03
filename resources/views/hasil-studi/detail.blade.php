@extends('layouts.main')

@section('title', 'Detail Hasil Studi')

@section('head-tag')
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection

@section('content')
    <div class="p-5 min-h-screen" id="app">
        <div class="flex justify-between items-center gap-3">
            <div class="flex gap-2 items-center text-gray-500  mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path fill-rule="evenodd"
                        d="M2.25 2.25a.75.75 0 000 1.5H3v10.5a3 3 0 003 3h1.21l-1.172 3.513a.75.75 0 001.424.474l.329-.987h8.418l.33.987a.75.75 0 001.422-.474l-1.17-3.513H18a3 3 0 003-3V3.75h.75a.75.75 0 000-1.5H2.25zm6.54 15h6.42l.5 1.5H8.29l.5-1.5zm8.085-8.995a.75.75 0 10-.75-1.299 12.81 12.81 0 00-3.558 3.05L11.03 8.47a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l2.47-2.47 1.617 1.618a.75.75 0 001.146-.102 11.312 11.312 0 013.612-3.321z"
                        clip-rule="evenodd" />
                </svg>
                <h1 class="font-bold text-2xl">Hasil Studi</h1>
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
                <li><a href="/hasil-studi">Hasil Studi</a></li>
                <li>{{ $mahasiswa->username }}</li>
            </ul>
        </div>
        <div class="flex justify-between items-center mt-4">
            <p class="block font-bold text-gray-700 text-xl">Hasil Studi</p>
            <div class="flex items-center gap-2 flex-wrap justify-end">
                <a href="/hasil-studi/{{ $mahasiswa->username }}/cetak-rekapitulasi" target="_blank"
                    class="btn bg-blue-500 hover:bg-blue-700 text-white rounded-full w-[160px]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" data-slot="icon" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                    </svg>
                    Rekapitulasi
                </a>
                <div class="dropdown dropdown-end">
                    <button class="btn bg-amber-500 hover:bg-amber-700 text-white rounded-full w-[120px]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" data-slot="icon" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                        </svg>
                        KHS
                    </button>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                        @foreach ($tahun_ajaran as $i => $tahun)
                            <li><a target="_blank"
                                    href="/hasil-studi/{{ $mahasiswa->username }}/{{ $tahun->kode_tahun_ajaran }}/cetak-khs">{{ $tahun->nama_tahun_ajaran }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <table class="text-sm text-gray-700 mt-5">
            <tr>
                <td class="w-[100px]">Nama</td>
                <td>: {{ $mahasiswa->name }}</td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>: {{ $mahasiswa->username }}</td>
            </tr>
            <tr>
                <td>Semester</td>
                <td>: {{ $mahasiswa->semester() }}</td>
            </tr>
            <tr>
                <td>Total SKS</td>
                <td>: {{ $mahasiswa->total_sks() }}</td>
            </tr>
            <tr>
                <td>IPK</td>
                <td>: {{ $mahasiswa->ipk() }}</td>
            </tr>
        </table>
        <div class="flex  justify-end items-center my-3">
            <div class="flex gap-2 items-center">
                <p>Semester</p>
                <select id="tahun-ajaran"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    @foreach ($tahun_ajaran as $i => $tahun)
                        <option v-on:click="getData({{ $tahun->kode_tahun_ajaran }})" @selected($i == 0)
                            value="{{ $tahun->kode_tahun_ajaran }}">
                            {{ $tahun->nama_tahun_ajaran }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-5">
            <div class="overflow-x-auto">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr class="bg-gray-100 font-bold">
                            <th>No</th>
                            <th>Kode</th>
                            <th>Mata Kuliah</th>
                            <th>W/P</th>
                            <th class="text-center">SKS</th>
                            <th class="text-center">Nilai Angka</th>
                            <th class="text-center">Nilai Huruf</th>
                            <th class="text-center">Bobot</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(d, i) in data" :key="d.id">
                            <td class="whitespace-nowrap w-[10px]">
                                @{{ i + 1 }}
                            </td>
                            <td>@{{ d.kode_mata_kuliah }}</td>
                            <td>
                                <div v-if="d.mata_kuliah">@{{ d.mata_kuliah.nama }}</div>
                            </td>
                            <td>
                                <div v-if="d.mata_kuliah">
                                    @{{ d.mata_kuliah.jenis }}
                                </div>
                            </td>
                            <td class="text-center">
                                <div v-if="d.mata_kuliah">
                                    @{{ d.mata_kuliah.jumlah_sks }}
                                </div>
                            </td>
                            <td class="text-center">@{{ d.angka }}</td>
                            <td class="text-center">@{{ d.huruf }}</td>
                            <td class="text-center">@{{ d.bobot }}</td>
                            <td class="flex gap-2 justify-center">
                                <div class="bg-blue-500 p-2 rounded-lg w-fit text-white">
                                    <a :href="`/hasil-studi/{{ $mahasiswa->username }}/${d.id}`">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="!isLoading && data.length > 0" class="bg-gray-100 font-bold">
                            <td colspan="4">
                                <p class="text-center font-bold">Jumlah</p>
                            </td>
                            <td>
                                <p class="text-center font-bold" v-text="total_sks"></p>
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                <p class="text-center font-bold" v-text="total_bobot"></p>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <p v-if="!isLoading && data.length > 0" class="mt-3 font-semibold text-sm">Indeks Prestasi (IP) :
                    @{{ ip }}</p>
            </div>
            <p v-if="isLoading" class="text-center font-semibold mt-5 text-gray-500">Loading ...</p>
            <p v-if="!isLoading && data.length == 0 " class="text-center font-semibold mt-5 text-gray-500">Belum Ada KRS
            </p>
        </div>
    </div>
    <script>
        const tahun_ajaran_toggle = document.getElementById('tahun-ajaran');

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        const {
            createApp,
            ref,
            onMounted
        } = Vue

        createApp({
            setup() {
                const data = ref([]);
                let ip = ref(0);
                let total_bobot = ref(0);
                let total_sks = ref(0);
                const isLoading = ref(false)

                function getData(tahun_ajaran) {
                    isLoading.value = true
                    fetch(`/api/hasil-studi/{{ $mahasiswa->username }}/${tahun_ajaran}`, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json'
                            }
                        }).then(response => response.json())
                        .then(res => {
                            data.value = res.data.khs;
                            ip.value = res.data.ip;
                            total_bobot.value = res.data.total_bobot;
                            total_sks.value = res.data.total_sks;
                            isLoading.value = false
                        })
                        .catch(error => {
                            console.log(error);
                            Toast.fire({
                                icon: 'error',
                                title: 'Something Went Wrong'
                            })
                        });
                }

                function delete_data(id) {
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
                            window.location.href = `/krs/${id}/hapus`
                        }
                    })
                }

                onMounted(() => {
                    $(document).ready(function() {
                        $('#tahun-ajaran').select2().on('change', function(e) {
                            getData(e.target.value)
                        });;
                    })
                    getData(tahun_ajaran_toggle.value)
                })

                return {
                    data,
                    getData,
                    total_bobot,
                    ip,
                    total_sks,
                    delete_data,
                    isLoading
                }
            }
        }).mount('#app')
    </script>
@endsection
