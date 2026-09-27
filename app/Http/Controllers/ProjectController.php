<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'technologies' => 'nullable',
            'link' => 'nullable|url'
        ]);

        Project::create($validatedData);

        return redirect()->route('projects.index')
            ->with('success', 'Project successfully added.');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'technologies' => 'nullable',
            'link' => 'nullable|url'
        ]);

        $project->update($validatedData);

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Project successfully updated.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project successfully deleted.');
    }
}