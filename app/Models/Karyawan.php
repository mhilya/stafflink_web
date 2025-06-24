<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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

    public function reports()
    {
        return $this->hasMany(KaryawanReport::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
