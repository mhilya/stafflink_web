<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (!$karyawan)
                <!-- Empty State -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Anda belum memiliki data karyawan.</p>
                    <x-primary-button href="{{ route('karyawan.create') }}">
                        Tambah Data Karyawan
                    </x-primary-button>
                </div>
            @else
                <!-- Employee Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- Card Header -->
                    <div class="bg-gray-800 dark:bg-gray-700 px-6 py-6 flex flex-col sm:flex-row items-start sm:items-center gap-6">
                        <div class="relative">
                            <div class="h-20 w-20 rounded-full bg-white dark:bg-gray-600 flex items-center justify-center text-gray-800 dark:text-gray-200 text-2xl font-bold border-4 border-white dark:border-gray-700 shadow">
                                {{ strtoupper(substr($karyawan->nama, 0, 1)) }}
                            </div>
                            <span class="absolute bottom-0 right-0 bg-green-500 rounded-full h-5 w-5 border-2 border-white dark:border-gray-700"></span>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white">{{ $karyawan->nama }}</h2>
                            <p class="text-gray-200 dark:text-gray-300">{{ $karyawan->nip }} • {{ $karyawan->departemen }}</p>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Personal Info -->
                            <section>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                                    {{ __('Informasi Pribadi') }}
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Nama Lengkap</p>
                                        <p class="text-gray-900 dark:text-gray-100">{{ $karyawan->nama }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                                        <p class="text-gray-900 dark:text-gray-100">{{ $karyawan->user->email }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Alamat</p>
                                        <p class="text-gray-900 dark:text-gray-100">{{ $karyawan->alamat }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Tempat/Tanggal Lahir</p>
                                        <p class="text-gray-900 dark:text-gray-100">
                                            {{ $karyawan->tempat_lahir }}, {{ $karyawan->tanggal_lahir->translatedFormat('d F Y') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Jenis Kelamin</p>
                                        <p class="text-gray-900 dark:text-gray-100">
                                            {{ $karyawan->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">No. Telepon</p>
                                        <p class="text-gray-900 dark:text-gray-100">{{ $karyawan->no_telepon }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Pendidikan</p>
                                        <p class="text-gray-900 dark:text-gray-100">{{ $karyawan->edukasi }}</p>
                                    </div>
                                </div>
                            </section>

                            <!-- Work Info -->
                            <section>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                                    {{ __('Informasi Pekerjaan') }}
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                                        <span class="px-2 py-1 text-xs rounded-full
                                            {{ $karyawan->status === 'Aktif' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' :
                                               ($karyawan->status === 'Non-Aktif' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' :
                                               'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200') }}">
                                            {{ $karyawan->status }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">NIP</p>
                                        <p class="text-gray-900 dark:text-gray-100">{{ $karyawan->nip }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Departemen</p>
                                        <p class="text-gray-900 dark:text-gray-100">{{ $karyawan->departemen }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Jabatan</p>
                                        <p class="text-gray-900 dark:text-gray-100">{{ ucfirst($karyawan->user->role->name) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Detail Jabatan</p>
                                        <p class="text-gray-900 dark:text-gray-100">{{ $karyawan->detail_jabatan }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal Dibuat</p>
                                        <p class="text-gray-900 dark:text-gray-100">
                                            {{ $karyawan->created_at->translatedFormat('d F Y H:i') }}</p>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 flex justify-end">
                        <a href="{{ route('hrd.karyawan.edit', $karyawan->id) }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600">
                            Edit Data
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
