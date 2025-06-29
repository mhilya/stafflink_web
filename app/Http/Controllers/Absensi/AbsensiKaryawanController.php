<?php

namespace App\Http\Controllers\Absensi;

use App\Http\Controllers\Controller;
use App\Models\AbsensiKaryawan as Absensi;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;

class AbsensiKaryawanController extends Controller
{
    public function index()
    {
        $data = Absensi::with(['user.karyawan'])
            ->orderBy('tanggal', 'asc')
            ->orderBy('user_id', 'asc')
            ->get();

        $absensi = $data->groupBy(function ($item) {
            return $item->user_id . '_' . $item->tanggal;
        })->map(function ($group) {
            $first = $group->first();
            $user = $first->user;
            $karyawan = $user->karyawan;

            $waktu_masuk = $group->whereNotNull('waktu_masuk')->min('waktu_masuk');
            $waktu_keluar = $group->whereNotNull('waktu_keluar')->max('waktu_keluar');

            $durasi = ($waktu_masuk && $waktu_keluar)
                ? Carbon::parse($waktu_masuk)->diff(Carbon::parse($waktu_keluar))->format('%H:%I:%S')
                : '-';

            $keterangan = $group->pluck('keterangan')->filter(function ($val) {
                return $val && $val !== '-';
            })->first() ?? '-';

            $tipe_absensi = $group->pluck('tipe')->filter()->first() ?? '-';

            return (object)[
                'id' => $first->id,
                'user' => $user,
                'karyawan' => $karyawan,
                'tanggal' => $first->tanggal,
                'tipe_absensi' => $tipe_absensi,
                'waktu_masuk' => $waktu_masuk,
                'waktu_keluar' => $waktu_keluar,
                'durasi' => $durasi,
                'keterangan' => $keterangan,
                'departemen' => $karyawan->departemen ?? '-',
            ];
        })->values();

        return view('absensi.index', compact('absensi'));
    }

    public function downloadPDF()
    {
        $absensi = Absensi::with(['user.karyawan'])->get();
        $pdf = PDF::loadView('absensi-pdf', compact('absensi'));
        return $pdf->download('laporan-absensi.pdf');
    }

    public function show($id)
    {
        $absensi = Absensi::with(['user.karyawan'])->findOrFail($id);
        return view('absensi.show', compact('absensi'));
    }

    public function edit($id)
    {
        $absensi = Absensi::with(['user.karyawan'])->findOrFail($id);
        return view('absensi.edit', compact('absensi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'waktu_masuk' => 'required|date',
            'waktu_keluar' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        $absensi = Absensi::findOrFail($id);
        $absensi->update([
            'waktu_masuk' => $request->waktu_masuk,
            'waktu_keluar' => $request->waktu_keluar,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil dihapus.');
    }
}
