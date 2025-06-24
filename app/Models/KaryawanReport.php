<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryawanReport extends Model
{
    use HasFactory;

    protected $table = 'karyawan_reports';

    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'shift',
        'jam_kerja',
        'pelayanan',
        'dokumentasi'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'dokumentasi' => 'array',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
