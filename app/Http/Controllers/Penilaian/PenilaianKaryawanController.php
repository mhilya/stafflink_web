<?php

namespace App\Http\Controllers\Penilaian;

use App\Http\Controllers\Controller;
use App\Models\PenilaianKaryawan;
use App\Models\Karyawan;
use App\Models\Manajer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PenilaianKaryawanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:manajer,hrd');
    }

    protected $kompetensi = [
        ['Kategori' => 'Skill 35%', 'Kompetensi' => 'Kepemimpinan / Leadership', 'Metode' => 'Observation'],
        ['Kategori' => '', 'Kompetensi' => 'Penyusunan Rencana & Strategi / Management Planning', 'Metode' => 'Project assignment'],
        ['Kategori' => '', 'Kompetensi' => 'Analisa dan Penyelesaian Masalah / Analytical Thinking & Problem Solving', 'Metode' => 'Job assignment'],
        ['Kategori' => '', 'Kompetensi' => 'Pengambilan Keputusan / Decision Making', 'Metode' => 'Observation'],
        ['Kategori' => '', 'Kompetensi' => 'Kemampuan Presentasi / Presentation Skill', 'Metode' => 'Observation'],
        ['Kategori' => '', 'Kompetensi' => 'Kerja sama tim / Teamwork', 'Metode' => 'Observation'],
        ['Kategori' => '', 'Kompetensi' => 'Kemampuan Negosiasi / Negotiation Skills', 'Metode' => 'Observation'],
        ['Kategori' => '', 'Kompetensi' => 'Kemampuan Pengembangan & pembelajaran / Learning skills', 'Metode' => 'Observation'],
        ['Kategori' => '', 'Kompetensi' => 'Fokus Pelanggan / Customer Focus', 'Metode' => 'Observation'],
        ['Kategori' => '', 'Kompetensi' => 'Orientasi pada kualitas kerja / Quality Orientation', 'Metode' => 'Job assignment'],
        ['Kategori' => 'Kinerja 35%', 'Kompetensi' => 'Pencapaian Target Revenue', 'Metode' => 'Job assignment'],
        ['Kategori' => '', 'Kompetensi' => 'Pertumbuhan pendapatan dan profitabilitas', 'Metode' => 'Job assignment'],
        ['Kategori' => '', 'Kompetensi' => 'Inovasi kepemimpinan', 'Metode' => 'Job assignment'],
        ['Kategori' => '', 'Kompetensi' => 'Pemeliharaan dan keamanan properti', 'Metode' => 'Job assignment'],
        ['Kategori' => '', 'Kompetensi' => 'Kepuasan karyawan dan tamu', 'Metode' => 'Job assignment'],
        ['Kategori' => 'Attitude 30%', 'Kompetensi' => 'Empati / Empathy', 'Metode' => 'Observation'],
        ['Kategori' => '', 'Kompetensi' => 'Inisiatif', 'Metode' => 'Observation'],
        ['Kategori' => '', 'Kompetensi' => 'Pelaksanaan 6K', 'Metode' => 'Observation'],
        ['Kategori' => '', 'Kompetensi' => 'Kehadiran / Attendance', 'Metode' => 'Recording'],
        ['Kategori' => '', 'Kompetensi' => 'Kedisiplinan / Discipline', 'Metode' => 'Recording'],
    ];

    protected $kategori_bobot = [
        'Skill 35%' => 4,
        'Kinerja 35%' => 3,
        'Attitude 30%' => 3,
    ];

    public function index()
    {
        $jumlahPenilaianBulanIni = PenilaianKaryawan::whereMonth('tanggal_penilaian', now()->month)
                            ->whereYear('tanggal_penilaian', now()->year)
                            ->count();

        $karyawans = Karyawan::with('user.role')
                      ->where('status', 'Aktif')
                      ->get();

        $penilai = Manajer::where('user_id', Auth::id())->first();

        return view('penilaian.karyawan.index', [
            'jumlahPenilaianBulanIni' => $jumlahPenilaianBulanIni,
            'kompetensi' => $this->kompetensi,
            'kategori_bobot' => $this->kategori_bobot,
            'karyawans' => $karyawans,
            'penilai' => $penilai
        ]);
    }

    public function create(Request $request, $karyawan_id)
    {
        $karyawan = Karyawan::with('user.role')->findOrFail($karyawan_id);
        $penilai = Manajer::where('user_id', Auth::id())->first();

        return view('penilaian.karyawan.index', [
            'kompetensi' => $this->kompetensi,
            'kategori_bobot' => $this->kategori_bobot,
            'karyawanSelected' => $karyawan,
            'karyawans' => Karyawan::where('status', 'Aktif')->get(),
            'penilai' => $penilai
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'penilai_id' => 'required|exists:manajers,id',
            'periode' => 'required|string|max:255',
            'tanggal_penilaian' => 'required|date',
            'nama_mengetahui' => 'required|string|max:255',
            'corrective_action' => 'nullable|string',
            'feedback_karyawan' => 'nullable|string',
            'aktual.*' => 'required|numeric|min:0|max:4',
            'komentar.*' => 'nullable|string|max:1000',
        ]);

        // Get karyawan and penilai data
        $karyawan = Karyawan::with('user.role')->findOrFail($request->karyawan_id);
        $penilai = Manajer::findOrFail($request->penilai_id);

        // Calculate scores
        $totalSkill = 0;
        $totalKinerja = 0;
        $totalAttitude = 0;
        $kompetensiItems = [];

        foreach ($this->kompetensi as $index => $item) {
            $kategori = $item['Kategori'] ?: $this->getCurrentCategory($index);
            $aktual = $request->aktual[$index] ?? 0;
            $bobot = $this->kategori_bobot[$kategori] ?? 0;
            $hasil_bobot = $aktual * $bobot;

            // Accumulate category totals
            if (strpos($kategori, 'Skill') !== false) {
                $totalSkill += $hasil_bobot;
            } elseif (strpos($kategori, 'Kinerja') !== false) {
                $totalKinerja += $hasil_bobot;
            } elseif (strpos($kategori, 'Attitude') !== false) {
                $totalAttitude += $hasil_bobot;
            }

            $kompetensiItems[] = [
                'kategori' => $kategori,
                'kompetensi' => $item['Kompetensi'],
                'metode' => $item['Metode'],
                'target' => 4,
                'aktual' => $aktual,
                'hasil_bobot' => $hasil_bobot,
                'gap' => 4 - $aktual,
                'komentar' => $request->komentar[$index] ?? null,
            ];
        }

        // Calculate overall results
        $totalScore = $totalSkill + $totalKinerja + $totalAttitude;
        $persentase = round(($totalScore / 280) * 100);
        $indeks = $this->calculateIndex($totalScore);

        DB::transaction(function () use ($request, $karyawan, $penilai, $kompetensiItems, $totalSkill, $totalKinerja, $totalAttitude, $totalScore, $persentase, $indeks) {
            PenilaianKaryawan::create([
                'karyawan_id' => $karyawan->id,
                'penilai_id' => $penilai->id,
                'periode' => $request->periode,
                'tanggal_penilaian' => $request->tanggal_penilaian,
                'nama_mengetahui' => $request->nama_mengetahui,
                'corrective_action' => $request->corrective_action,
                'feedback_karyawan' => $request->feedback_karyawan,
                'kompetensi_items' => $kompetensiItems,
                'total_skill' => $totalSkill,
                'total_kinerja' => $totalKinerja,
                'total_attitude' => $totalAttitude,
                'total_score' => $totalScore,
                'total_persentase' => $persentase,
                'indeks' => $indeks,
            ]);
        });

        return redirect()->route('penilaian.karyawan.show')->with('success', 'Penilaian berhasil disimpan.');
    }

    private function getCurrentCategory($index)
    {
        $category = '';
        for ($i = $index; $i >= 0; $i--) {
            if (!empty($this->kompetensi[$i]['Kategori'])) {
                $category = $this->kompetensi[$i]['Kategori'];
                break;
            }
        }
        return $category;
    }

    private function calculateIndex($score)
    {
        if ($score >= 211) return 'S';
        if ($score >= 141) return 'A';
        if ($score >= 71) return 'B';
        if ($score >= 10) return 'C';
        return '-';
    }

    public function show(Request $request)
    {
        $query = PenilaianKaryawan::with(['karyawan.user.role', 'penilai.user'])
                    ->orderBy('tanggal_penilaian', 'desc');

        // Filter berdasarkan pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('karyawan', function($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                ->orWhere('nip', 'like', "%$search%");
            });
        }

        // Filter berdasarkan periode
        if ($request->has('periode') && $request->periode != '') {
            $query->where('periode', $request->periode);
        }

        // Filter berdasarkan indeks
        if ($request->has('indeks') && $request->indeks != '') {
            $query->where('indeks', $request->indeks);
        }

        // Filter berdasarkan tahun
        if ($request->has('tahun') && $request->tahun != '') {
            $query->whereYear('tanggal_penilaian', $request->tahun);
        }

        // Ambil data unik untuk filter dropdown
        $periodes = PenilaianKaryawan::select('periode')
                    ->distinct()
                    ->orderBy('periode', 'desc')
                    ->pluck('periode');

        $indeksOptions = PenilaianKaryawan::select('indeks')
                        ->distinct()
                        ->orderBy('indeks', 'desc')
                        ->pluck('indeks');

        $tahunOptions = PenilaianKaryawan::selectRaw('date_part(\'year\', tanggal_penilaian) as tahun')
                    ->distinct()
                    ->orderBy('tahun', 'desc')
                    ->pluck('tahun');

        $laporans = $query->paginate(10);

        return view('penilaian.karyawan.show', compact('laporans', 'periodes', 'indeksOptions', 'tahunOptions'));
    }

    public function edit($id)
    {
        $penilaian = PenilaianKaryawan::with(['karyawan.user.role', 'penilai'])->findOrFail($id);
        $karyawans = Karyawan::with('user.role')->where('status', 'Aktif')->get();
        $penilai = Manajer::where('user_id', Auth::id())->first();

        $kompetensiValues = [];
        foreach ($penilaian->kompetensi_items as $item) {
            $kompetensiValues[] = [
                'aktual' => $item['aktual'],
                'komentar' => $item['komentar']
            ];
        }

        return view('penilaian.karyawan.edit', [
            'penilaian' => $penilaian,
            'kompetensi' => $this->kompetensi,
            'kategori_bobot' => $this->kategori_bobot,
            'karyawans' => $karyawans,
            'penilai' => $penilai,
            'kompetensiValues' => $kompetensiValues
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'penilai_id' => 'required|exists:manajers,id',
            'periode' => 'required|string|max:255',
            'tanggal_penilaian' => 'required|date',
            'nama_mengetahui' => 'required|string|max:255',
            'corrective_action' => 'nullable|string',
            'feedback_karyawan' => 'nullable|string',
            'aktual.*' => 'required|numeric|min:0|max:4',
            'komentar.*' => 'nullable|string|max:1000',
        ]);

        $penilaian = PenilaianKaryawan::findOrFail($id);
        $karyawan = Karyawan::with('user.role')->findOrFail($request->karyawan_id);
        $penilai = Manajer::findOrFail($request->penilai_id);

        // Calculate scores
        $totalSkill = 0;
        $totalKinerja = 0;
        $totalAttitude = 0;
        $kompetensiItems = [];

        foreach ($this->kompetensi as $index => $item) {
            $kategori = $item['Kategori'] ?: $this->getCurrentCategory($index);
            $aktual = $request->aktual[$index] ?? 0;
            $bobot = $this->kategori_bobot[$kategori] ?? 0;
            $hasil_bobot = $aktual * $bobot;

            // Accumulate category totals
            if (strpos($kategori, 'Skill') !== false) {
                $totalSkill += $hasil_bobot;
            } elseif (strpos($kategori, 'Kinerja') !== false) {
                $totalKinerja += $hasil_bobot;
            } elseif (strpos($kategori, 'Attitude') !== false) {
                $totalAttitude += $hasil_bobot;
            }

            $kompetensiItems[] = [
                'kategori' => $kategori,
                'kompetensi' => $item['Kompetensi'],
                'metode' => $item['Metode'],
                'target' => 4,
                'aktual' => $aktual,
                'hasil_bobot' => $hasil_bobot,
                'gap' => 4 - $aktual,
                'komentar' => $request->komentar[$index] ?? null,
            ];
        }

        // Calculate overall results
        $totalScore = $totalSkill + $totalKinerja + $totalAttitude;
        $persentase = round(($totalScore / 280) * 100);
        $indeks = $this->calculateIndex($totalScore);

        DB::transaction(function () use ($request, $penilaian, $karyawan, $penilai, $kompetensiItems, $totalSkill, $totalKinerja, $totalAttitude, $totalScore, $persentase, $indeks) {
            $penilaian->update([
                'karyawan_id' => $karyawan->id,
                'penilai_id' => $penilai->id,
                'periode' => $request->periode,
                'tanggal_penilaian' => $request->tanggal_penilaian,
                'nama_mengetahui' => $request->nama_mengetahui,
                'corrective_action' => $request->corrective_action,
                'feedback_karyawan' => $request->feedback_karyawan,
                'kompetensi_items' => $kompetensiItems,
                'total_skill' => $totalSkill,
                'total_kinerja' => $totalKinerja,
                'total_attitude' => $totalAttitude,
                'total_score' => $totalScore,
                'total_persentase' => $persentase,
                'indeks' => $indeks,
            ]);
        });

        return redirect()->route('penilaian.karyawan.show')->with('success', 'Penilaian berhasil diperbarui.');
    }

    public function printPdf($id)
    {
        $penilaian = PenilaianKaryawan::with(['karyawan.user.role', 'penilai.user'])
                    ->findOrFail($id);

        $pdf = \PDF::loadView('penilaian.karyawan.print', [
            'penilaian' => $penilaian,
            'kompetensi' => $this->kompetensi,
            'kategori_bobot' => $this->kategori_bobot
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('penilaian-karyawan-'.$penilaian->karyawan->nip.'.pdf');
    }

    public function destroy($id)
    {
        $penilaian = PenilaianKaryawan::findOrFail($id);

        DB::transaction(function () use ($penilaian) {
            $penilaian->delete();
        });

        return redirect()->route('penilaian.karyawan.show')->with('success', 'Penilaian berhasil dihapus.');
    }
}
