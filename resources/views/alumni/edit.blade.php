@extends('layouts.main')

@section('title', 'Tambah Alumni')
@section('head-tag')
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
@section('content')
    <div class="lg:p-5 p-2 min-h-screen">
        <div class="flex justify-between items-center">
            <div class="flex gap-2 items-center text-gray-500  mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-10 h-10">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0 1 12 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" />
                </svg>

                <h1 class="font-bold text-2xl">Edit Alumni</h1>
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
        <div class="mt-5">
            <form action="" method="POST" autocomplete="off">
                @csrf
                <div class="mb-6">
                    <label for="no_ijazah" class="block mb-2 text-sm font-medium text-gray-900">No Ijazah</label>
                    <input type="text" id="no_ijazah" name="no_ijazah" value="{{ $alumni->no_ijazah }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                        placeholder="Nomor Ijazah">
                </div>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                    <input type="text" id="name" name="nama" value="{{ $alumni->nama }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                        placeholder="Nama">
                </div>
                <div class="mb-6">
                    <label for="nim" class="block mb-2 text-sm font-medium text-gray-900">NIM</label>
                    <input type="text" id="nim" name="nim" value="{{ $alumni->nim }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                        placeholder="NIM">
                </div>
                <div class="mb-6">
                    <label for="jenjang_pendidikan" class="block mb-2 text-sm font-medium text-gray-900">Jenjang Pendidikan
                    </label>
                    <select id="jenjang_pendidikan" name="jenjang_pendidikan"
                        class="select select-bordered w-full max-w-xs">
                        <option disabled selected>Pilih Jenjang Pendidikan</option>
                        <option value="S1" @selected($alumni->jenjang_pendidikan == 'S1')>S1</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label for="ipk" class="block mb-2 text-sm font-medium text-gray-900">Indeks Prestasi
                        Komulatif</label>
                    <input type="text" id="ipk" name="ipk" placeholder="Indeks Prestasi Komulatif"
                        value="{{ $alumni->ipk }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                </div>
                <div class="mb-6">
                    <label for="program_studi" class="block mb-2 text-sm font-medium text-gray-900">Program Studi</label>
                    <select id="program_studi" name="program_studi" class="select select-bordered w-full max-w-xs">
                        <option disabled selected>Pilih Program Studi</option>
                        @foreach (\App\Models\Jurusan::all() as $j)
                            <option value="{{ $j->nama_jurusan }}" @selected($alumni->program_studi == $j->nama_jurusan)>{{ $j->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-6">
                    <label for="tanggal_lulus" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lulus</label>
                    <input type="date" id="tanggal_lulus" name="tanggal_lulus" value="{{ $alumni->tanggal_lulus }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 max-w-xs">
                </div>
                <button type="submit"
                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
            </form>
        </div>

    </div>
@endsection
