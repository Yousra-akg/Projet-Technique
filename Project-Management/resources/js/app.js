import './bootstrap';
import 'preline';

window.searchTasks = val => fetch(`/?search=${val}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(res => res.text())
    .then(html => document.getElementById('tasks-table-body').innerHTML = html);

window.openModal = () => document.getElementById('taskModal').style.display = 'block';
window.closeModal = () => document.getElementById('taskModal').style.display = 'none';

window.saveTask = e => {
    e.preventDefault();
    fetch('/tasks', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
        body: new FormData(e.target)
    }).then(() => window.location.reload());
};