<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Penilaian Kompetensi') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('penilaian.karyawan.update', $penilaian->id) }}">
                        @csrf
                        @method('PUT')

                        <div id="print-area">
                            <!-- Employee Information Section -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                <!-- Karyawan (auto-filled from selected employee) -->
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama</label>
                                    <input type="text" value="{{ $penilaian->karyawan->nama }}"
                                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        readonly>
                                    <input type="hidden" name="karyawan_id" value="{{ $penilaian->karyawan_id }}">
                                </div>

                                <!-- Auto-filled fields -->
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">NIP</label>
                                    <input type="text" value="{{ $penilaian->karyawan->nip }}"
                                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        readonly>
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                    <input type="text" value="{{ $penilaian->karyawan->status }}"
                                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        readonly>
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jabatan</label>
                                    <input type="text" value="{{ $penilaian->karyawan->user->role->name }}"
                                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        readonly>
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Detail
                                        Jabatan</label>
                                    <input type="text" value="{{ $penilaian->karyawan->detail_jabatan }}"
                                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        readonly>
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Departemen/Divisi</label>
                                    <input type="text" value="{{ $penilaian->karyawan->departemen }}"
                                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        readonly>
                                </div>

                                <!-- Penilai (auto-filled from logged in manager) -->
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Penilai</label>
                                    <input type="text" value="{{ $penilai->nama }}"
                                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        readonly>
                                    <input type="hidden" name="penilai_id" value="{{ $penilai->id }}">
                                </div>

                                <div>
                                    <label for="periode"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Periode</label>
                                    <input type="text" name="periode" id="periode"
                                        value="{{ $penilaian->periode }}"
                                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        required>
                                </div>
                                <div>
                                    <label for="tanggal_penilaian"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal
                                        Penilaian</label>
                                    <input type="date" name="tanggal_penilaian" id="tanggal_penilaian"
                                        value="{{ $penilaian->tanggal_penilaian->format('Y-m-d') }}"
                                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        required>
                                </div>
                            </div>

                            <!-- Competency Assessment Table -->
                            <div class="overflow-x-auto mb-6">
                                <table class="w-full text-sm text-center border border-gray-200 dark:border-gray-700">
                                    <thead>
                                        <tr class="bg-blue-700 text-white">
                                            <th class="p-3">No</th>
                                            <th class="p-3">Kategori</th>
                                            <th class="text-left p-3">Kompetensi</th>
                                            <th class="p-3">Metode</th>
                                            <th class="p-3">Target</th>
                                            <th class="p-3">Aktual (1–4)</th>
                                            <th class="p-3">Hasil × Bobot</th>
                                            <th class="p-3">Gap</th>
                                            <th class="p-3">Komentar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $kategori_sekarang = ''; @endphp
                                        @foreach ($kompetensi as $i => $item)
                                            @php
                                                if ($item['Kategori'] !== '') {
                                                    $kategori_sekarang = $item['Kategori'];
                                                }
                                                $bobot = $kategori_bobot[$kategori_sekarang] ?? 0;
                                                $existingValue = $kompetensiValues[$i] ?? null;
                                            @endphp
                                            <tr class="even:bg-gray-50 dark:even:bg-gray-700">
                                                <td class="p-2">{{ $i + 1 }}</td>
                                                <td class="p-2">{{ $item['Kategori'] }}</td>
                                                <td class="p-2 text-left">{{ $item['Kompetensi'] }}</td>
                                                <td class="p-2">
                                                    <input type="text" value="{{ $item['Metode'] }}" readonly
                                                        class="w-full text-center border rounded-md px-2 py-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                </td>
                                                <td class="p-2">
                                                    <input type="number" value="4" readonly
                                                        class="w-full text-center border rounded-md px-2 py-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                </td>
                                                <td class="p-2">
                                                    <div class="flex justify-center gap-1 radio-group"
                                                        data-index="{{ $i }}"
                                                        data-bobot="{{ $bobot }}">
                                                        @for ($j = 0; $j <= 4; $j++)
                                                            <label class="flex items-center gap-1">
                                                                <input type="radio"
                                                                    name="aktual[{{ $i }}]"
                                                                    value="{{ $j }}" class="aktual-radio"
                                                                    {{ ($existingValue['aktual'] ?? 0) == $j ? 'checked' : '' }}>
                                                                {{ $j }}
                                                            </label>
                                                        @endfor
                                                    </div>
                                                </td>
                                                <td class="p-2">
                                                    <input type="text" name="hasil[{{ $i }}]"
                                                        class="hasil-input w-full text-center border rounded-md px-2 py-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                                        readonly value="{{ $existingValue['hasil_bobot'] ?? 0 }}">
                                                </td>
                                                <td class="p-2">
                                                    <input type="text" name="gap[{{ $i }}]"
                                                        class="gap-input w-full text-center border rounded-md px-2 py-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                                        readonly value="{{ $existingValue['gap'] ?? 0 }}">
                                                </td>
                                                <td class="p-2">
                                                    <input type="text" name="komentar[{{ $i }}]"
                                                        value="{{ $existingValue['komentar'] ?? '' }}"
                                                        class="w-full border rounded-md px-2 py-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                </td>
                                            </tr>

                                            @if ($i === 9)
                                                <tr class="font-semibold bg-gray-100 dark:bg-gray-600">
                                                    <td colspan="6" class="text-right p-2">Skill (35%)</td>
                                                    <td id="total-skill" class="text-center p-2">
                                                        {{ $penilaian->total_skill }}</td>
                                                    <td colspan="2"></td>
                                                </tr>
                                            @elseif ($i === 14)
                                                <tr class="font-semibold bg-gray-100 dark:bg-gray-600">
                                                    <td colspan="6" class="text-right p-2">Kinerja (35%)</td>
                                                    <td id="total-kinerja" class="text-center p-2">
                                                        {{ $penilaian->total_kinerja }}</td>
                                                    <td colspan="2"></td>
                                                </tr>
                                            @elseif ($i === 19)
                                                <tr class="font-semibold bg-gray-100 dark:bg-gray-600">
                                                    <td colspan="6" class="text-right p-2">Attitude (30%)</td>
                                                    <td id="total-attitude" class="text-center p-2">
                                                        {{ $penilaian->total_attitude }}</td>
                                                    <td colspan="2"></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Results Summary -->
                            <div class="flex flex-wrap gap-4 justify-start text-sm mb-8">
                                <div class="w-80 flex border dark:border-gray-300 rounded overflow-hidden">
                                    <div class="bg-cyan-500 text-white font-bold w-1/2 text-center py-6 text-lg">Result
                                    </div>
                                    <div class="w-1/2 text-center flex items-center justify-center font-semibold text-lg bg-white dark:bg-gray-700"
                                        id="result-persentase">{{ $penilaian->total_persentase }}%</div>
                                </div>
                                <div class="w-80 flex border dark:border-gray-300 rounded overflow-hidden">
                                    <div class="bg-cyan-500 text-white font-bold w-1/2 text-center py-6 text-lg">Score
                                    </div>
                                    <div class="w-1/2 text-center flex items-center justify-center font-semibold text-lg bg-white dark:bg-gray-700"
                                        id="result-score">{{ $penilaian->total_score }}</div>
                                </div>
                                <div class="w-80 flex border dark:border-gray-300 rounded overflow-hidden">
                                    <div class="bg-cyan-500 text-white font-bold w-1/2 text-center py-6 text-lg">Indeks
                                    </div>
                                    <div class="w-1/2 text-center flex items-center justify-center text-2xl font-bold text-blue-700 bg-white dark:bg-gray-700"
                                        id="result-indeks">{{ $penilaian->indeks }}</div>
                                </div>
                            </div>

                            <!-- Signature and Feedback Section -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                                <!-- Penilai Section -->
                                <div class="text-center">
                                    <p class="font-bold mb-4 text-gray-800 dark:text-white">Penilai</p>
                                    <div class="mb-2">
                                        <p class="text-sm text-gray-600 dark:text-gray-300">Nama</p>
                                        <input type="text" value="{{ $penilai->nama }}"
                                            class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-center font-bold"
                                            readonly>
                                    </div>
                                    <div class="mb-2">
                                        <p class="text-sm text-gray-600 dark:text-gray-300">Tanggal</p>
                                        <input type="text" id="display_tanggal_penilaian"
                                            value="{{ $penilaian->tanggal_penilaian->format('d-m-Y') }}"
                                            class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-center font-bold"
                                            readonly>
                                    </div>
                                    <div class="mt-12 h-0.5 bg-gray-300 dark:bg-gray-600"></div>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Tanda tangan</p>
                                </div>

                                <!-- Mengetahui Section -->
                                <div class="text-center">
                                    <p class="font-bold mb-4 text-gray-800 dark:text-white">Mengetahui</p>
                                    <div class="mb-2">
                                        <p class="text-sm text-gray-600 dark:text-gray-300">Nama</p>
                                        <input type="text" name="nama_mengetahui" id="nama_mengetahui"
                                            value="{{ $penilaian->karyawan->nama }}"
                                            class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-center font-bold">
                                    </div>
                                    <div class="mb-2">
                                        <p class="text-sm text-gray-600 dark:text-gray-300">Tanggal</p>
                                        <input type="text" id="display_tanggal_mengetahui"
                                            value="{{ $penilaian->tanggal_penilaian->format('d-m-Y') }}"
                                            class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-center font-bold"
                                            readonly>
                                    </div>
                                    <div class="mt-12 h-0.5 bg-gray-300 dark:bg-gray-600"></div>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Tanda tangan</p>
                                </div>

                                <!-- Feedback Section -->
                                <div>
                                    <div class="mb-6">
                                        <p class="font-bold mb-2 text-gray-800 dark:text-white">Corrective Action /
                                            Kebutuhan Training</p>
                                        <textarea name="corrective_action" rows="3"
                                            class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">{{ $penilaian->corrective_action }}</textarea>
                                    </div>
                                    <div>
                                        <p class="font-bold mb-2 text-gray-800 dark:text-white">Feedback dari Karyawan
                                            terkait</p>
                                        <textarea name="feedback_karyawan" rows="3"
                                            class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">{{ $penilaian->feedback_karyawan }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="total_score" id="input-score"
                                value="{{ $penilaian->total_score }}">
                            <input type="hidden" name="total_persentase" id="input-persentase"
                                value="{{ $penilaian->total_persentase }}">
                            <input type="hidden" name="indeks" id="input-indeks"
                                value="{{ $penilaian->indeks }}">
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end gap-4 mt-8 no-print">
                            <a href="{{ route('penilaian.karyawan.show') }}"
                                class="bg-gray-600 text-white px-4 py-2 rounded text-xs font-semibold hover:bg-gray-700 uppercase tracking-wider transition-colors">Kembali</a>
                            <button type="button" onclick="resetAktual()"
                                class="bg-gray-600 text-white px-4 py-2 rounded text-xs font-semibold hover:bg-gray-700 uppercase tracking-wider transition-colors">Reset</button>
                            <button type="button" onclick="printTable()"
                                class="bg-green-600 text-white px-4 py-2 rounded text-xs font-semibold hover:bg-green-700 uppercase tracking-wider transition-colors">Print</button>
                            <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded text-xs font-semibold hover:bg-blue-700 uppercase tracking-wider transition-colors">Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('karyawan_id')?.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const fields = ['nip', 'nama', 'status', 'jabatan', 'detail_jabatan', 'departemen'];

            fields.forEach(id => {
                document.getElementById(id).value = selectedOption.value ?
                    selectedOption.dataset[id] : '';
            });

            if (selectedOption.value) {
                document.getElementById('nama_mengetahui').value = selectedOption.dataset.nama;
            }
        });

        // Same JavaScript functions as in index.blade.php
        function updateHasilBobot() {
            let totalSkill = 0,
                totalKinerja = 0,
                totalAttitude = 0;

            document.querySelectorAll('.radio-group').forEach(group => {
                const idx = parseInt(group.dataset.index);
                const bobot = parseInt(group.dataset.bobot) || 0;
                const selectedRadio = group.querySelector('input[type="radio"]:checked');
                const val = selectedRadio ? parseInt(selectedRadio.value) : 0;
                const gap = 4 - val;
                const hasil = val * bobot;

                const row = group.closest('tr');
                const hasilInput = row.querySelector('.hasil-input');
                const gapInput = row.querySelector('.gap-input');

                hasilInput.value = hasil;
                gapInput.value = gap;
                highlightChange(hasilInput);
                highlightChange(gapInput);

                if (idx <= 9) totalSkill += hasil;
                else if (idx <= 14) totalKinerja += hasil;
                else totalAttitude += hasil;
            });

            document.getElementById('total-skill').textContent = totalSkill;
            document.getElementById('total-kinerja').textContent = totalKinerja;
            document.getElementById('total-attitude').textContent = totalAttitude;

            const total = totalSkill + totalKinerja + totalAttitude;
            const max = 280;
            const persen = Math.round((total / max) * 100);

            document.getElementById('result-score').textContent = total;
            document.getElementById('result-persentase').textContent = persen + '%';

            let indeks = '-';
            if (total >= 211) indeks = 'S';
            else if (total >= 141) indeks = 'A';
            else if (total >= 71) indeks = 'B';
            else if (total >= 10) indeks = 'C';

            document.getElementById('result-indeks').textContent = indeks;

            // Update hidden inputs
            document.getElementById('input-score').value = total;
            document.getElementById('input-persentase').value = persen;
            document.getElementById('input-indeks').value = indeks;
        }

        function highlightChange(input) {
            input.classList.add('bg-yellow-100', 'dark:bg-yellow-900');
            setTimeout(() => input.classList.remove('bg-yellow-100', 'dark:bg-yellow-900'), 500);
        }

        function printTable() {
            window.print();
        }

        function resetAktual() {
            document.querySelectorAll('.aktual-radio[value="0"]').forEach(radio => radio.checked = true);
            updateHasilBobot();
        }

        function formatDate(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }

        function getPeriodeFromDate(dateString) {
            if (!dateString) return '';

            const date = new Date(dateString);
            const month = date.getMonth() + 1;

            const monthNames = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            return `${monthNames[month - 1]}`;
        }

        document.querySelectorAll('.aktual-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                const val = parseInt(this.value);
                if (val < 0 || val > 4) {
                    alert("Nilai aktual hanya boleh antara 0–4");
                    this.checked = false;
                } else {
                    updateHasilBobot();
                }
            });
        });

        document.getElementById('tanggal_penilaian').addEventListener('change', function() {
            const formattedDate = formatDate(this.value);
            document.getElementById('display_tanggal_penilaian').value = formattedDate;
            document.getElementById('display_tanggal_mengetahui').value = formattedDate;
            document.getElementById('periode').value = getPeriodeFromDate(this.value);
        });

        document.addEventListener('DOMContentLoaded', function() {
            updateHasilBobot();
            const initialDate = document.getElementById('tanggal_penilaian').value;
            document.getElementById('periode').value = getPeriodeFromDate(initialDate);
        });
    </script>
</x-app-layout>
