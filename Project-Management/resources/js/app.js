import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('adminTaskManager', () => ({
    isModalOpen: false,
    taskId: null,
    form: {
        title: '',
        description: '',
        project_ids: [],
        image: null
    },
    search: '',
    projectId: '',

    init() {
        // Initial load or listener setup if needed
    },

    refreshTable(page = 1) {
        fetch(`/tasks?page=${page}&search=${this.search}&project_id=${this.projectId}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(res => res.text())
            .then(html => {
                document.getElementById('adminTableContainer').innerHTML = html;
            });
    },

    openAddModal() {
        this.resetForm();
        this.isModalOpen = true;
        document.getElementById('modalTitle').innerText = 'Add Task';
    },

    openEditModal(id) {
        fetch(`/tasks/${id}/edit`)
            .then(res => res.json())
            .then(data => {
                this.taskId = data.task.id;
                this.form.title = data.task.title;
                this.form.description = data.task.description || '';
                this.form.project_ids = data.project_ids; // Assuming array of IDs

                // For file inputs, we can't set value programmatically, usually left empty or show preview

                // Update Multi-select UI if necessary (Alpine should handle x-model if simple select)
                // If usage of standard select multiple with x-model:
                let select = document.getElementById('taskProjects');
                if (select) {
                    Array.from(select.options).forEach(opt => {
                        opt.selected = data.project_ids.includes(parseInt(opt.value));
                    });
                }

                this.isModalOpen = true;
                document.getElementById('modalTitle').innerText = 'Edit Task';
            });
    },

    closeModal() {
        this.isModalOpen = false;
        this.resetForm();
    },

    resetForm() {
        this.taskId = null;
        this.form.title = '';
        this.form.description = '';
        this.form.project_ids = [];
        this.form.image = null;

        let select = document.getElementById('taskProjects');
        if (select) Array.from(select.options).forEach(opt => opt.selected = false);

        // Reset file input manually as x-model doesn't support file inputs perfectly
        const fileInput = document.getElementById('taskImage');
        if (fileInput) fileInput.value = '';
    },

    submitTask(e) {
        const id = this.taskId;
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
                    this.closeModal();
                    this.refreshTable();
                } else {
                    alert('Error: ' + (data.errors ? Object.values(data.errors).flat().join('\n') : 'Something went wrong'));
                }
            });
    },

    deleteTask(id) {
        if (confirm('Are you sure you want to delete this task?')) {
            fetch(`/tasks/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
                .then(() => this.refreshTable());
        }
    },

    // Pagination handling helper if needed
    handlePagination(url) {
        if (!url) return;
        const urlObj = new URL(url);
        const page = urlObj.searchParams.get('page');
        this.refreshTable(page);
    }
}));



Alpine.start();