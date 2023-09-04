@extends('layouts.main')

@section('title', 'Registrasi Akademik')

@section('content')
    <div class="p-5 min-h-screen">
        <div class="flex gap-2 items-center text-gray-500  mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                <path fill-rule="evenodd"
                    d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z"
                    clip-rule="evenodd" />
            </svg>
            <h1 class="font-bold text-2xl">Registrasi Akademik</h1>
        </div>
        <div class="flex justify-end">
            <a href="/registrasi/tambah" class="btn btn-sm bg-green-500 border-0 hover:bg-green-700 text-white">
                TAMBAH +
            </a>
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
        <div class="mt-5 grid lg:grid-cols-4 grid-cols-1 gap-4">
            @foreach ($registrasi_akademik as $r)
                <div class="rounded-lg bg-gray-100 shadow p-4">
                    <div class="text-center">
                        <h1>Semester</h1>
                        <h1 class="font-bold text-xl">{{ $r->nama_registrasi }}</h1>
                    </div>
                    <div class="flex justify-center mt-1 gap-2">
                        <a href="/registrasi/{{ $r->kode_tahun_ajaran }}"
                            class="btn btn-sm bg-blue-500 border-0 hover:bg-blue-700 text-white">
                            Buka
                        </a>
                        <button onclick="delete_data('{{ $r->kode_tahun_ajaran }}')"
                            class="btn btn-sm bg-red-400 border-0 hover:bg-red-700 text-white">
                            Hapus
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function delete_data(kode_tahun_ajaran) {
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
                    window.location.href = `/registrasi/${kode_tahun_ajaran}/hapus`
                }
            })
        }
    </script>
@endsection
