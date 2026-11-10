<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectImageController extends Controller
{
    // Upload beberapa gambar ke gallery project
    public function store(Request $request, Project $project)
    {
        $remaining = 10 - $project->images()->count();

        if ($remaining <= 0) {
            return back()->withErrors([
                'images' => 'Gallery sudah mencapai batas maksimal 10 gambar.',
            ]);
        }

        $validated = $request->validate([
            'images' => ['required', 'array', 'max:' . $remaining],
            'images.*' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        foreach ($validated['images'] as $file) {
            $project->images()->create([
                'image' => $file->store('projects/gallery', 'public'),
            ]);
        }

        return back()->with('success', 'Gambar berhasil ditambahkan ke gallery.');
    }

    // Mengubah caption gambar
    public function update(Request $request, Project $project, ProjectImage $image)
    {
        abort_unless($image->project_id === $project->id, 404);

        $validated = $request->validate([
            'caption' => ['nullable', 'string', 'max:255'],
        ]);

        $image->update($validated);

        return back()->with('success', 'Caption berhasil diperbarui.');
    }

    // Menghapus gambar dari gallery
    public function destroy(Project $project, ProjectImage $image)
    {
        abort_unless($image->project_id === $project->id, 404);

        Storage::disk('public')->delete($image->image);
        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}