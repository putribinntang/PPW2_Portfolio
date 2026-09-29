@extends('layouts.app')

@section('title', 'Trash')

@section('content')

<h1>Trash</h1>

@if (session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

@if ($projects->isEmpty())
    <p>There are no deleted projects.</p>
@else

    @foreach ($projects as $project)

        <div>
            <h2>{{ $project->title }}</h2>

            <p>{{ $project->description }}</p>

            <form
                action="{{ route('projects.restore', $project->id) }}"
                method="POST"
            >
                @csrf
                @method('PATCH')

                <button type="submit">
                    Restore
                </button>
            </form>

            <form
                action="{{ route('projects.forceDelete', $project->id) }}"
                method="POST"
            >
                @csrf
                @method('DELETE')

                <button type="submit">
                    Permanent Delete
                </button>
            </form>
        </div>

        <hr>

    @endforeach

@endif

<a href="{{ route('projects.index') }}">
    Back to Projects
</a>

@endsection