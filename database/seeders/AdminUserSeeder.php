<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = Role::whereIn('name', ['admin', 'karyawan', 'hrd', 'manajer'])->get()->keyBy('name');

        foreach (['admin', 'karyawan', 'hrd', 'manajer'] as $roleName) {
            if (!isset($roles[$roleName])) {
                throw new \Exception("Role '$roleName' belum ada. Jalankan RoleSeeder terlebih dahulu.");
            }
        }

        $users = [
            [
                'name' => 'Admin',
                'email' => 'stafflinkadmin@gmail.com',
                'password' => 'stafflink',
                'role' => 'admin',
            ],
            [
                'name' => 'Karyawan',
                'email' => 'karyawan@gmail.com',
                'password' => 'password',
                'role' => 'karyawan',
            ],
            [
                'name' => 'HRD',
                'email' => 'hrd@gmail.com',
                'password' => 'password',
                'role' => 'hrd',
            ],
            [
                'name' => 'Manajer',
                'email' => 'manajer@gmail.com',
                'password' => 'password',
                'role' => 'manajer',
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                    'role_id' => $roles[$userData['role']]->id,
                ]
            );
        }
    }
}
