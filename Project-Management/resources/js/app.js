import './bootstrap';
import 'preline';
import Alpine from 'alpinejs';

Alpine.data('taskManager', () => ({
    isModalOpen: false,

    searchTasks(val) {
        fetch(`/?search=${val}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.text())
            .then(html => document.getElementById('tasks-table-body').innerHTML = html);
    },

    openModal() {
        this.isModalOpen = true;
        document.body.style.overflow = 'hidden';
    },

    closeModal() {
        this.isModalOpen = false;
        document.body.style.overflow = 'auto';
    },

    saveTask(e) {
        fetch('/tasks', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: new FormData(e.target)
        }).then(() => window.location.reload());
    }
}));

window.Alpine = Alpine;
Alpine.start();