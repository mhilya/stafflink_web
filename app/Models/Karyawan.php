<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawans';

    protected $fillable = [
        'user_id',
        'nip',
        'nama',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'departemen',
        'status',
        'jabatan',
        'detail_jabatan',
        'edukasi',
        'gender',
        'no_telepon',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reports()
    {
        return $this->hasMany(KaryawanReport::class);
    }

    public function absensi()
    {
        return $this->hasManyThrough(
            Absensi::class,
            User::class,
            'id',
            'user_id',
            'user_id',
            'id' 
        );
    }
}
