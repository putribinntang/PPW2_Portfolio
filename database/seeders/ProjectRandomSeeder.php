<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectRandomSeeder extends Seeder
{
    public function run(): void
    {
        $topics = [
            'Website Portfolio',
            'E-Commerce Website',
            'UI UX Design',
            'Laravel Application',
            'Mobile Application',
            'Information System',
            'Database Management',
            'Petshop Website',
            'Booking System',
            'Landing Page',
            'Dashboard Admin',
            'Online Store',
            'Educational Website',
            'Management System',
            'Travel Website',
        ];

        for ($i = 1; $i <= 25; $i++) {
            Project::create([
                'title' => $topics[array_rand($topics)]
                    . ' #' . Str::upper(Str::random(6)),
                'description' => 'Project contoh nomor '
                    . $i . ' untuk latihan Seeder dan Pagination.',
            ]);
        }
    }
}