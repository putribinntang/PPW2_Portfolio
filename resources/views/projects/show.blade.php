@extends('layouts.app')

@section('title', $project->title)

@section('content')

@if (session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

<h1>{{ $project->title }}</h1>

<p>{{ $project->description }}</p>

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