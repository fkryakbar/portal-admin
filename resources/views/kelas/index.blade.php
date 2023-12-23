@section('title', 'Kelas')

<div class="lg:p-5 p-2 min-h-screen">
    <div class="flex gap-2 items-center text-gray-500  mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
            <path
                d="M11.584 2.376a.75.75 0 01.832 0l9 6a.75.75 0 11-.832 1.248L12 3.901 3.416 9.624a.75.75 0 01-.832-1.248l9-6z" />
            <path fill-rule="evenodd"
                d="M20.25 10.332v9.918H21a.75.75 0 010 1.5H3a.75.75 0 010-1.5h.75v-9.918a.75.75 0 01.634-.74A49.109 49.109 0 0112 9c2.59 0 5.134.202 7.616.592a.75.75 0 01.634.74zm-7.5 2.418a.75.75 0 00-1.5 0v6.75a.75.75 0 001.5 0v-6.75zm3-.75a.75.75 0 01.75.75v6.75a.75.75 0 01-1.5 0v-6.75a.75.75 0 01.75-.75zM9 12.75a.75.75 0 00-1.5 0v6.75a.75.75 0 001.5 0v-6.75z"
                clip-rule="evenodd" />
            <path d="M12 7.875a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z" />
        </svg>
        <h1 class="font-bold text-2xl">Kelas</h1>
    </div>
    <div class="" x-data='{ isOpen:false }'>
        <div class="flex justify-between flex-wrap gap-3">
            <input type="text" placeholder="Cari kelas" :class="isOpen == false ? '' : 'opacity-0'"
                wire:model.live.debounce.150ms="search_kelas" class="input input-bordered w-full max-w-xs" />
            <button class="btn bg-blue-500 text-white hover:bg-blue-700" x-on:click="isOpen=!isOpen">
                <svg x-show='!isOpen' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p x-show='!isOpen'>
                    Buat Kelas
                </p>
                <svg x-show='isOpen' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 16.811c0 .864-.933 1.405-1.683.977l-7.108-4.062a1.125 1.125 0 010-1.953l7.108-4.062A1.125 1.125 0 0121 8.688v8.123zM11.25 16.811c0 .864-.933 1.405-1.683.977l-7.108-4.062a1.125 1.125 0 010-1.953L9.567 7.71a1.125 1.125 0 011.683.977v8.123z" />
                </svg>
            </button>
        </div>
        @if (session('success'))
            <div role="alert" class="alert alert-success my-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        <div x-show="!isOpen" class="mt-3">
            @foreach ($kelas as $tahun => $t)
                <p class="mb-2 text-gray-500 font-semibold">{{ $tahun }}</p>
                <div class="grid lg:grid-cols-4 gap-3 grid-cols-1 mb-5">
                    @foreach ($t as $k)
                        <div wire:key='{{ $k->id }}' class="border-[1px] border-gray-200 rounded p-3">
                            <div class="flex gap-1 justify-center">
                                @if ($k->is_visible == 0)
                                    <p class="text-center text-xs bg-red-500 p-1 rounded text-white font-semibold">
                                        HIDDEN</p>
                                @endif
                                @if ($k->is_validated == 1)
                                    <p class="text-center text-xs bg-green-500 p-1 rounded text-white font-semibold">
                                        VALIDATED</p>
                                @endif
                            </div>
                            <h1 class="text-center text-lg font-semibold text-gray-700">{{ $k->nama }}</h1>
                            <p class="text-center text-sm text-gray-700">{{ $k->kode_mata_kuliah }}</p>
                            <p class="text-center text-sm text-gray-700">{{ $k->jadwal }}</p>
                            <div class="flex justify-center items-center gap-2 mt-2">
                                <a href="/kelas/{{ $k->kode_kelas }}"
                                    class="btn btn-sm bg-blue-500 hover:bg-blue-700 text-white"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>
                                <button wire:confirm="Yakin mau hapus kelas?" wire:click="delete({{ $k->kode_kelas }})"
                                    class="btn btn-sm bg-red-500 hover:bg-red-700 text-white"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div x-show="isOpen">
            <h1 class="text-lg font-semibold text-gray-500">Buat Kelas</h1>
            <form action="" method="POST" wire:submit='create'>
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Nama Kelas</span>
                    </div>
                    <input type="text" wire:model="nama" placeholder="Statistika A"
                        class="input input-bordered w-full max-w-xs" />
                    @error('nama')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </label>
                <label wire:ignore.self class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Mata Kuliah</span>
                    </div>
                    <select id="mata_kuliah" wire:model="kode_mata_kuliah"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="" selected>
                            Pilih Mata Kuliah</option>
                        @foreach ($mata_kuliah as $i => $m)
                            <option value="{{ $m->kode }}">
                                {{ $m->nama }}</option>
                        @endforeach
                    </select>
                    @error('kode_mata_kuliah')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </label>
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Tahun Ajaran</span>
                    </div>
                    <select id="tahun_ajaran" wire:model="kode_tahun_ajaran"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="" selected>
                            Pilih Tahun Ajaran</option>
                        @foreach (App\Models\TahunAjaran::latest()->get() as $i => $t)
                            <option wire:key='{{ $t->kode_tahun_ajaran }}' value="{{ $t->kode_tahun_ajaran }}">
                                {{ $t->nama_tahun_ajaran }}</option>
                        @endforeach
                    </select>
                    @error('kode_tahun_ajaran')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </label>
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Jadwal</span>
                    </div>
                    <input type="text" placeholder="Senin 08:50-11:20" wire:model="jadwal"
                        class="input input-bordered w-full max-w-xs" />
                    @error('jadwal')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </label>
                <button type="submit" class="btn bg-green-500 hover:bg-green-700 text-white mt-3">Buat Kelas</button>
            </form>
        </div>
    </div>
</div>
