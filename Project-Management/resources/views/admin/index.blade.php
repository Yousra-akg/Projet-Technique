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
                            <h2 class="text-xl font-semibold text-gray-800">Tasks Management</h2>
                        </div>

                        <div class="inline-flex gap-x-2">
                            <div class="relative">
                                <input type="text" id="adminSearch" onkeyup="refreshAdminTable()" class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-yellow-500 focus:ring-yellow-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Search tasks...">
                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                    <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                                </div>
                            </div>

                            <select id="adminFilter" onchange="refreshAdminTable()" class="py-2 px-3 block border-gray-200 shadow-sm rounded-lg text-sm focus:border-yellow-500 focus:ring-yellow-500">
                                <option value="">All Projects</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                                @endforeach
                            </select>

                            <button type="button" onclick="openAddTaskModal()" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-yellow-500 text-white hover:bg-yellow-600 disabled:opacity-50 disabled:pointer-events-none">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                                Add Task
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
</div>

@include('admin.modal')

@endsection

@push('scripts')
<script>
    window.refreshAdminTable = function(page = 1) {
        const search = document.getElementById('adminSearch').value;
        const projectId = document.getElementById('adminFilter').value;
        
        fetch(`/tasks?page=${page}&search=${search}&project_id=${projectId}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById('adminTableContainer').innerHTML = html;
        });
    }

    window.openAddTaskModal = function() {
        document.getElementById('taskForm').reset();
        document.getElementById('taskId').value = '';
        document.getElementById('modalTitle').innerText = 'Add Task';
        
        const select = document.getElementById('taskProjects');
        if (select) Array.from(select.options).forEach(opt => opt.selected = false);
        
        document.getElementById('adminTaskModal').classList.remove('hidden');
    };

    window.openEditTaskModal = function(id) {
        fetch(`/tasks/${id}/edit`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('taskId').value = data.task.id;
                document.getElementById('taskTitle').value = data.task.title;
                document.getElementById('taskDescription').value = data.task.description || '';
                document.getElementById('modalTitle').innerText = 'Edit Task';
                
                const select = document.getElementById('taskProjects');
                if (select) {
                    Array.from(select.options).forEach(opt => opt.selected = data.project_ids.includes(parseInt(opt.value)));
                }
                
                document.getElementById('adminTaskModal').classList.remove('hidden');
            });
    };

    window.closeTaskModal = function() {
        document.getElementById('adminTaskModal').classList.add('hidden');
    };

    window.handleTaskSubmit = function(e) {
        e.preventDefault();
        const id = document.getElementById('taskId').value;
        const url = id ? `/tasks/${id}` : '/tasks';
        
        const formData = new FormData(e.target);
        if (id) formData.append('_method', 'PUT');

        fetch(url, {
            method: 'POST',
            headers: { 
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json' 
            },
            body: formData
        })
        .then(async res => {
            const data = await res.json();
            if (res.ok) {
                closeTaskModal();
                refreshAdminTable();
            } else {
                alert('Error: ' + (data.errors ? Object.values(data.errors).flat().join('\n') : 'Something went wrong'));
            }
        });
    };

    window.deleteTask = function(id) {
        if (confirm('Are you sure you want to delete this task?')) {
            fetch(`/tasks/${id}`, {
                method: 'DELETE',
                headers: { 
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json' 
                }
            })
            .then(() => refreshAdminTable());
        }
    };

    // Handle pagination clicks
    document.addEventListener('click', function(e) {
        const link = e.target.closest('#adminTableContainer .pagination a');
        if (link) {
            e.preventDefault();
            const url = new URL(link.href);
            const page = url.searchParams.get('page');
            refreshAdminTable(page);
        }
    });
</script>
@endpush