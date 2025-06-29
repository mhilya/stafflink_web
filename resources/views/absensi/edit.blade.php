<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Data Absensi') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 space-y-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Informasi Karyawan</h3>
                                <div class="mt-2 border-t border-gray-200 dark:border-gray-700 pt-2">
                                    <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2">
                                                {{ $absensi->user->karyawan->nama ?? '-' }}
                                            </dd>
                                        </div>
                                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2">
                                                {{ \Carbon\Carbon::parse($absensi->tanggal)->format('d F Y') }}
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <form method="POST" action="{{ route('absensi.update', $absensi->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="space-y-4">
                                    <div>
                                        <label for="waktu_masuk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Waktu Masuk</label>
                                        <input type="datetime-local" name="waktu_masuk" id="waktu_masuk"
                                            value="{{ old('waktu_masuk', $absensi->waktu_masuk ? \Carbon\Carbon::parse($absensi->waktu_masuk)->format('Y-m-d\TH:i') : '') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-300 sm:text-sm">
                                        @error('waktu_masuk')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="waktu_keluar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Waktu Keluar</label>
                                        <input type="datetime-local" name="waktu_keluar" id="waktu_keluar"
                                            value="{{ old('waktu_keluar', $absensi->waktu_keluar ? \Carbon\Carbon::parse($absensi->waktu_keluar)->format('Y-m-d\TH:i') : '') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-300 sm:text-sm">
                                        @error('waktu_keluar')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="keterangan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" rows="3"
                                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-300 sm:text-sm">{{ old('keterangan', $absensi->keterangan) }}</textarea>
                                        @error('keterangan')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="flex justify-end space-x-3 mt-6">
                                    <a href="{{ route('absensi.index') }}"
                                        class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Batal
                                    </a>
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
