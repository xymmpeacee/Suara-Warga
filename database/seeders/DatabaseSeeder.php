<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat roles (firstOrCreate biar ga error kalau udah ada)
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'petugas']);
        Role::firstOrCreate(['name' => 'warga']);

        // Buat akun admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@suarawarga.com'],
            [
                'name'     => 'Admin SuaraWarga',
                'password' => Hash::make('admin123'),
            ]
        );

        $admin->assignRole('admin');
    }
}