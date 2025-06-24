<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianManajer extends Model
{
    protected $table = 'penilaian_manajers';

    protected $fillable = [
        'manajer_id',
        'penilai_id',
        'corrective_action',
        'feedback_manajer',
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

    public function manajer()
    {
        return $this->belongsTo(Manajer::class, 'manajer_id');
    }

    public function penilai()
    {
        return $this->belongsTo(Hrd::class, 'penilai_id');
    }
}
