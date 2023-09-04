@extends('layouts.main')

@section('title', 'Tambah Registrasi Akademik')

@section('content')
    <div class="p-5 min-h-screen">
        <div class="flex gap-2 items-center text-gray-500  mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                <path fill-rule="evenodd"
                    d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z"
                    clip-rule="evenodd" />
            </svg>
            <h1 class="font-bold text-2xl">Tambah Registrasi Akademik</h1>
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
        <form action="" method="POST">
            @csrf
            <div class="mb-6">
                <label for="kode_tahun_ajaran" class="block mb-2 text-sm font-medium text-gray-900">Tahun Ajaran</label>
                <select id="kode_tahun_ajaran" name="kode_tahun_ajaran"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                    @foreach ($tahun_ajaran as $t)
                        <option value="{{ $t->kode_tahun_ajaran }}">{{ $t->nama_tahun_ajaran }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-6">
                <label for="nama_registrasi" class="block mb-2 text-sm font-medium text-gray-900">Nama Registrasi</label>
                <input type="text" id="nama_registrasi" name="nama_registrasi"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                    placeholder="">
            </div>
            <button type="submit"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
        </form>
    </div>
@endsection
