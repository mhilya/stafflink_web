<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AbsensiKaryawan as Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AbsensiKaryawanController extends Controller
{
    public function index(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $absensi = Absensi::where('user_id', $request->user_id)
                ->orderBy('tanggal', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'status' => true,
                'data' => $absensi
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|string',
                'nama' => 'required|string',
                'tanggal' => 'required|date',
                'tipe' => 'required|in:masuk,pulang,sakit,izin',
                'keterangan' => 'nullable|string',
                'waktu_masuk' => 'nullable|date_format:H:i:s',
                'departemen' => 'nullable|string',
            ]);

            $userId = $request->user_id;
            $tanggal = $request->tanggal;
            $tipe = $request->tipe;

            // Check existing attendance
            $sudahAbsenTipeIni = Absensi::where('user_id', $userId)
                ->whereDate('tanggal', $tanggal)
                ->where('tipe', $tipe)
                ->exists();

            if ($sudahAbsenTipeIni) {
                return response()->json([
                    'message' => "Anda sudah absen $tipe hari ini."
                ], 400);
            }

            // Special validation for izin/sakit
            if (in_array($tipe, ['izin', 'sakit'])) {
                $sudahAbsenMasuk = Absensi::where('user_id', $userId)
                    ->whereDate('tanggal', $tanggal)
                    ->where('tipe', 'masuk')
                    ->exists();

                $sudahAbsenPulang = Absensi::where('user_id', $userId)
                    ->whereDate('tanggal', $tanggal)
                    ->where('tipe', 'pulang')
                    ->exists();

                if ($sudahAbsenMasuk && $sudahAbsenPulang) {
                    return response()->json([
                        'message' => 'Tidak bisa absen izin atau sakit setelah melakukan absen masuk dan pulang hari ini.'
                    ], 400);
                }
            }

            $jamSekarang = now()->format('H:i:s');

            $data = [
                'user_id' => $userId,
                'nama' => $request->nama,
                'tanggal' => $tanggal,
                'tipe' => $tipe,
                'keterangan' => in_array($tipe, ['sakit', 'izin'])
                    ? ($request->keterangan ?? '-')
                    : '-',
                'departemen' => $request->departemen ?? '-',
            ];

            if ($tipe === 'masuk') {
                $data['waktu_masuk'] = $jamSekarang;
            } elseif ($tipe === 'pulang') {
                $data['waktu_keluar'] = $jamSekarang;
            }

            $absensi = Absensi::create($data);

            return response()->json([
                'message' => 'Absen berhasil',
                'data' => $absensi->load('user.karyawan'),
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function checkAbsen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string',
            'tanggal' => 'required|date_format:Y-m-d',
            'tipe' => 'required|string|in:masuk,pulang,izin,sakit',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $userId = $request->input('user_id');
        $tanggal = $request->input('tanggal');
        $tipe = $request->input('tipe');

        if (in_array($tipe, ['izin', 'sakit'])) {
            $sudahAbsenMasuk = Absensi::where('user_id', $userId)
                ->whereDate('tanggal', $tanggal)
                ->where('tipe', 'masuk')
                ->exists();

            $sudahAbsenPulang = Absensi::where('user_id', $userId)
                ->whereDate('tanggal', $tanggal)
                ->where('tipe', 'pulang')
                ->exists();

            if ($sudahAbsenMasuk && $sudahAbsenPulang) {
                return response()->json([
                    'success' => true,
                    'exists' => true,
                ]);
            }
        }

        $exists = Absensi::where('user_id', $userId)
            ->whereDate('tanggal', $tanggal)
            ->where('tipe', $tipe)
            ->exists();

        return response()->json([
            'success' => true,
            'exists' => $exists,
        ]);
    }

    public function getAbsensiBulanan()
    {
        $user = Auth::user();

        $absensiBulanan = Absensi::selectRaw('EXTRACT(MONTH FROM tanggal) as month, COUNT(*) as count')
            ->where('user_id', $user->id)
            ->whereBetween('tanggal', [now()->subMonths(6)->startOfMonth(), now()->endOfMonth()])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $result = [];
        foreach ($absensiBulanan as $item) {
            $result[(int)$item->month] = $item->count;
        }

        $final = [];
        for ($month = 1; $month <= 12; $month++) {
            $final[] = $result[$month] ?? 0;
        }

        return response()->json([
            'status' => true,
            'data' => [
                'absensi_per_bulan' => $final,
                'karyawan' => $user->karyawan // Include karyawan data
            ]
        ]);
    }
}
