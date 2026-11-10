<?php

namespace App\Http\Controllers;

use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalProjects' => Project::count(),

            'totalPublished' => Project::where('status', 'published')->count(),

            'totalDraft' => Project::where('status', 'draft')->count(),

            'latestProjects' => Project::latest()->take(5)->get(),
        ]);
    }
}