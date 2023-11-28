<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTahun extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\CategoryTahun::create([
            'nama_category_tahun' => '2021',
            'slug' => '2021',
            'status' => 'ACTIVE',
            'deskripsi' => 'Tahun 2021',
        ]);
    }
}
