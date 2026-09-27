@extends('layouts.app')

@section('title', 'Add Project')

@section('content')

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h1>Add Project</h1>

<form action="{{ route('projects.store') }}" method="POST">

    @csrf

    <div>
        <label for="title">Project Title</label>
        <input type="text" id="title" name="title" required>
    </div>

    <br>

    <div>
        <label for="description">Description</label>
        <textarea id="description" name="description" required></textarea>
    </div>

    <br>

    <div>
        <label for="technologies">Technologies</label>
        <input type="text" id="technologies" name="technologies">
    </div>

    <br>

    <div>
        <label for="link">Link Project</label>
        <input type="url" id="link" name="link">
    </div>

    <br>

    <button type="submit">Add Project</button>

</form>

<br>

<a href="{{ route('projects.index') }}">
    Back to Projects
</a>

@endsection