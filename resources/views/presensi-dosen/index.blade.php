@extends('layouts.main')

@section('title', 'Dosen')

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
                <h1 class="font-bold text-2xl">Presensi Dosen</h1>
            </div>
            <div class="flex justify-end mb-3">
                <div class="dropdown dropdown-end">
                    <label tabindex="0"
                        class="btn btn-sm bg-blue-500 hover:bg-blue-700 border-none flex gap-2 text-white">
                        Cetak
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                        </svg>
                    </label>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                        @foreach ($tahun_ajaran as $i => $tahun)
                            <li><a href="/presensi-dosen/cetak/{{ $tahun->kode_tahun_ajaran }}"
                                    target="_blank">{{ $tahun->nama_tahun_ajaran }}</a></li>
                        @endforeach
                    </ul>
                </div>
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
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Username
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dosen as $i => $d)
                        <tr class="bg-white border-b ">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $i + 1 }}
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $d->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $d->username }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2 text-white">
                                    <a href="/presensi-dosen/{{ $d->username }}" class="w-fit">
                                        <div class="p-2 bg-green-500 rounded-lg w-fit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                    </a>
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
                        <span class="font-medium">{{ $dosen->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium">{{ $dosen->lastItem() }}</span>
                        {!! __('of') !!}
                        <span class="font-medium">{{ $dosen->total() }}</span>
                        {!! __('results') !!}
                    </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                        @if ($dosen->onFirstPage())
                            <span
                                class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-l-md">
                                {!! __('pagination.previous') !!}
                            </span>
                        @else
                            <a href="{{ $dosen->previousPageUrl() }}" rel="prev"
                                class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-l-md hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
                                {!! __('pagination.previous') !!}
                            </a>
                        @endif

                        @for ($page = 1; $page <= $dosen->lastPage(); $page++)
                            @if ($page == $dosen->currentPage())
                                <span
                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-blue-600 bg-blue-100 border border-blue-300 cursor-default leading-5">{{ $page }}</span>
                            @else
                                <a href="{{ $dosen->url($page) }}"
                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:bg-gray-100 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">{{ $page }}</a>
                            @endif
                        @endfor

                        @if ($dosen->hasMorePages())
                            <a href="{{ $dosen->nextPageUrl() }}" rel="next"
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
    <script>
        function delete_data(username) {
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
                    window.location.href = `/dosen/${username}/hapus`
                }
            })
        }
    </script>
@endsection
