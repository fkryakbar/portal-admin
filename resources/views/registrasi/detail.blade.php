@extends('layouts.main')

@section('title', 'Registrasi Akademik')

@section('content')
    <div class="lg:p-5 p-2 min-h-screen">
        <div class="flex gap-2 items-center text-gray-500  mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                <path fill-rule="evenodd"
                    d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z"
                    clip-rule="evenodd" />
            </svg>
            <h1 class="font-bold text-2xl">Registrasi Akademik</h1>
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

        <div>
            <table class="table border-none lg:w-[30%] lg:text-lg">
                <tbody>
                    <tr class="border-0">
                        <td class="p-1 font-semibold">Jumlah Mahasiswa</td>
                        <td class="p-1">: {{ count($riwayat_registrasi) }}</td>
                    </tr>
                    <tr class="border-0">
                        <td class="p-1 font-semibold">Mahasiswa Sudah Registrasi</td>
                        <td class="p-1">: {{ count($belum_registrasi) }}</td>
                    </tr>
                    <tr class="border-0">
                        <td class="p-1 font-semibold">Mahasiswa Belum Registrasi</td>
                        <td class="p-1">: {{ count($riwayat_registrasi) - count($belum_registrasi) }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="flex items-center justify-end space-x-4 mt-5">
                <div class="form-control flex">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="text" placeholder="Cari" name="search" class="input input-bordered"
                                value="{{ request('search') }}" />
                            <button class="btn btn-square" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="relative overflow-x-auto mt-5">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                NIM
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Bukti
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ubah Verifikasi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswa as $i => $m)
                            <tr class="bg-white border-b font-medium text-gray-900 whitespace-nowrap ">
                                <td class="px-6 py-4">
                                    {{ $i + 1 }}
                                </td>
                                <th scope="row" class="px-6 py-4">
                                    @if ($m->mahasiswa)
                                        {{ $m->mahasiswa->name }}
                                    @else
                                        -
                                    @endif
                                </th>
                                <td class="px-6 py-4">
                                    {{ $m->username }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($m->file_bukti_path)
                                        <a href="{{ asset('storage/' . $m->file_bukti_path) }}" target="_blank">
                                            <div class="bg-blue-500 text-white font-semibold p-2 rounded-lg mt-1 w-fit">
                                                Buka File
                                            </div>
                                        </a>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($m->status_registrasi == 'pending')
                                        <div
                                            class="p-1 rounded-lg bg-amber-500 uppercase text-white font-semibold w-fit text-sm">
                                            {{ $m->status_registrasi }}
                                        </div>
                                    @else
                                        <div
                                            class="p-1 rounded-lg bg-green-500 uppercase text-white font-semibold w-fit text-sm">
                                            {{ $m->status_registrasi }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2 text-white">
                                        <button onclick="change_status('{{ $m->username }}')"
                                            class="p-2 bg-blue-500 rounded-lg text-xs">
                                            Ubah Status
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
                <div
                    class="lg:flex-1 flex lg:flex-nowrap flex-wrap gap-2 flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="text-sm text-gray-700 leading-5">
                            {!! __('Showing') !!}
                            <span class="font-medium">{{ $mahasiswa->firstItem() }}</span>
                            {!! __('to') !!}
                            <span class="font-medium">{{ $mahasiswa->lastItem() }}</span>
                            {!! __('of') !!}
                            <span class="font-medium">{{ $mahasiswa->total() }}</span>
                            {!! __('results') !!}
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                            @if ($mahasiswa->onFirstPage())
                                <span
                                    class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-l-md">
                                    {!! __('pagination.previous') !!}
                                </span>
                            @else
                                <a href="{{ $mahasiswa->previousPageUrl() }}" rel="prev"
                                    class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-l-md hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
                                    {!! __('pagination.previous') !!}
                                </a>
                            @endif

                            @for ($page = 1; $page <= $mahasiswa->lastPage(); $page++)
                                @if ($page == $mahasiswa->currentPage())
                                    <span
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-blue-600 bg-blue-100 border border-blue-300 cursor-default leading-5">{{ $page }}</span>
                                @else
                                    <a href="{{ $mahasiswa->url($page) }}"
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:bg-gray-100 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">{{ $page }}</a>
                                @endif
                            @endfor

                            @if ($mahasiswa->hasMorePages())
                                <a href="{{ $mahasiswa->nextPageUrl() }}" rel="next"
                                    class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-r-md hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
                                    {!! __('pagination.next') !!}
                                </a>
                            @else
                                <span
                                    class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-r-md">
                                    {!! __('pagination.next') !!}
                                </span>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function change_status(username) {
            Swal.fire({
                title: 'Ubah Status Verifikasi?',
                text: "Status akan berubah menjadi terverifikasi atau pending",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Ubah!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/registrasi/{{ $kode_tahun_ajaran }}/${username}`
                }
            })
        }
    </script>
@endsection
