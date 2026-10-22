
@extends('layouts.app')

@section('title', 'Projects')


@section('content')

@if (session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

<h1>Projects</h1>

<a href="{{ route('projects.create') }}">Add Project</a>
<br>
<a href="{{ route('projects.trash') }}">Trash</a>

<form action="{{ route('projects.index') }}"
      method="GET"
      style="margin: 20px 0;">

    <input
        type="text"
        name="search"
        value="{{ $search }}"
        placeholder="Cari judul project..."
    >

    <select name="per_page">
        <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>
            5 data
        </option>
        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>
            10 data
        </option>
        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>
            25 data
        </option>
    </select>

    <button type="submit">Cari / Terapkan</button>

    <a href="{{ route('projects.index') }}">Reset</a>
</form>

@if ($projects->count() > 0)

    @foreach ($projects as $project)
        <div>
            <p>No. {{ $projects->firstItem() + $loop->index }}</p>

            <h2>{{ $project->title }}</h2>

            <p>{{ $project->description }}</p>

            <a href="{{ route('projects.show', $project->id) }}">
                Lihat Detail
            </a>
        </div>
    @endforeach

    <div>
        Menampilkan {{ $projects->firstItem() }}
        sampai {{ $projects->lastItem() }}
        dari {{ $projects->total() }} project.
        <br>
        Halaman: {{ $projects->currentPage() }}
        <br>
        Data per halaman: {{ $projects->perPage() }}
    </div>

    <div>
        {{ $projects->links() }}
    </div>

@else
    <p>Project tidak ditemukan.</p>
@endif

@endsection
