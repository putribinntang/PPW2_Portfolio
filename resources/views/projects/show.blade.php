@extends('layouts.app')

@section('title', $project->title)

@section('content')

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
            Lihat Project
        </a>
    </p>
@endif

<a href="{{ route('projects.index') }}">
    Kembali ke Projects
</a>

@endsection