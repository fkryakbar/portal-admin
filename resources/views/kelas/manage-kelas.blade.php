@section('title', 'Kelas')

<div class="lg:p-5 p-2 min-h-screen">
    <div class="flex flex-wrap gap-2 justify-between text-gray-500  mb-3">
        <div class="flex gap-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                <path
                    d="M11.584 2.376a.75.75 0 01.832 0l9 6a.75.75 0 11-.832 1.248L12 3.901 3.416 9.624a.75.75 0 01-.832-1.248l9-6z" />
                <path fill-rule="evenodd"
                    d="M20.25 10.332v9.918H21a.75.75 0 010 1.5H3a.75.75 0 010-1.5h.75v-9.918a.75.75 0 01.634-.74A49.109 49.109 0 0112 9c2.59 0 5.134.202 7.616.592a.75.75 0 01.634.74zm-7.5 2.418a.75.75 0 00-1.5 0v6.75a.75.75 0 001.5 0v-6.75zm3-.75a.75.75 0 01.75.75v6.75a.75.75 0 01-1.5 0v-6.75a.75.75 0 01.75-.75zM9 12.75a.75.75 0 00-1.5 0v6.75a.75.75 0 001.5 0v-6.75z"
                    clip-rule="evenodd" />
                <path d="M12 7.875a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z" />
            </svg>
            <h1 class="font-bold text-2xl">{{ $kelas->nama }}</h1>
        </div>
        <a href="/kelas/{{ $kelas->kode_kelas }}/cetak" target="_blank"
            class="btn bg-amber-500 hover:bg-amber-700 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" data-slot="icon" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
            </svg>
            Cetak Nilai
        </a>
    </div>
    @if (session('success'))
        <div class="toast toast-top toast-end z-[1000]">
            <div class="alert alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" data-slot="icon" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif
    <div class="grid grid-cols-1 gap-3">

        <div class="border-[1px] border-gray-200 p-3 rounded">
            <h1 class="text-lg text-gray-700 font-semibold">Dosen Pengampu Mata Kuliah</h1>
            <div class="mt-3">
                <input class="input input-bordered join-item w-full" wire:model.live.debounce.250ms="dosen_query"
                    placeholder="Cari dosen" />
            </div>
            <div class="mt-3">
                <div class="overflow-x-auto">
                    <table class="table">
                        <tbody>
                            @forelse  ($dosen as $i => $d)
                                <tr wire:key='{{ $d->id }}'>
                                    <th>{{ $i + 1 }}</th>
                                    <td>{{ $d->username }}</td>
                                    <td> {{ $d->name }}</td>
                                    <td> <button wire:click='attach_dosen({{ $d->id }})'
                                            class="btn btn-sm bg-blue-500 hover:bg-blue-700 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75l3 3m0 0l3-3m-3 3v-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <hr class="my-2">
            <p class="font-semibold text-gray-700 mt-3 mb-1">
                Dosen yang dipilih :
            </p>
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $index = 1;
                        @endphp
                        @forelse ($kelas->dosen as $i => $p)
                            @if ($p->role == 'dosen')
                                <tr wire:key='{{ $p->id }}'>
                                    <th>{{ $index }}</th>
                                    @php
                                        $index = $index + 1;
                                    @endphp
                                    <td>{{ $p->username }}</td>
                                    <td> {{ $p->name }}</td>
                                    <td> <button wire:click='detach_dosen({{ $p->id }})'
                                            class="btn btn-sm bg-red-500 hover:bg-red-700 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <p class="text-xs text-gray-400">Belum ada dosen yang dipilih</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="border-[1px] border-gray-200 p-3 rounded">
            <h1 class="text-lg text-gray-700 font-semibold">Mahasiswa</h1>
            <div class="mt-3">
                <input class="input input-bordered join-item w-full" wire:model.live.debounce.250ms="mahasiswa_query"
                    placeholder="Cari Mahasiswa" />
            </div>
            <div class="mt-3">
                <div class="overflow-x-auto">
                    <table class="table">
                        <tbody>
                            @forelse  ($mahasiswa as $i => $m)
                                <tr wire:key='{{ $m->id }}'>
                                    <th>{{ $i + 1 }}</th>
                                    <td>{{ $m->username }}</td>
                                    <td> {{ $m->name }}</td>
                                    <td> <button wire:click='attach_mahasiswa({{ $m->id }})'
                                            class="btn btn-sm bg-blue-500 hover:bg-blue-700 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75l3 3m0 0l3-3m-3 3v-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <hr class="my-2">
            <p class="font-semibold text-gray-700 mt-3 mb-1">
                Mahasiswa yang dipilih :
            </p>
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Tugas</th>
                            <th>MT</th>
                            <th>FT</th>
                            <th>Angka</th>
                            <th>Bobot</th>
                            <th>Huruf</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $index = 1;
                        @endphp
                        @forelse ($mahasiswa_selected as $i => $p)
                            <tr wire:key='{{ $p->id }}'>
                                <th>{{ $index }}</th>
                                @php
                                    $index = $index + 1;
                                @endphp
                                <td>{{ $p->username }}</td>
                                <td> {{ $p->name }}</td>
                                <td> {{ $p->kartu_studi[0]->tugas }}</td>
                                <td> {{ $p->kartu_studi[0]->uts }}</td>
                                <td> {{ $p->kartu_studi[0]->uas }}</td>
                                <td> {{ $p->kartu_studi[0]->angka }}</td>
                                <td> {{ $p->kartu_studi[0]->bobot }}</td>
                                <td> {{ $p->kartu_studi[0]->huruf }}</td>
                                <td> <button wire:click='detach_mahasiswa({{ $p->id }})'
                                        class="btn btn-sm bg-red-500 hover:bg-red-700 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>

                        @empty
                            <p class="text-xs text-gray-400">Belum ada mahasiswa yang dipilih</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="border-[1px] border-gray-200 p-3 rounded">
            <h1 class="text-lg text-gray-700 font-semibold">Data Kelas</h1>
            <form action="" method="POST" wire:submit='update'>
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
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Mata Kuliah</span>
                    </div>
                    <input type="text" value="{{ $kelas->mata_kuliah->nama }}" placeholder="Statistika A"
                        disabled class="input input-bordered w-full max-w-xs" />
                </label>
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Tahun Ajaran</span>
                    </div>
                    <select id="tahun_ajaran" wire:model="kode_tahun_ajaran"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        @foreach (App\Models\TahunAjaran::latest()->get() as $i => $t)
                            <option wire:key='{{ $t->kode_tahun_ajaran }}' value="{{ $t->kode_tahun_ajaran }}"
                                @selected($kelas->kode_tahun_ajaran == $t->kode_tahun_ajaran)>
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
                <label class="form-control w-full max-w-xs border-[1px] rounded mt-3 p-2">
                    <div class="label">
                        <span class="label-text">Validasi</span>
                    </div>
                    <div class="ml-5">
                        <label class="label cursor-pointer">
                            <span class="label-text">Ya</span>
                            <input type="radio" name="validasi" class="radio checked:bg-blue-500" value="1"
                                wire:model='is_validated' />
                        </label>
                        <label class="label cursor-pointer">
                            <span class="label-text">Tidak</span>
                            <input type="radio" name="validasi" class="radio checked:bg-blue-500" value="0"
                                wire:model='is_validated' />
                        </label>
                    </div>
                    @error('is_validated')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </label>
                <label class="form-control w-full max-w-xs border-[1px] rounded mt-3 p-2">
                    <div class="label">
                        <span class="label-text">Sembunyikan</span>
                    </div>
                    <div class="ml-5">
                        <label class="label cursor-pointer">
                            <span class="label-text">Ya</span>
                            <input type="radio" name="public" class="radio checked:bg-blue-500" value="0"
                                wire:model='is_visible' />
                        </label>
                        <label class="label cursor-pointer">
                            <span class="label-text">Tidak</span>
                            <input type="radio" name="public" class="radio checked:bg-blue-500" value="1"
                                wire:model='is_visible' />
                        </label>
                    </div>
                    @error('is_visible')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </label>
                <button type="submit" class="btn bg-green-500 hover:bg-green-700 text-white mt-3">Perbarui</button>
            </form>
        </div>
    </div>
</div>
