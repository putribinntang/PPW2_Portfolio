@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')

<h1>Edit Project</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('projects.update', $project->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div>
        <label for="title">Project Title</label>
        <input
            type="text"
            id="title"
            name="title"
            value="{{ old('title', $project->title) }}"
            required
        >
    </div>

    <br>

    <div>
        <label for="description">Description</label>
        <textarea
            id="description"
            name="description"
            required
        >{{ old('description', $project->description) }}</textarea>
    </div>

    <br>

    <div>
        <label for="technologies">Technologies</label>
        <input
            type="text"
            id="technologies"
            name="technologies"
            value="{{ old('technologies', $project->technologies) }}"
        >
    </div>

    <br>

    <div>
        <label for="link">Project Link</label>
        <input
            type="url"
            id="link"
            name="link"
            value="{{ old('link', $project->link) }}"
        >
    </div>

    <br>

    <button type="submit">Save Changes</button>

</form>

<br>

<a href="{{ route('projects.show', $project->id) }}">
    Back to Details
</a>

@endsection