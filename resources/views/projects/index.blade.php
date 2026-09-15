@extends('layouts.app')

@section('title', 'Projects')

@section('content')

<h1>Projects</h1>

<a href="{{ route('projects.create') }}">Tambah Project</a>

@foreach ($projects as $project)

    <div>
        <h2>{{ $project->title }}</h2>

        <p>{{ $project->description }}</p>

        <a href="{{ route('projects.show', $project->id) }}">
            Lihat Detail
        </a>
    </div>

@endforeach

@endsection