<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(KategoriSeeder::class);

        // Admin user
        $admin = User::create([
            'name'     => 'Admin Kampus',
            'email'    => 'admin@kampus.ac.id',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        // Mahasiswa demo
        $mhs = User::create([
            'name'     => 'Keiveen',
            'email'    => 'keiveen@mhs.kampus.ac.id',
            'password' => Hash::make('password'),
        ]);
        $mhs->assignRole('mahasiswa');

        $mhs2 = User::create([
            'name'     => 'Siti Rahayu',
            'email'    => 'siti@mahasiswa.ac.id',
            'password' => Hash::make('password'),
        ]);
        $mhs2->assignRole('mahasiswa');
    }
}