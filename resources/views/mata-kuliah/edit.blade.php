@extends('layouts.main')

@section('title', 'Edit Mata Kuliah')
@section('head-tag')
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
@section('content')
    <div class="lg:p-5 p-2 min-h-screen">
        <div class="flex justify-between items-center">
            <div class="flex gap-2 items-center text-gray-500  mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path
                        d="M11.644 1.59a.75.75 0 01.712 0l9.75 5.25a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.712 0l-9.75-5.25a.75.75 0 010-1.32l9.75-5.25z" />
                    <path
                        d="M3.265 10.602l7.668 4.129a2.25 2.25 0 002.134 0l7.668-4.13 1.37.739a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.71 0l-9.75-5.25a.75.75 0 010-1.32l1.37-.738z" />
                    <path
                        d="M10.933 19.231l-7.668-4.13-1.37.739a.75.75 0 000 1.32l9.75 5.25c.221.12.489.12.71 0l9.75-5.25a.75.75 0 000-1.32l-1.37-.738-7.668 4.13a2.25 2.25 0 01-2.134-.001z" />
                </svg>
                <h1 class="font-bold text-2xl">Edit Mata Kuliah</h1>
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
        <form action="" method="POST" class="mt-5">
            @csrf
            <div class="mb-6">
                <label for="kode" class="block mb-2 text-sm font-medium text-gray-900">Kode Mata Kuliah</label>
                <input type="text" id="kode" name="kode" value="{{ $matkul->kode }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                    placeholder="TAR2007">
            </div>
            <div class="mb-6">
                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Mata Kuliah</label>
                <input type="text" id="nama" name="nama" value="{{ $matkul->nama }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                    placeholder="Media dan Teknologi Pembelajaran PAI">
            </div>
            <div class="mb-6">
                <label for="jumlah_sks" class="block mb-2 text-sm font-medium text-gray-900">Jumlah SKS</label>
                <input type="number" id="jumlah_sks" name="jumlah_sks" value="{{ $matkul->jumlah_sks }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                    placeholder="2">
            </div>
            <div class="mb-6">
                <label for="semester" class="block mb-2 text-sm font-medium text-gray-900">Semester</label>
                <input type="number" id="semester" name="semester" value="{{ $matkul->semester }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                    placeholder="2">
            </div>
            <div class="mb-6">
                <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900">Keterangan</label>
                <input type="text" id="keterangan" name="keterangan" value="{{ $matkul->keterangan }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                    placeholder="MK STITA">
            </div>
            <div class="mb-6">
                <label for="jenis" class="block mb-2 text-sm font-medium text-gray-900">Jenis Mata Kuliah</label>
                <select id="jenis" name="jenis"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                    <option value="W" @selected($matkul->jenis == 'W')>
                        Wajib
                    </option>
                    <option value="P" @selected($matkul->jenis == 'P')>
                        Pilihan
                    </option>
                </select>
            </div>

            <button type="submit"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
        </form>

    </div>
@endsection
