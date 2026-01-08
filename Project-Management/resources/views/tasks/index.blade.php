@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4">Gestion des tâches</h2>

    {{-- 🔍 Barre de recherche --}}
    <form method="GET" action="{{ route('tasks.index') }}" class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control"
                   placeholder="Rechercher par titre"
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-4">
            <select name="project_id" class="form-control">
                <option value="">-- Tous les projets --</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}"
                        {{ request('project_id') == $project->id ? 'selected' : '' }}>
                        {{ $project->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 d-flex gap-2">
            <button class="btn btn-primary">Filtrer</button>

            {{-- ➕ Bouton Ajouter --}}
            <button type="button" class="btn btn-success"
                    data-bs-toggle="modal" data-bs-target="#addTaskModal">
                Ajouter
            </button>
        </div>
    </form>

    {{-- 📋 Table des tâches --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Image</th>
                <th>Projet</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>
                    @if($task->image)
                        <img src="{{ asset('storage/'.$task->image) }}" width="60">
                    @endif
                </td>
                <td>
                    {{ $task->projects->pluck('title')->join(', ') }}
                </td>
                <td>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- 📄 Pagination --}}
    {{ $tasks->withQueryString()->links() }}

</div>

@include('tasks.modal-create')
@endsection
