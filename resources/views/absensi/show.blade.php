<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Absensi') }}
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
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Departemen</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2">
                                                {{ $absensi->user->karyawan->departemen ?? '-' }}
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Detail Absensi</h3>
                                <div class="mt-2 border-t border-gray-200 dark:border-gray-700 pt-2">
                                    <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2">
                                                {{ \Carbon\Carbon::parse($absensi->tanggal)->format('d F Y') }}
                                            </dd>
                                        </div>
                                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Waktu Masuk</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2">
                                                {{ $absensi->waktu_masuk ? \Carbon\Carbon::parse($absensi->waktu_masuk)->format('H:i:s') : '-' }}
                                            </dd>
                                        </div>
                                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Waktu Keluar</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2">
                                                {{ $absensi->waktu_keluar ? \Carbon\Carbon::parse($absensi->waktu_keluar)->format('H:i:s') : '-' }}
                                            </dd>
                                        </div>
                                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Keterangan</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2">
                                                {{ $absensi->keterangan ?? '-' }}
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('absensi.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Kembali
                        </a>
                        <a href="{{ route('absensi.edit', $absensi->id) }}"
                            class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
