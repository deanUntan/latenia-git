<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'     => 'Administrator',
                'email'    => 'admin@latenia.gis',
                'password' => bcrypt('admin123'),
                'role'     => 'admin',
            ],
            [
                'name'     => 'Dinas Pemerintahan Kota Pontianak',
                'email'    => 'pemerintah@latenia.gis',
                'password' => bcrypt('pemerintah123'),
                'role'     => 'pemerintah',
            ],
            [
                'name'     => 'Masyarakat Umum',
                'email'    => 'masyarakat@latenia.gis',
                'password' => bcrypt('masyarakat123'),
                'role'     => 'masyarakat',
            ],
        ];

        foreach ($users as $u) {
            User::updateOrCreate(['email' => $u['email']], $u);
        }

        $this->command->info('Seeded 3 users: admin, pemerintah, masyarakat');
    }
}
