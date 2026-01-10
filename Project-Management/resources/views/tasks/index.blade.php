@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Task Management</h1>
        </div>
        <button onclick="openModal()" class="inline-flex items-center justify-center px-6 py-3 text-sm font-bold text-slate-900 bg-yellow-400 hover:bg-yellow-500 rounded-xl transition-all shadow-sm shadow-yellow-400/20 hover:shadow-yellow-400/40 transform hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Create Task
        </button>
    </div>

    <!-- Controls -->
    <div class="bg-white p-2 rounded-2xl shadow-sm border border-slate-100 flex flex-col md:flex-row gap-2">
        <!-- Search -->
        <div class="flex-grow relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <input type="text" id="searchInput" class="block w-full pl-10 pr-4 py-3 border-none rounded-xl text-slate-700 bg-slate-50 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-yellow-400 transition-all font-medium" placeholder="Search tasks...">
        </div>
        <!-- Select -->
        <div class="w-full md:w-64 relative">
             <select id="projectFilter" class="block w-full pl-4 pr-10 py-3 border-none rounded-xl text-slate-700 bg-slate-50 hover:bg-slate-100 focus:bg-white focus:ring-2 focus:ring-yellow-400 transition-all font-medium appearance-none cursor-pointer">
                <option value="">All Projects</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                @endforeach
            </select>
            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Task</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Description</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Project</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="taskTableBody" class="bg-white divide-y divide-slate-100">
                    @include('tasks.partials.tasks-tbody', ['tasks' => $tasks])
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="taskModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity opacity-0" id="modalBackdrop" aria-hidden="true" onclick="closeModal()"></div>
        <div class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full scale-95 opacity-0" id="modalPanel">
            <div class="bg-white px-8 py-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-slate-900" id="modal-title">Task Details</h3>
                    <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                
                <form id="taskForm" enctype="multipart/form-data" class="space-y-5" onsubmit="event.preventDefault(); saveTask();">
                    @csrf
                    <input type="hidden" id="taskId" name="task_id">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Title</label>
                        <input type="text" name="title" id="title" class="block w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-yellow-400 focus:ring-yellow-400 py-3 px-4 transition-all font-medium" placeholder="Task Title">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Description</label>
                        <textarea name="description" id="description" rows="3" class="block w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-yellow-400 focus:ring-yellow-400 py-3 px-4 transition-all font-medium resize-none" placeholder="Task details..."></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Project</label>
                        <select name="project_id" id="project_id" class="block w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-yellow-400 focus:ring-yellow-400 py-3 px-4 transition-all font-medium">
                            <option value="">Select Project</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Image</label>
                        <input type="file" name="image" id="image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100 transition-colors">
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" class="w-full inline-flex justify-center items-center py-3.5 px-6 border border-transparent shadow-sm text-sm font-bold rounded-xl text-slate-900 bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400 transition-all">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const modal = document.getElementById('taskModal');
    const modalBackdrop = document.getElementById('modalBackdrop');
    const modalPanel = document.getElementById('modalPanel');
    const taskForm = document.getElementById('taskForm');
    const searchInput = document.getElementById('searchInput');
    const projectFilter = document.getElementById('projectFilter');
    let debounceTimer;

    function fetchTasks() {
        const search = searchInput.value;
        const projectId = projectFilter.value;
        const tbody = document.getElementById('taskTableBody');
        tbody.style.opacity = '0.5';
        
        fetch(`{{ route('tasks.index') }}?search=${search}&project_id=${projectId}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(response => response.text())
        .then(html => {
            tbody.innerHTML = html;
            tbody.style.opacity = '1';
        });
    }
    
    searchInput.addEventListener('keyup', () => { clearTimeout(debounceTimer); debounceTimer = setTimeout(fetchTasks, 300); });
    projectFilter.addEventListener('change', fetchTasks);

    function openModal(task = null) {
        modal.classList.remove('hidden');
        setTimeout(() => { modalBackdrop.classList.remove('opacity-0'); modalPanel.classList.remove('scale-95', 'opacity-0'); modalPanel.classList.add('scale-100', 'opacity-100'); }, 10);
        if (task) {
            document.getElementById('modal-title').innerText = 'Edit Task';
            document.getElementById('taskId').value = task.id;
            document.getElementById('title').value = task.title;
            document.getElementById('description').value = task.description || '';
            document.getElementById('project_id').value = task.projects[0] ? task.projects[0].id : ''; 
        } else {
            document.getElementById('modal-title').innerText = 'New Task';
            taskForm.reset();
            document.getElementById('taskId').value = '';
        }
    }
    function closeModal() {
        modalBackdrop.classList.add('opacity-0'); modalPanel.classList.remove('scale-100', 'opacity-100'); modalPanel.classList.add('scale-95', 'opacity-0');
        setTimeout(() => { modal.classList.add('hidden'); }, 300);
    }
    function saveTask() {
        const formData = new FormData(taskForm);
        const id = document.getElementById('taskId').value;
        const url = id ? `/tasks/${id}` : `{{ route('tasks.store') }}`;
        if (id) formData.append('_method', 'PUT');

        fetch(url, {
             method: 'POST', 
             body: formData, 
             headers: { 
                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
                 'Accept': 'application/json',
                 'X-Requested-With': 'XMLHttpRequest'
             } 
        })
        .then(async response => {
            const data = await response.json();
            if (!response.ok) {
                // Handle Validation Errors
                if (response.status === 422) {
                    let errorMsg = 'Validation Error:\n';
                    for (const [field, messages] of Object.entries(data.errors)) {
                        errorMsg += `- ${messages[0]}\n`;
                    }
                    alert(errorMsg);
                    return null; // Stop execution
                }
                throw new Error(data.message || 'Server Error');
            }
            return data;
        })
        .then(data => {
            if (data) { // If data is null, it was a handled error
                if (data.success || data.task) {
                    closeModal();
                    fetchTasks();
                } else {
                    alert('Operation failed: Unknown response');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An unexpected error occurred. Please check the console.');
        });
    }
    window.editTask = function(id) { fetch(`/tasks/${id}`, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } }).then(res => res.json()).then(task => openModal(task)); };
    window.confirmDeleteTask = function(id) { if(confirm('Delete task?')) { fetch(`/tasks/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 'Accept': 'application/json' } }).then(() => fetchTasks()); } }
</script>
@endpush
