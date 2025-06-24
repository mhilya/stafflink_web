<?php

namespace App\Http\Controllers;

use App\Models\PenilaianKaryawan;
use App\Models\PenilaianManajer;
use App\Http\Controllers\Api\PredictionController;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Data penilaian lokal
        $jumlahPenilaianKaryawanBulanIni = PenilaianKaryawan::whereMonth('tanggal_penilaian', $currentMonth)
            ->whereYear('tanggal_penilaian', $currentYear)
            ->count();

        $jumlahPenilaianManajerBulanIni = PenilaianManajer::whereMonth('tanggal_penilaian', $currentMonth)
            ->whereYear('tanggal_penilaian', $currentYear)
            ->count();

        // Ambil data promosi dari Python API
        $predictionController = new PredictionController();
        $promotionStats = $predictionController->getPromotionStats($currentMonth, $currentYear);

        return view('dashboard', [
            'jumlahPenilaianKaryawanBulanIni' => $jumlahPenilaianKaryawanBulanIni,
            'jumlahPenilaianManajerBulanIni' => $jumlahPenilaianManajerBulanIni,
            'promotedCount' => $promotionStats['promoted'] ?? 0,
            'notPromotedCount' => $promotionStats['not_promoted'] ?? 0
        ]);
    }
}
