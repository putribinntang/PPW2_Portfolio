<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            \App\Models\Project::create([
            'title' => 'Project Judul Ke-' . $i,
            'description' => 'Deskripsi untuk project judul ke-' . $i,
            ]);
        }
    }
}
