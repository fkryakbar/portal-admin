@extends('layouts.main')

@section('title', 'Edit Mahasiswa')

@section('content')

    <div class="lg:p-5 p-1 ">
        <div class="flex justify-between items-center">
            <div class="flex gap-2 items-center text-gray-500  mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path fill-rule="evenodd"
                        d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z"
                        clip-rule="evenodd" />
                    <path
                        d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" />
                </svg>
                <h1 class="font-bold text-2xl">Edit Mahasiswa</h1>
            </div>
        </div>
        <div class="text-sm breadcrumbs">
            <ul>
                <li><a href="/mahasiswa">Mahasiswa</a></li>
                <li>Edit</li>
            </ul>
        </div>
        <form action="" enctype="multipart/form-data" method="POST" class="mt-5">
            @csrf
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
            <div class="rounded-lg border-[1px] border-gray-200 lg:p-4 p-2">
                <h1 class="my-2 font-bold text-gray-600">AKUN</h1>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ $mahasiswa->name }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                        placeholder="Nama">
                </div>
                <div class="mb-6">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                    <input type="text" id="username" name="username" value="{{ $mahasiswa->username }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                        placeholder="Username">
                </div>
                <div class="mb-6">
                    <label for="angkatan" class="block mb-2 text-sm font-medium text-gray-900">Angkatan</label>
                    <input type="text" id="angkatan" name="angkatan" value="{{ $mahasiswa->biodata->angkatan }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                        placeholder="2020">
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Reset Password</label>
                    <div class="flex">
                        <div class="flex items-center mr-4">
                            <input id="inline-radio" type="radio" value="1" name="is_reset_password"
                                @checked($mahasiswa->is_reset_password == 1)
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500   focus:ring-2 ">
                            <label for="inline-radio" class="ml-2 text-sm font-medium text-gray-900 ">Ya</label>
                        </div>
                        <div class="flex items-center mr-4">
                            <input id="inline-2-radio" type="radio" value="0" name="is_reset_password"
                                @checked($mahasiswa->is_reset_password == 0)
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500   focus:ring-2 ">
                            <label for="inline-2-radio" class="ml-2 text-sm font-medium text-gray-900 ">Tidak</label>
                        </div>
                    </div>
                </div>
                @if ($mahasiswa->is_reset_password == 1)
                    <div class="mb-6">
                        <label for="password_reset" class="block mb-2 text-sm font-medium text-gray-900">Password untuk
                            Reset</label>
                        <input type="text" id="password_reset" value="{{ $mahasiswa->password_reset }}" disabled
                            aria-label="disabled input"
                            class="bg-gray-50 border cursor-not-allowed border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                            placeholder="Password">
                    </div>
                @endif
            </div>
            <div class="mt-3 rounded-lg border-[1px] border-gray-200 p-4">
                <h1 class="my-2 font-bold text-gray-600">BIODATA</h1>
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-3">
                    <div>
                        <div class="mb-6">
                            <label for="file_input" class="block mb-2 text-sm font-medium text-gray-900">Foto Profil</label>
                            @if ($mahasiswa->biodata->gambar)
                                <img src="{{ asset('storage/' . $mahasiswa->biodata->gambar) }}" alt="photo profile"
                                    class="w-[200px] rounded">
                            @else
                                <img src="{{ asset('assets/image/generic_user.png') }}" alt="photo profile"
                                    class="w-[200px] rounded">
                            @endif
                            <p class="mt-3 text-xs">Foto (jpg/jpeg, (max. 100 KB) dengan ukuran 3:4)</p>
                            <input
                                class="block mt-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 "
                                id="file_input" type="file" name="profile">

                        </div>
                        <div class="mb-6">
                            <label for="nik" class="block mb-2 text-sm font-medium text-gray-900">NIK</label>
                            <input type="text" id="nik" name="nik" value="{{ $mahasiswa->biodata->nik }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                                placeholder="NIK">

                        </div>
                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="email" id="email" name="email" value="{{ $mahasiswa->biodata->email }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                                placeholder="Email">
                        </div>
                        <div class="mb-6">
                            <label for="no_telp" class="block mb-2 text-sm font-medium text-gray-900">No Telelpon</label>
                            <input type="number" id="no_telp" name="no_telp"
                                value="{{ $mahasiswa->biodata->no_telp }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                                placeholder="No Telelpon">
                        </div>
                    </div>
                    <div>
                        <div class="mb-6">
                            <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900">Jenis
                                Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                                <option selected value="">Pilih Jenis Kelamin</option>
                                <option @selected($mahasiswa->biodata->jenis_kelamin == 'laki-laki') value="laki-laki">Laki-laki</option>
                                <option @selected($mahasiswa->biodata->jenis_kelamin == 'perempuan') value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tempat
                                Lahir</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir"
                                value="{{ $mahasiswa->biodata->tempat_lahir }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                                placeholder="Tempat Lahir">
                        </div>
                        <div class="mb-6">
                            <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                                Lahir</label>
                            <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 " aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input type="date" value="{{ $mahasiswa->biodata->tanggal_lahir }}"
                                    id="tanggal_lahir" name="tanggal_lahir"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                    placeholder="Select date">
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 ">Alamat</label>
                            <textarea id="alamat" rows="4" name="alamat"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                                placeholder="Alamat">{{ $mahasiswa->biodata->alamat }}</textarea>
                        </div>
                        <div class="mb-6">
                            <label for="asal_sekolah" class="block mb-2 text-sm font-medium text-gray-900 ">Asal
                                Sekolah</label>
                            <input type="text" id="asal_sekolah" name="asal_sekolah"
                                value="{{ $mahasiswa->biodata->asal_sekolah }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                                placeholder="MAN 1 Tapin">
                        </div>
                        <div class="mb-6">
                            <label for="program_studi" class="block mb-2 text-sm font-medium text-gray-900">Program
                                Studi</label>
                            <select id="program_studi" name="program_studi"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                                @foreach ($jurusan as $j)
                                    <option @selected($mahasiswa->biodata->program_studi == $j->kode_jurusan) value="{{ $j->kode_jurusan }}">
                                        {{ $j->kode_jurusan }} - {{ $j->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <button type="submit"
                class="text-white mt-5 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
        </form>
    </div>

@endsection
