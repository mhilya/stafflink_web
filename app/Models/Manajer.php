<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Manajer extends Model
{
    protected $table = 'manajers';

    protected $fillable = [
        'user_id',
        'nip',
        'nama',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'departemen',
        'status',
        'detail_jabatan',
        'edukasi',
        'gender',
        'no_telepon',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
