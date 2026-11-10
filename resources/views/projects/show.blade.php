@extends('layouts.app')

@section('title', $project->title)

@section('content')

@if (session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

{{-- Menampilkan Error --}}
@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

{{-- Project Thumbnail --}}
@if ($project->thumbnail)
    <div>
        <img
            src="{{ asset('storage/' . $project->thumbnail) }}"
            alt="{{ $project->title }}"
            width="400"
        >
    </div>
@else
    <p>No Thumbnail</p>
@endif

<h1>{{ $project->title }}</h1>

<p>{{ $project->description }}</p>

<p>
    <strong>Technologies:</strong>
    {{ $project->technologies }}
</p>

@if ($project->link)
    <p>
        <strong>Link:</strong>
        <a href="{{ $project->link }}" target="_blank">
            See Project
        </a>
    </p>
@endif

<hr>

{{-- Gallery Project --}}
<h2>Project Gallery</h2>

<p>Upload gambar tambahan untuk project ini.</p>

<p>
    Jumlah gambar: {{ $project->images->count() }} / 10
</p>

{{-- Form Upload Multiple Images --}}
@if ($project->images->count() < 10)
    <form
        action="{{ route('projects.images.store', $project->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <div>
            <label for="images">Pilih Gambar</label>

            <input
                type="file"
                id="images"
                name="images[]"
                accept=".jpg,.jpeg,.png,.webp"
                multiple
                required
            >
        </div>

        <p>
            Format JPG, JPEG, PNG, WEBP. Maksimal 4 MB per gambar.
            Maksimal 10 gambar untuk setiap project.
        </p>

        <button type="submit">Upload Gallery</button>
    </form>
@else
    <p>Gallery sudah mencapai batas maksimal 10 gambar.</p>
@endif

{{-- Menampilkan Gambar Gallery --}}
<div>
    @forelse ($project->images as $image)
        <div>
            <img
                src="{{ asset('storage/' . $image->image) }}"
                alt="{{ $image->caption ?? 'Project Gallery' }}"
                width="250"
            >

            {{-- Form Edit Caption --}}
            <form
                action="{{ route('projects.images.update', [$project->id, $image->id]) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <div>
                    <label for="caption-{{ $image->id }}">
                        Caption
                    </label>

                    <input
                        type="text"
                        id="caption-{{ $image->id }}"
                        name="caption"
                        value="{{ $image->caption }}"
                        placeholder="Masukkan caption gambar"
                    >
                </div>

                <button type="submit">Update Caption</button>
            </form>

            {{-- Form Hapus Gambar --}}
            <form
                action="{{ route('projects.images.destroy', [$project->id, $image->id]) }}"
                method="POST"
                onsubmit="return confirm('Yakin ingin menghapus gambar ini?')"
            >
                @csrf
                @method('DELETE')

                <button type="submit">Delete Image</button>
            </form>

            <hr>
        </div>
    @empty
        <p>Belum ada gambar di gallery project ini.</p>
    @endforelse
</div>

<hr>

{{-- Pengelolaan Project --}}
<a href="{{ route('projects.edit', $project->id) }}">
    Edit Project
</a>

<br><br>

<form
    action="{{ route('projects.destroy', $project->id) }}"
    method="POST"
    onsubmit="return confirm('Are you sure you want to delete this project?')"
>
    @csrf
    @method('DELETE')

    <button type="submit">Delete Project</button>
</form>

<br>

<a href="{{ route('projects.index') }}">
    Back to Projects
</a>

@endsection