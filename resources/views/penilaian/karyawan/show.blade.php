<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Penilaian Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter Section -->
            <div class="mb-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                    <!-- Search Input -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cari
                            Nama/NIP</label>
                        <input type="text" name="search" id="search" placeholder="Nama atau NIP..."
                            value="{{ request('search') }}"
                            class="w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Periode Filter -->
                    <div>
                        <label for="periode"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Periode</label>
                        <select name="periode" id="periode"
                            class="w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Periode</option>
                            @foreach ($periodes as $periode)
                                <option value="{{ $periode }}"
                                    {{ request('periode') == $periode ? 'selected' : '' }}>
                                    {{ $periode }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Indeks Filter -->
                    <div>
                        <label for="indeks"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Indeks</label>
                        <select name="indeks" id="indeks"
                            class="w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Indeks</option>
                            @foreach ($indeksOptions as $indeks)
                                <option value="{{ $indeks }}"
                                    {{ request('indeks') == $indeks ? 'selected' : '' }}>
                                    {{ $indeks }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tahun Filter -->
                    <div>
                        <label for="tahun"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tahun</label>
                        <select name="tahun" id="tahun"
                            class="w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Tahun</option>
                            @foreach ($tahunOptions as $tahun)
                                <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex justify-end space-x-2">
                    <!-- Reset Button -->
                    <a href="{{ route('penilaian.karyawan.show') }}"
                        class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md transition-colors flex items-center">
                        <x-heroicon-o-arrow-path class="w-5 h-5 mr-2" />
                        Reset
                    </a>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table id="laporanTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    NIP</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Nama</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Periode</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Tanggal</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Total Skor</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Persentase</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Indeks</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Penilai</th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="laporanBody"
                            class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($laporans as $laporan)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $laporan->karyawan->nip }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $laporan->karyawan->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $laporan->periode }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $laporan->tanggal_penilaian->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $laporan->total_score }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        <span
                                            class="px-2 py-1 rounded-full {{ $laporan->total_persentase >= 80 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : ($laporan->total_persentase >= 60 ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200') }}">
                                            {{ $laporan->total_persentase }}%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        <span
                                            class="px-2 py-1 rounded-full {{ $laporan->indeks === 'S' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' : ($laporan->indeks === 'A' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : ($laporan->indeks === 'B' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : ($laporan->indeks === 'C' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'))) }}">
                                            {{ $laporan->indeks }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $laporan->penilai->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">

                                                <a href="{{ route('penilaian.karyawan.print', $laporan->id) }}"
                                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                                    target="_blank">
                                                    <x-heroicon-o-printer class="w-5 h-5" />
                                                </a>
                                            @if (auth()->user()->isManajer())
                                                <a href="{{ route('penilaian.karyawan.edit', $laporan->id) }}"
                                                    class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300"
                                                    title="Edit">
                                                    <x-heroicon-o-pencil class="w-5 h-5" />
                                                </a>
                                            @endif
                                            <form action="{{ route('penilaian.karyawan.destroy', $laporan->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                    title="Hapus"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus penilaian ini?')">
                                                    <x-heroicon-o-trash class="w-5 h-5" />
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9"
                                        class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                        Tidak ada data penilaian yang ditemukan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($laporans->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                        {{ $laporans->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all filter elements
            const searchInput = document.getElementById('search');
            const periodeSelect = document.getElementById('periode');
            const indeksSelect = document.getElementById('indeks');
            const tahunSelect = document.getElementById('tahun');

            // Add event listeners for live filtering
            searchInput.addEventListener('input', filterTable);
            periodeSelect.addEventListener('change', filterTable);
            indeksSelect.addEventListener('change', filterTable);
            tahunSelect.addEventListener('change', filterTable);

            // Initial filter on page load
            filterTable();
        });

        function filterTable() {
            const search = document.getElementById('search').value.toLowerCase();
            const periode = document.getElementById('periode').value;
            const indeks = document.getElementById('indeks').value;
            const tahun = document.getElementById('tahun').value;

            const rows = document.querySelectorAll('#laporanBody tr');

            rows.forEach(row => {
                if (row.cells.length < 8) return; // Skip rows that don't have enough cells (like the no-data row)

                const nip = row.cells[0].textContent.toLowerCase();
                const nama = row.cells[1].textContent.toLowerCase();
                const rowPeriode = row.cells[2].textContent;
                const rowIndeks = row.cells[6].textContent.trim();
                const rowTanggal = row.cells[3].textContent;
                const rowTahun = rowTanggal.split('/')[2]; // Format dd/mm/yyyy

                const matchesSearch = search === '' || nip.includes(search) || nama.includes(search);
                const matchesPeriode = periode === '' || rowPeriode === periode;
                const matchesIndeks = indeks === '' || rowIndeks === indeks;
                const matchesTahun = tahun === '' || rowTahun === tahun;

                if (matchesSearch && matchesPeriode && matchesIndeks && matchesTahun) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</x-app-layout>
