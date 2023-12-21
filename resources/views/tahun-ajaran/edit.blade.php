@extends('layouts.main')

@section('title', 'Edit Tahun Ajaran')
@section('head-tag')
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
@section('content')
    <div class="p-5 min-h-screen">
        <div class="flex justify-between items-center">
            <div class="flex gap-2 items-center text-gray-500  mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path
                        d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                    <path fill-rule="evenodd"
                        d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z"
                        clip-rule="evenodd" />
                </svg>
                <h1 class="font-bold text-2xl">Edit Tahun Ajaran</h1>
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
                <li><a href="/tahun-ajaran">Tahun Ajaran</a></li>
                <li>Edit</li>
            </ul>
        </div>
        <form action="" method="POST" class="mt-5">
            @csrf
            <div class="mb-6">
                <label for="kode_tahun_ajaran" class="block mb-2 text-sm font-medium text-gray-900">Kode Tahun
                    Ajaran</label>
                <input type="text" id="kode_tahun_ajaran" value="{{ $tahun_ajaran->kode_tahun_ajaran }}" disabled
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 cursor-not-allowed"
                    placeholder="ex. 23241, untuk Tahun Ajaran Ganjil 2023/2024">
            </div>
            <div class="mb-6">
                <label for="nama_tahun_ajaran" class="block mb-2 text-sm font-medium text-gray-900">Nama Tahun
                    Ajaran</label>
                <input type="text" id="nama_tahun_ajaran" name="nama_tahun_ajaran"
                    value="{{ $tahun_ajaran->nama_tahun_ajaran }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                    placeholder="ex. Ganjil 2023/2024">
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900">Isi KRS</label>
                <div class="flex">
                    <div class="flex items-center mr-4">
                        <input id="inline-radio" type="radio" value="1" name="isi_krs" @checked($tahun_ajaran->isi_krs == 1)
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500   focus:ring-2 ">
                        <label for="inline-radio" class="ml-2 text-sm font-medium text-gray-900 ">Ya</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input id="inline-2-radio" type="radio" value="0" name="isi_krs" @checked($tahun_ajaran->isi_krs == 0)
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500   focus:ring-2 ">
                        <label for="inline-2-radio" class="ml-2 text-sm font-medium text-gray-900 ">Tidak</label>
                    </div>
                </div>
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900">Isi Nilai</label>
                <div class="flex">
                    <div class="flex items-center mr-4">
                        <input id="inline-radio" type="radio" value="1" name="isi_nilai" @checked($tahun_ajaran->isi_nilai == 1)
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500   focus:ring-2 ">
                        <label for="inline-radio" class="ml-2 text-sm font-medium text-gray-900 ">Ya</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input id="inline-2-radio" type="radio" value="0" name="isi_nilai"
                            @checked($tahun_ajaran->isi_nilai == 0)
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500   focus:ring-2 ">
                        <label for="inline-2-radio" class="ml-2 text-sm font-medium text-gray-900 ">Tidak</label>
                    </div>
                </div>
            </div>
            <button type="submit"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
        </form>
    </div>
@endsection
