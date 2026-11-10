<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $perPage = (int) $request->input('per_page', 10);

        if (! in_array($perPage, [5, 10, 25], true)) {
            $perPage = 10;
        }

        $projects = Project::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return view('projects.index', compact(
            'projects',
            'search',
            'perPage'
        ));
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
            'link' => 'nullable|url',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:min_width=400,min_height=300',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

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
            'link' => 'nullable|url',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:min_width=400,min_height=300'
        ]);

        if ($request->hasFile('thumbnail')) {

            // Hapus thumbnail lama jika tersedia
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }

            // Simpan thumbnail baru
            $validatedData['thumbnail'] = $request->file('thumbnail')
                ->store('thumbnails', 'public');
        }

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

    public function trash()
    {
        $projects = Project::onlyTrashed()->get();

        return view('projects.trash', compact('projects'));
    }

    public function restore($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);

        $project->restore();

        return redirect()->route('projects.trash')
            ->with('success', 'Project successfully restored.');
    }

    public function forceDelete($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);

        // Hapus thumbnail project
        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        // Hapus semua gambar gallery
        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->image);
            $image->delete();
        }

        // Hapus project secara permanen
        $project->forceDelete();

        return redirect()->route('projects.trash')
            ->with('success', 'Project successfully deleted permanently.');
    }
}