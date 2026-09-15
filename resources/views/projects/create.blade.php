@extends('layouts.app')

@section('title', 'Tambah Project')

@section('content')

<h1>Tambah Project</h1>

<form action="{{ route('projects.store') }}" method="POST">

    @csrf

    <div>
        <label for="title">Judul Project</label>
        <input type="text" id="title" name="title" required>
    </div>

    <br>

    <div>
        <label for="description">Deskripsi</label>
        <textarea id="description" name="description" required></textarea>
    </div>

    <br>

    <div>
        <label for="technologies">Teknologi</label>
        <input type="text" id="technologies" name="technologies">
    </div>

    <br>

    <div>
        <label for="link">Link Project</label>
        <input type="url" id="link" name="link">
    </div>

    <br>

    <button type="submit">Tambah Project</button>

</form>

<br>

<a href="{{ route('projects.index') }}">
    Kembali ke Projects
</a>

@endsection