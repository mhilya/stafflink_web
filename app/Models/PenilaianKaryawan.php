<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianKaryawan extends Model
{
    protected $table = 'penilaian_karyawans';

    protected $fillable = [
        'karyawan_id',
        'penilai_id',
        'corrective_action',
        'feedback_karyawan',
        'kompetensi_items',
        'total_skill',
        'total_kinerja',
        'total_attitude',
        'total_score',
        'total_persentase',
        'indeks',
        'periode',
        'tanggal_penilaian'
    ];

    protected $casts = [
        'tanggal_penilaian' => 'date',
        'kompetensi_items' => 'array',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    public function penilai()
    {
        return $this->belongsTo(Manajer::class, 'penilai_id');
    }
}
