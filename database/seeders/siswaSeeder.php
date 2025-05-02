<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class siswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswa = [
            [
                'id' => '111',
                'nama' => 'Awenk',
            ],
            [
                'id' => '222',
                'nama' => 'Guludug',
            ],
        ];
        Siswa::insert($siswa);
    }
}
