export default () => ({
    csrfToken: document.querySelector('meta[name="csrf-token"]')?.content,

    async fetchData(url, options = {}) {
        const defaultHeaders = {
            'X-CSRF-TOKEN': this.csrfToken,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        };

        const response = await fetch(url, {
            ...options,
            headers: {
                ...defaultHeaders,
                ...options.headers
            }
        });

        const isJson = response.headers.get('content-type')?.includes('application/json');
        const data = isJson ? await response.json() : await response.text();

        return {
            ok: response.ok,
            status: response.status,
            data
        };
    },

    handleError(error) {
        console.error('Fetch Error:', error);
        alert('Une erreur est survenue. Veuillez consulter la console pour plus de détails.');
    },

    showAlert(message, type = 'error') {
        // Simple alert for now, could be replaced by a custom UI component
        alert(message);
    }
});
