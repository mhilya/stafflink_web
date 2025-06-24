<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                @if (auth()->user()->isHrd())
                    <!-- HRD Dashboard -->
                    <!-- Attendance Card - Karyawan -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Absensi Karyawan Hari Ini</h3>
                                    <p class="mt-1 text-sm text-gray-500">Total karyawan yang sudah absen</p>
                                </div>
                                <span class="text-3xl font-bold text-blue-600">24</span>
                            </div>
                            <div class="mt-6">
                                <a href="#"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Lihat Rekap Absensi Karyawan
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Card - Manajer -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Absensi Manajer Hari Ini</h3>
                                    <p class="mt-1 text-sm text-gray-500">Total manajer yang sudah absen</p>
                                </div>
                                <span class="text-3xl font-bold text-indigo-600">12</span>
                            </div>
                            <div class="mt-6">
                                <a href="#"
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Lihat Rekap Absensi Manajer
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Evaluation Card - Karyawan -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Penilaian Kinerja Karyawan</h3>
                                    <p class="mt-1 text-sm text-gray-500">Karyawan yang sudah dinilai bulan ini</p>
                                </div>
                                <span class="text-3xl font-bold text-green-600">
                                    {{ $jumlahPenilaianKaryawanBulanIni ?? '0' }}
                                </span>
                            </div>
                            <div class="mt-6">
                                <a href="{{ route('penilaian.karyawan.show') }}"
                                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Lihat Rekap Penilaian Karyawan
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Evaluation Card - Manajer -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Penilaian Kinerja Manajer</h3>
                                    <p class="mt-1 text-sm text-gray-500">Manajer yang sudah dinilai bulan ini</p>
                                </div>
                                <span class="text-3xl font-bold text-teal-600">
                                    {{ $jumlahPenilaianManajerBulanIni ?? '0' }}
                                </span>
                            </div>
                            <div class="mt-6">
                                <a href="{{ route('penilaian.manajer.show') }}"
                                    class="inline-flex items-center px-4 py-2 bg-teal-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 focus:bg-teal-700 active:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Lihat Rekap Penilaian Manajer
                                </a>
                            </div>
                        </div>
                    </div>
                @elseif(auth()->user()->isManajer())
                    <!-- Manajer Dashboard -->
                    <!-- Attendance Card - Karyawan -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Absensi Karyawan Hari Ini</h3>
                                    <p class="mt-1 text-sm text-gray-500">Total karyawan yang sudah absen</p>
                                </div>
                                <span class="text-3xl font-bold text-blue-600">
                                    {{ $jumlahAbsensiKaryawanHariIni ?? '0' }}
                                </span>
                            </div>
                            <div class="mt-6">
                                <a href="#"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Lihat Rekap Absensi Karyawan
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Evaluation Card - Karyawan -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Penilaian Kinerja Karyawan</h3>
                                    <p class="mt-1 text-sm text-gray-500">Karyawan yang sudah dinilai bulan ini</p>
                                </div>
                                <span class="text-3xl font-bold text-green-600">
                                    {{ $jumlahPenilaianKaryawanBulanIni ?? '0' }}
                                </span>
                            </div>
                            <div class="mt-6">
                                <a href="{{ route('penilaian.karyawan.show') }}"
                                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Lihat Rekap Penilaian Karyawan
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- Promotion Visualization -->
            @if (auth()->user()->isHrd() || auth()->user()->isManajer())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Promosi Karyawan Bulan Ini</h3>

                        <!-- Chart Container -->
                        <div class="w-full h-64 relative">
                            <canvas id="promotionChart" height="300" data-promoted="{{ $promotedCount }}"
                                data-not-promoted="{{ $notPromotedCount }}"></canvas>
                        </div>

                        <!-- Fallback (akan muncul jika JS dinonaktifkan) -->
                        <div id="chartFallback" class="hidden mt-4">
                            <div class="flex items-end h-48 gap-4">
                                <div class="flex-1 flex flex-col items-center">
                                    <div class="w-full bg-blue-500 rounded-t-lg"
                                        style="height: {{ $promotedCount > 0 ? 75 : 0 }}%;"></div>
                                    <span class="mt-2 font-bold">{{ $promotedCount }}</span>
                                    <span class="text-sm">Dipromosikan</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center">
                                    <div class="w-full bg-gray-400 rounded-t-lg"
                                        style="height: {{ $notPromotedCount > 0 ? 40 : 0 }}%;"></div>
                                    <span class="mt-2 font-bold">{{ $notPromotedCount }}</span>
                                    <span class="text-sm">Tidak Dipromosikan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
</x-app-layout>
