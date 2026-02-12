import './bootstrap';
import 'preline';

window.searchTasks = val => fetch(`/?search=${val}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(res => res.text())
    .then(html => document.getElementById('tasks-table-body').innerHTML = html);

window.openModal = () => document.getElementById('taskModal').style.display = 'block';
window.closeModal = () => document.getElementById('taskModal').style.display = 'none';

window.saveTask = (e) => {
    e.preventDefault();

    console.log('Form submission started');

    const formData = new FormData(e.target);
    const taskId = document.getElementById('taskId').value;

    if (taskId) {
        formData.append('_method', 'PUT');
    }

    const url = taskId ? `/tasks/${taskId}` : '/tasks';
    console.log('Submitting to URL:', url);

    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        console.error('CSRF token not found!');
        alert('Erreur: Token CSRF manquant. Veuillez recharger la page.');
        return;
    }

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken.content,
            'Accept': 'application/json',
        },
        body: formData
    })
        .then(response => {
            console.log('Response status:', response.status);
            return response.json().then(data => ({
                status: response.status,
                data: data
            }));
        })
        .then(({ status, data }) => {
            console.log('Response data:', data);

            if (status >= 200 && status < 300 && data.success) {
                console.log('Task saved successfully');
                window.location.reload();
            } else {
                if (data.errors) {
                    let errorMessage = 'Erreurs de validation:\n';
                    for (let field in data.errors) {
                        errorMessage += `- ${data.errors[field].join(', ')}\n`;
                    }
                    alert(errorMessage);
                } else {
                    alert('Erreur: ' + (data.message || 'Une erreur est survenue'));
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Erreur de connexion. Veuillez vérifier la console pour plus de détails.');
        });
};