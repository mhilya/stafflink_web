<?php

namespace App\Models;

use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::substr($name, 0, 1))
            ->implode('');
    }

    // Relationships
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function karyawan()
    {
        return $this->hasOne(Karyawan::class);
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    // Role Checks
    public function isAdmin(): bool
    {
        return $this->role && $this->role->name === 'admin';
    }

    public function isHrd(): bool
    {
        return $this->role && $this->role->name === 'hrd';
    }

    public function isManajer(): bool
    {
        return $this->role && $this->role->name === 'manajer';
    }

    public function isKaryawan(): bool
    {
        return $this->role && $this->role->name === 'karyawan';
    }

    // JWT Methods
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
