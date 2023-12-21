@extends('layouts.main')

@section('title', 'Tambah Dosen')
@section('head-tag')
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
@section('content')
    <div class="p-5 ">
        <div class="flex justify-between items-center">
            <div class="flex gap-2 items-center text-gray-500  mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path
                        d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                </svg>
                <h1 class="font-bold text-2xl">Tambah Dosen</h1>
            </div>
        </div>
        <div>
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
                    <li><a href="/dosen">Dosen</a></li>
                    <li>Tambah</li>
                </ul>
            </div>
            <form action="" method="POST" class="mt-5">
                @csrf
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                    <input type="text" id="name" name="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                        placeholder="Nama">
                </div>
                <div class="mb-6">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                    <input type="text" id="username" name="username"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                        placeholder="Username">
                </div>
                <button type="submit"
                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
            </form>

        </div>
    </div>
@endsection
