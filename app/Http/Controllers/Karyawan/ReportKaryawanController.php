<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\KaryawanReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportKaryawanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:karyawan');
    }

    public function index()
    {
        $karyawan = Auth::user()->karyawan;
        $reports = $karyawan->reports()
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('karyawan.reports.index', compact('reports'));
    }

    public function create()
    {
        return view('karyawan.reports.create');
    }

    public function store(Request $request)
    {
        $karyawan = Auth::user()->karyawan;

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'shift' => 'required|string|max:50',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'required|date_format:H:i|after:jam_masuk',
            'pelayanan' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $jamKerja = $validated['jam_masuk'] . ' - ' . $validated['jam_keluar'];

        $dokumentasi = [];
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $path = $file->store('karyawan-reports', 'public');
                $dokumentasi[] = [
                    'path' => $path,
                    'name' => $file->getClientOriginalName(),
                    'type' => $file->getClientMimeType()
                ];
            }
        }

        KaryawanReport::create([
            'karyawan_id' => $karyawan->id,
            'tanggal' => $validated['tanggal'],
            'shift' => $validated['shift'],
            'jam_kerja' => $jamKerja,
            'pelayanan' => $validated['pelayanan'],
            'dokumentasi' => !empty($dokumentasi) ? $dokumentasi : null,
        ]);

        return redirect()->route('karyawan.reports.index')
            ->with('success', 'Laporan harian berhasil disimpan.');
    }

    public function show(KaryawanReport $report)
    {
        $this->authorize('view', $report);

        return view('karyawan.reports.show', compact('report'));
    }

    public function edit(KaryawanReport $report)
    {
        $this->authorize('update', $report);

        return view('karyawan.reports.edit', compact('report'));
    }

    public function update(Request $request, KaryawanReport $report)
    {
        $this->authorize('update', $report);

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'shift' => 'required|string|max:50',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'required|date_format:H:i|after:jam_masuk',
            'pelayanan' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'hapus_dokumen' => 'nullable|array'
        ]);

        $jamKerja = $validated['jam_masuk'] . ' - ' . $validated['jam_keluar'];

        // Handle dokumen yang dihapus
        $existingDocs = $report->dokumentasi ?? [];
        if ($request->has('hapus_dokumen')) {
            foreach ($request->hapus_dokumen as $docIndex) {
                if (isset($existingDocs[$docIndex])) {
                    Storage::disk('public')->delete($existingDocs[$docIndex]['path']);
                    unset($existingDocs[$docIndex]);
                }
            }
            $existingDocs = array_values($existingDocs);
        }

        // Handle dokumen baru
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $path = $file->store('karyawan-reports', 'public');
                $existingDocs[] = [
                    'path' => $path,
                    'name' => $file->getClientOriginalName(),
                    'type' => $file->getClientMimeType()
                ];
            }
        }

        $report->update([
            'tanggal' => $validated['tanggal'],
            'shift' => $validated['shift'],
            'jam_kerja' => $jamKerja,
            'pelayanan' => $validated['pelayanan'],
            'dokumentasi' => !empty($existingDocs) ? $existingDocs : null,
        ]);

        return redirect()->route('karyawan.reports.index')
            ->with('success', 'Laporan harian berhasil diperbarui.');
    }

    public function destroy(KaryawanReport $report)
    {
        $this->authorize('delete', $report);

        // Hapus file dokumentasi
        if ($report->dokumentasi) {
            foreach ($report->dokumentasi as $doc) {
                Storage::disk('public')->delete($doc['path']);
            }
        }

        $report->delete();

        return redirect()->route('karyawan.reports.index')
            ->with('success', 'Laporan harian berhasil dihapus.');
    }
}
