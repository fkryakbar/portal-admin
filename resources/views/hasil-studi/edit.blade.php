@extends('layouts.main')

@section('title', 'Ubah Hasil Studi')
@section('head-tag')
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
@section('content')
    <div class="lg:p-5 p-2 min-h-screen">
        <div class="flex justify-between items-center">
            <div class="flex gap-2 items-center text-gray-500  mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path fill-rule="evenodd"
                        d="M2.25 2.25a.75.75 0 000 1.5H3v10.5a3 3 0 003 3h1.21l-1.172 3.513a.75.75 0 001.424.474l.329-.987h8.418l.33.987a.75.75 0 001.422-.474l-1.17-3.513H18a3 3 0 003-3V3.75h.75a.75.75 0 000-1.5H2.25zm6.54 15h6.42l.5 1.5H8.29l.5-1.5zm8.085-8.995a.75.75 0 10-.75-1.299 12.81 12.81 0 00-3.558 3.05L11.03 8.47a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l2.47-2.47 1.617 1.618a.75.75 0 001.146-.102 11.312 11.312 0 013.612-3.321z"
                        clip-rule="evenodd" />
                </svg>
                <h1 class="font-bold text-2xl">Ubah Hasil Studi</h1>
            </div>
        </div>
        <div class="text-sm breadcrumbs">
            <ul>
                <li><a href="/hasil-studi">Hasil Studi</a></li>
                <li><a href="/hasil-studi/{{ $mahasiswa->username }}">{{ $mahasiswa->username }}</a></li>
                <li>Ubah Hasil Studi</li>
            </ul>
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
            <div class="grid lg:grid-cols-3 grid-cols-1 gap-3 mb-6">
                <div>
                    <label for="tugas" class="block mb-2 text-sm font-medium text-gray-900">Nilai Tugas</label>
                    <input type="number" step="0.01" id="tugas" name="tugas" value="{{ $khs->tugas }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                        placeholder="">
                </div>
                <div>
                    <label for="uts" class="block mb-2 text-sm font-medium text-gray-900">Nilai UTS</label>
                    <input type="number" step="0.01" id="uts" name="uts" value="{{ $khs->uts }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                        placeholder="">
                </div>
                <div>
                    <label for="uas" class="block mb-2 text-sm font-medium text-gray-900">Nilai UAS</label>
                    <input type="number" step="0.01" id="uas" name="uas" value="{{ $khs->uas }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                        placeholder="">
                </div>
            </div>
            <button type="submit"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#matkul').select2()
        })
    </script>
@endsection
