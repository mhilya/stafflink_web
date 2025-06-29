<?php

namespace App\Http\Controllers;

use App\Models\PenilaianKaryawan;
use App\Models\PenilaianManajer;
use App\Models\AbsensiKaryawan as Absensi;
use App\Http\Controllers\Api\PredictionController;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $today = Carbon::today()->toDateString();

        // Data penilaian lokal
        $jumlahPenilaianKaryawanBulanIni = PenilaianKaryawan::whereMonth('tanggal_penilaian', $currentMonth)
            ->whereYear('tanggal_penilaian', $currentYear)
            ->count();

        $jumlahPenilaianManajerBulanIni = PenilaianManajer::whereMonth('tanggal_penilaian', $currentMonth)
            ->whereYear('tanggal_penilaian', $currentYear)
            ->count();

        // Data absensi
        $jumlahAbsensiKaryawanHariIni = Absensi::whereDate('tanggal', $today)
            ->whereNotNull('waktu_masuk')
            ->distinct('user_id')
            ->count('user_id');

        // $jumlahAbsensiManajerHariIni = Absensi::whereHas('user.karyawan', function($query) {
        //         $query->where('jabatan', 'like', '%manager%')
        //               ->orWhere('jabatan', 'like', '%manajer%');
        //     })
        //     ->whereDate('tanggal', $today)
        //     ->whereNotNull('waktu_masuk')
        //     ->distinct('user_id')
        //     ->count('user_id');

        // Ambil data promosi dari Python API
        $predictionController = new PredictionController();
        $promotionStats = $predictionController->getPromotionStats($currentMonth, $currentYear);

        return view('dashboard', [
            'jumlahPenilaianKaryawanBulanIni' => $jumlahPenilaianKaryawanBulanIni,
            'jumlahPenilaianManajerBulanIni' => $jumlahPenilaianManajerBulanIni,
            'jumlahAbsensiKaryawanHariIni' => $jumlahAbsensiKaryawanHariIni,
            // 'jumlahAbsensiManajerHariIni' => $jumlahAbsensiManajerHariIni,
            'promotedCount' => $promotionStats['promoted'] ?? 0,
            'notPromotedCount' => $promotionStats['not_promoted'] ?? 0
        ]);
    }
}
