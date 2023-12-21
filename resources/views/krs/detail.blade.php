@extends('layouts.main')

@section('title', 'Detail KRS')

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
                <h1 class="font-bold text-2xl">Kartu Rencana Studi</h1>
            </div>
            <div class="flex justify-end">
                <a class="btn btn-sm bg-green-500 border-0 hover:bg-green-700 text-white"
                    href="/krs/{{ $mahasiswa->username }}/tambah">Tambah
                    +</a>
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
                <li><a href="/krs">KRS</a></li>
                <li>{{ $mahasiswa->username }}</li>
            </ul>
        </div>
        <div class="flex justify-between items-center mt-4">
            <p class="hidden lg:block font-bold text-gray-700 text-xl">Data KRS</p>
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
        <div class="mt-10">
            <div class="overflow-x-auto">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr class="bg-gray-100 font-bold">
                            <th>No</th>
                            <th>Detail</th>
                            <th>Dosen</th>
                            <th>Jadwal</th>
                            <th>SKS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="data_presensi">
                        <tr v-for="(d,i) in data" :key="d.id">
                            <td class="whitespace-nowrap w-[10px]">@{{ i + 1 }}</td>
                            <td class="whitespace-nowrap w-[10px]">
                                <p class="bg-blue-500 rounded text-xs p-1 text-white font-semibold inline">
                                    @{{ d.kode_mata_kuliah }}
                                </p>
                                <div v-if="d.mata_kuliah" class="w-fit mt-2">
                                    <p class="text-gray-500">
                                        @{{ d.mata_kuliah.nama }}
                                    </p>
                                    <p class="text-gray-500">
                                        Semester @{{ d.mata_kuliah.semester }}
                                    </p>
                                </div>
                            </td>
                            <td>@{{ d.dosen_ampu }}</td>
                            <td>@{{ d.jadwal }}</td>
                            <td>
                                <div v-if="d.mata_kuliah">
                                    @{{ d.mata_kuliah.jumlah_sks }}
                                </div>
                            </td>
                            <td class="flex gap-2">
                                <div class="bg-blue-500 p-2 rounded-lg w-fit text-white">
                                    <a :href="`/krs/{{ $mahasiswa->username }}/${d.id}`">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="bg-red-500 p-2 rounded-lg w-fit text-white">
                                    <button v-on:click="delete_data(d.id)">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-6 h-6">
                                            <path fill-rule="evenodd"
                                                d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                const data = ref([])
                const isLoading = ref(false)

                function getData(tahun_ajaran) {
                    isLoading.value = true
                    fetch(`/api/krs/{{ $mahasiswa->username }}/${tahun_ajaran}`, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json'
                            }
                        }).then(response => response.json())
                        .then(res => {
                            data.value = res.data;
                            console.log(res.data);
                            isLoading.value = false
                        })
                        .catch(error => {
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
                    delete_data,
                    isLoading
                }
            }
        }).mount('#app')
    </script>
@endsection
