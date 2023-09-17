@extends('layouts.main')

@section('title', 'Detail Presensi')

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
                <li><a href="/presensi-dosen">Presensi</a></li>
                <li>Detail</li>
            </ul>
        </div>
        <div class="flex justify-between items-center mt-4">
            <p class="block font-bold text-gray-700 text-xl">Data Presensi</p>

        </div>
        <form action="" class="mt-5" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="mb-6">
                <label for="mata_kuliah" class="block mb-2 text-sm font-medium text-gray-900">Mata Kuliah</label>
                <select id="mata_kuliah" name="mata_kuliah"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option value="" selected disabled>Pilih Mata Kuliah</option>
                    @foreach ($mata_kuliah as $i => $m)
                        <option value="{{ $m->nama }}" @selected($presensi->mata_kuliah == $m->nama)>
                            {{ $m->nama }}</option>
                    @endforeach
                </select>

            </div>
            <div class="mb-6">
                <label for="jumlah_sks" class="block mb-2 text-sm font-medium text-gray-900">Jumlah SKS</label>
                <input type="number" id="jumlah_sks" name="jumlah_sks" value="{{ $presensi->jumlah_sks }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">

            </div>
            <div class="mb-6">
                <label for="nik" class="block mb-2 text-sm font-medium text-gray-900">Aktivitas</label>
                <textarea id="aktivitas" rows="4" name="aktivitas"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 ">{{ $presensi->aktivitas }}</textarea>

            </div>
            <div class="mb-6">
                <label for="jumlah_mahasiswa" class="block mb-2 text-sm font-medium text-gray-900">Jumlah Mahasiswa</label>
                <input type="number" id="jumlah_mahasiswa" name="jumlah_mahasiswa"
                    value="{{ $presensi->jumlah_mahasiswa }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">

            </div>
            <div class="mb-6">
                <label for="mahasiswa_tidak_hadir" class="block mb-2 text-sm font-medium text-gray-900">Mahasiswa tidak
                    hadir</label>
                <input type="text" id="mahasiswa_tidak_hadir" name="mahasiswa_tidak_hadir"
                    value="{{ $presensi->mahasiswa_tidak_hadir }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                    placeholder="mahasiswa_tidak_hadir">

            </div>
            <div class="mb-6">
                <label for="nik" class="block mb-2 text-sm font-medium text-gray-900">Detail Mahasiswa tidak
                    hadir</label>
                <textarea id="detail_mahasiswa_tidak_hadir" rows="4" name="detail_mahasiswa_tidak_hadir"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 ">{{ $presensi->detail_mahasiswa_tidak_hadir }}</textarea>
            </div>
            <div class="mb-6">
                <label for="waktu_perkuliahan" class="block mb-2 text-sm font-medium text-gray-900">Waktu
                    perkuliahan</label>
                <input type="text" id="waktu_perkuliahan" name="waktu_perkuliahan"
                    value="{{ $presensi->waktu_perkuliahan }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                    placeholder="NIK">
            </div>
            <div class="mb-6">
                <label for="file_input" class="block mb-2 text-sm font-medium text-gray-900">Foto Perkuliahan</label>
                <img src="{{ asset('storage/' . $presensi->image_path) }}" alt="photo perkuliahan"
                    class="w-[200px] rounded">
                <p class="mt-3 text-xs">Foto (jpg/jpeg, (max. 500 KB))</p>
                <input class="file-input file-input-bordered w-full max-w-xs mt-3" id="file_input" type="file"
                    name="foto_perkuliahan">
            </div>
            <div class="mb-6">
                <button type="submit"
                    class="bg-green-500 p-2 rounded-lg text-white hover:bg-green-800 font-bold transition-all">Simpan</button>
            </div>
        </form>
    </div>
    <script>
        $('#mata_kuliah').select2()
    </script>
@endsection
