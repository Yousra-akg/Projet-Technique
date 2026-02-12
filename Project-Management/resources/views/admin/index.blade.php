@extends('layouts.app')

@section('content')
<div class="w-[75%] mx-auto px-6 lg:px-8 py-10" x-data="{ 
    isModalOpen: false,
    form: {
        title: '',
        description: '',
        project_id: [],
        image: null
    },
    search: '',
    projectId: '',
    
    openAddModal() {
        this.isModalOpen = true;
        this.form = {
            title: '',
            description: '',
            project_id: [],
            image: null
        };
        document.getElementById('modalTitle').textContent = 'Ajouter une tâche';
        document.getElementById('taskId').value = '';
        document.getElementById('taskForm').reset();
    },
    
    openEditModal(taskId) {
        fetch(`/tasks/${taskId}/edit`)
            .then(response => response.json())
            .then(data => {
                this.form = {
                    title: data.task.title,
                    description: data.task.description || '',
                    project_id: data.project_ids || [],
                    image: null
                };
                this.isModalOpen = true;
                document.getElementById('modalTitle').textContent = 'Modifier une tâche';
                document.getElementById('taskId').value = data.task.id;
                
                // Set project selections
                const projectSelect = document.getElementById('taskProjects');
                Array.from(projectSelect.options).forEach(option => {
                    option.selected = data.project_ids.includes(parseInt(option.value));
                });
            });
    },
    
    closeModal() {
        this.isModalOpen = false;
    },
    
    saveTask(event) {
        event.preventDefault();
        
        const formData = new FormData(event.target);
        const taskId = document.getElementById('taskId').value;
        
        if (taskId) {
            formData.append('_method', 'PUT');
        }
        
        const url = taskId ? `/tasks/${taskId}` : '/tasks';
        
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.closeModal();
                this.refreshTable();
            } else {
                alert('Erreur: ' + (data.message || 'Une erreur est survenue'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Erreur de connexion. Veuillez réessayer.');
        });
    },
    
    deleteTask(taskId) {
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
                    this.refreshTable();
                }
            });
        }
    },
    
    refreshTable() {
        const params = new URLSearchParams();
        if (this.search) params.append('search', this.search);
        if (this.projectId) params.append('project_id', this.projectId);
        
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
}">
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
                                <input type="text" x-model="search" @input.debounce.500ms="refreshTable()" class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Rechercher des tâches...">
                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                    <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                                </div>
                            </div>

                            <select x-model="projectId" @change="refreshTable()" class="py-2 px-3 block border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Tous les projets</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                                @endforeach
                            </select>

                            <button type="button" @click="openAddModal()" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-500 text-white hover:bg-blue-600 disabled:opacity-50 disabled:pointer-events-none">
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
// Inclure le code Alpine.js de app.js
</script>
@endsection
