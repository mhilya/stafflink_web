<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AbsensiKaryawan extends Model
{
    protected $table = 'absensi_karyawans';

    protected $fillable = [
        'user_id',
        'nama',
        'tanggal',
        'tipe',
        'keterangan',
        'waktu_masuk',
        'waktu_keluar',
        'departemen',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu_masuk' => 'datetime',
        'waktu_keluar' => 'datetime',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'user_id', 'user_id');
    }
}
