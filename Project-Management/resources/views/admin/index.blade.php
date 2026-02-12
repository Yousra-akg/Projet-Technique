@extends('layouts.app')

@section('content')
<div class="w-[75%] mx-auto px-6 lg:px-8 py-10">
    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <!-- Header -->
                    <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">Gestion des Tâches</h2>
                        </div>

                        <div class="inline-flex gap-x-2">
                            <div class="relative">
                                <input type="text" id="searchInput" class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Rechercher des tâches...">
                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                    <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                                </div>
                            </div>

                            <select id="projectFilter" class="py-2 px-3 block border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Tous les projets</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                                @endforeach
                            </select>

                            <button type="button" onclick="openAddModal()" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-500 text-white hover:bg-blue-600 disabled:opacity-50 disabled:pointer-events-none">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                                Ajouter une tâche
                            </button>
                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Table Container -->
                    <div id="adminTableContainer">
                        @include('admin.table')
                    </div>
                    <!-- End Table Container -->
                </div>
            </div>
        </div>
    </div>
    @include('admin.modal')
</div>

<script>
function openAddModal() {
    document.getElementById('taskModal').style.display = 'block';
    document.getElementById('modalTitle').textContent = 'Ajouter une tâche';
    document.getElementById('taskId').value = '';
    document.getElementById('taskForm').reset();
}

function openEditModal(taskId) {
    fetch(`/tasks/${taskId}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('taskModal').style.display = 'block';
            document.getElementById('modalTitle').textContent = 'Modifier une tâche';
            document.getElementById('taskId').value = data.task.id;
            document.getElementById('taskTitle').value = data.task.title;
            document.getElementById('taskDescription').value = data.task.description || '';
            
            // Set project selections
            const projectSelect = document.getElementById('taskProjects');
            Array.from(projectSelect.options).forEach(option => {
                option.selected = data.project_ids.includes(parseInt(option.value));
            });
        });
}

function closeModal() {
    document.getElementById('taskModal').style.display = 'none';
}

function submitTask(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const taskId = document.getElementById('taskId').value;
    const url = taskId ? `/tasks/${taskId}` : '/tasks';
    const method = taskId ? 'PUT' : 'POST';
    
    fetch(url, {
        method: method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeModal();
            refreshTable();
        }
    });
}

function deleteTask(taskId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')) {
        fetch(`/tasks/${taskId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                refreshTable();
            }
        });
    }
}

function refreshTable() {
    const search = document.getElementById('searchInput').value;
    const projectId = document.getElementById('projectFilter').value;
    
    const params = new URLSearchParams();
    if (search) params.append('search', search);
    if (projectId) params.append('project_id', projectId);
    
    fetch(`/admin?${params.toString()}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(response => response.text())
    .then(html => {
        document.getElementById('adminTableContainer').innerHTML = html;
    });
}

// Search and filter listeners
document.getElementById('searchInput').addEventListener('input', function() {
    setTimeout(refreshTable, 500);
});

document.getElementById('projectFilter').addEventListener('change', refreshTable);
</script>
@endsection
