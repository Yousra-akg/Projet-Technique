@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h1>{{ __('messages.title') }}</h1>
        <button class="btn btn-primary" onclick="openModal()">{{ __('messages.add_button') }}</button>
    </div>

    <input type="text" class="form-control mb-3" 
           placeholder="{{ __('messages.search_placeholder') }}" 
           onkeyup="searchTasks(this.value)">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('messages.table_headers.title') }}</th>
                <th>{{ __('messages.table_headers.description') }}</th>
                <th>{{ __('messages.table_headers.projects') }}</th>
            </tr>
        </thead>
        <tbody id="tasks-table-body">
            @include('tasks.table')
        </tbody>
    </table>

    <!-- Modal (Simple CSS, Hidden by Default) -->
    <div id="taskModal" class="modal" tabindex="-1" style="display: none; background: rgba(0,0,0,0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('messages.modal.title') }}</h5>
                    <button type="button" class="btn-close" onclick="closeModal()"></button>
                </div>
                <form onsubmit="saveTask(event)">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>{{ __('messages.modal.labels.title') }}</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>{{ __('messages.modal.labels.description') }}</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>{{ __('messages.modal.labels.image') }}</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>{{ __('messages.modal.labels.projects') }}</label>
                            <div class="form-check">
                                @foreach($projects as $project)
                                    <div>
                                        <input class="form-check-input" type="checkbox" name="project_id[]" value="{{ $project->id }}">
                                        <label class="form-check-label">{{ $project->title }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal()">{{ __('messages.modal.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('messages.modal.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
