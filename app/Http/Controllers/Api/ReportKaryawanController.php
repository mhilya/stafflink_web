<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\KaryawanReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportKaryawanController extends Controller
{
    public function index()
    {
        $laporans = KaryawanReport::all();
        return response()->json([
            'success' => true,
            'data' => $laporans
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'shift' => 'required|string',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required',
            'pelayanan' => 'nullable|string',
            'dokumentasi.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        // Get karyawan_id from authenticated user
        $karyawan = auth()->user()->karyawan;

        $jam_kerja = $request->jam_masuk . ' - ' . $request->jam_keluar;

        $docs = [];
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $docs[] = $file->store('dokumentasi', 'public');
            }
        }

        $laporan = $karyawan->reports()->create([
            'tanggal' => $request->tanggal,
            'shift' => $request->shift,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'jam_kerja' => $jam_kerja,
            'pelayanan' => $request->pelayanan,
            'dokumentasi' => $docs,
            'catatan' => $request->catatan
        ]);

        return response()->json([
            'success' => true,
            'data' => $laporan->load('karyawan'),
            'message' => 'Laporan berhasil disimpan'
        ], 201);
    }

    public function show($id)
    {
        $laporan = KaryawanReport::find($id);

        if (!$laporan) {
            return response()->json([
                'success' => false,
                'message' => 'Laporan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $laporan
        ]);
    }

    public function update(Request $request, $id)
    {
        $laporan = KaryawanReport::find($id);

        if (!$laporan) {
            return response()->json([
                'success' => false,
                'message' => 'Laporan tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'email' => 'required|email',
            'tanggal' => 'required|date',
            'nama' => 'required|string',
            'departemen' => 'required|string',
            'shift' => 'required|string',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required',
            'pelayanan' => 'nullable|string',
            'dokumentasi.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $existingDocs = json_decode($laporan->dokumentasi, true) ?? [];

        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $existingDocs[] = $file->store('dokumentasi', 'public');
            }
        }

        $jam_kerja = $request->jam_masuk . ' - ' . $request->jam_keluar;

        $laporan->update([
            'email' => $request->email,
            'tanggal' => $request->tanggal,
            'nama' => $request->nama,
            'departemen' => $request->departemen,
            'shift' => $request->shift,
            'jam_kerja' => $jam_kerja,
            'pelayanan' => $request->pelayanan,
            'dokumentasi' => json_encode($existingDocs),
        ]);

        return response()->json([
            'success' => true,
            'data' => $laporan,
            'message' => 'Laporan berhasil diperbarui'
        ]);
    }

    public function destroy($id)
    {
        $laporan = KaryawanReport::find($id);

        if (!$laporan) {
            return response()->json([
                'success' => false,
                'message' => 'Laporan tidak ditemukan'
            ], 404);
        }

        // Delete associated files
        $docs = json_decode($laporan->dokumentasi, true) ?? [];
        foreach ($docs as $doc) {
            Storage::disk('public')->delete($doc);
        }

        $laporan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dihapus'
        ]);
    }
}
