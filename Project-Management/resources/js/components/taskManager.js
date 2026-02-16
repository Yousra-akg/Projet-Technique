import baseComponent from './baseComponent';

export default () => ({
    ...baseComponent(),

    search: '',
    showModal: false,
    taskId: null,
    fileName: '',
    dropdownOpen: false,
    selectedProjects: [],

    init() {
        this.$watch('search', value => {
            this.searchTasks(value);
        });
    },

    async searchTasks(val) {
        const { ok, data } = await this.fetchData(`/admin?search=${val}&project_id=${document.getElementById('projectFilter')?.value || ''}`);
        if (ok) {
            document.getElementById('adminTableContainer').innerHTML = data;
        }
    },

    openCreateModal() {
        this.taskId = null;
        this.fileName = '';
        this.selectedProjects = [];
        this.dropdownOpen = false;

        const form = document.getElementById('taskForm');
        if (form) form.reset();

        this.showModal = true;
    },

    async openEditModal(id) {
        const { ok, data } = await this.fetchData(`/tasks/${id}/edit`);

        if (ok) {
            this.taskId = id;
            this.selectedProjects = data.project_ids;
            this.fileName = '';

            const form = document.getElementById('taskForm');
            if (form) {
                form.querySelector('[name="title"]').value = data.task.title;
                form.querySelector('[name="description"]').value = data.task.description || '';
            }

            this.showModal = true;
        } else {
            this.showAlert('Erreur lors du chargement de la tâche');
        }
    },

    closeModal() {
        this.showModal = false;
        this.taskId = null;
    },

    updateFileName(e) {
        const input = e.target;
        if (input.files && input.files[0]) {
            this.fileName = input.files[0].name;
        }
    },

    toggleProject(id) {
        id = parseInt(id);
        if (this.selectedProjects.includes(id)) {
            this.selectedProjects = this.selectedProjects.filter(p => p !== id);
        } else {
            this.selectedProjects.push(id);
        }
    },

    isProjectSelected(id) {
        return this.selectedProjects.includes(parseInt(id));
    },

    async submitForm(e) {
        const formData = new FormData(e.target);

        if (this.taskId) {
            formData.append('_method', 'PUT');
        }

        const url = this.taskId ? `/tasks/${this.taskId}` : '/tasks';

        const { ok, data } = await this.fetchData(url, {
            method: 'POST',
            body: formData
        });

        if (ok && data.success) {
            window.location.reload();
        } else {
            if (data.errors) {
                let errorMessage = 'Erreurs de validation:\n';
                for (let field in data.errors) {
                    errorMessage += `- ${data.errors[field].join(', ')}\n`;
                }
                this.showAlert(errorMessage);
            } else {
                this.showAlert('Erreur: ' + (data.message || 'Une erreur est survenue'));
            }
        }
    },

    async deleteTask(id) {
        if (!confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')) return;

        const { ok, data } = await this.fetchData(`/tasks/${id}`, {
            method: 'DELETE'
        });

        if (ok) {
            this.searchTasks(this.search);
        } else {
            this.showAlert(data.message || 'Erreur lors de la suppression');
        }
    }
});
