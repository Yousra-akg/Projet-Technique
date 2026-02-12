<form id="taskForm" onsubmit="saveTask(event)" enctype="multipart/form-data" class="space-y-6">
    <input type="hidden" id="taskId" name="id">
    
    <!-- Title -->
    <div class="space-y-2">
        <label class="block text-sm font-semibold text-gray-700 ml-1">{{ __('tasksattributes.title') }}</label>
        <input type="text" name="title" placeholder="Entrez le titre de la tâche" class="py-3 px-4 block w-full border-gray-200 rounded-xl text-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50/50 border transition-all placeholder:text-gray-400" required>
    </div>

    <!-- Image Upload Zone -->
    <div class="space-y-2">
        <label class="block text-sm font-semibold text-gray-700 ml-1">{{ __('tasksattributes.image') }}</label>
        <div class="relative group">
            <input type="file" name="image" id="imageInput" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="updateFileName(this)">
            <div class="border-2 border-dashed border-gray-200 group-hover:border-blue-400 group-hover:bg-blue-50/30 rounded-2xl p-8 transition-all flex flex-col items-center justify-center space-y-3 bg-gray-50/30">
                <div class="size-12 rounded-full bg-white shadow-sm flex items-center justify-center text-gray-400 group-hover:text-blue-500 transition-colors border border-gray-100">
                    <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                </div>
                <div class="text-sm text-gray-500 text-center" id="fileNameDisplay">
                    <span class="text-blue-600 font-semibold">Parcourir votre appareil</span> ou glisser-déposer
                    <p class="text-xs text-gray-400 mt-1">Taille maximale du fichier : 5 Mo</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects (Multi-select Custom) -->
    <div class="space-y-2 relative" id="multiSelectContainer">
        <label class="block text-sm font-semibold text-gray-700 ml-1">{{ __('tasksattributes.projects') }}</label>
        
        <!-- Multi-select Trigger / Selected Tags Area -->
        <div onclick="toggleDropdown()" class="min-h-[52px] py-2 px-3 block w-full border-gray-200 rounded-xl text-sm focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500 bg-gray-50/50 border transition-all cursor-pointer flex flex-wrap gap-2 items-center">
            <div id="selectedTags" class="flex flex-wrap gap-2 items-center">
                <!-- Tags will be injected here -->
                <span class="text-gray-400 italic py-1 px-1" id="placeholderText">Sélectionner des projets...</span>
            </div>
            <div class="ms-auto pr-1 text-gray-400">
                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
            </div>
        </div>

        <!-- Dropdown Menu -->
        <div id="dropdownMenu" class="hidden absolute z-20 mt-1 w-full bg-white border border-gray-100 shadow-xl rounded-2xl overflow-hidden py-1 max-h-60 overflow-y-auto transform origin-top transition-all scale-95 opacity-0">
            @foreach($projects as $project)
                <div class="project-option py-2.5 px-4 text-sm text-gray-700 hover:bg-blue-50 cursor-pointer flex items-center justify-between transition-colors" 
                     data-id="{{ $project->id }}" 
                     data-title="{{ $project->title }}"
                     onclick="toggleOption({{ $project->id }}, '{{ addslashes($project->title) }}')">
                    <span>{{ $project->title }}</span>
                    <svg class="size-4 text-blue-600 hidden check-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                </div>
            @endforeach
        </div>

        <!-- Hidden Real Select for Form Submission -->
        <select name="project_id[]" id="realProjectSelect" multiple class="hidden">
            @foreach($projects as $project)
                <option value="{{ $project->id }}">{{ $project->title }}</option>
            @endforeach
        </select>
    </div>

    <!-- Description -->
    <div class="space-y-2">
        <label class="block text-sm font-semibold text-gray-700 ml-1">{{ __('tasksattributes.description') }}</label>
        <textarea name="description" placeholder="Un résumé détaillé..." rows="4" class="py-3 px-4 block w-full border-gray-200 rounded-xl text-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50/50 border transition-all placeholder:text-gray-400"></textarea>
    </div>

    <!-- Footer Buttons -->
    <div class="pt-6 flex items-center justify-start gap-4 border-t border-gray-100">
        <button type="submit" class="py-3 px-10 bg-blue-600 text-white text-sm font-bold rounded-xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-200 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            {{ __('tasksview.modal_save') }}
        </button>
        <button type="button" onclick="closeModal()" class="py-3 px-10 bg-white text-gray-700 text-sm font-bold rounded-xl border border-gray-200 hover:bg-gray-50 transition-all shadow-sm">
            Annuler
        </button>
    </div>
</form>

<script>
window.toggleDropdown = function() {
    const menu = document.getElementById('dropdownMenu');
    if (menu.classList.contains('hidden')) {
        menu.classList.remove('hidden');
        setTimeout(() => {
            menu.classList.remove('scale-95', 'opacity-0');
            menu.classList.add('scale-100', 'opacity-100');
        }, 10);
    } else {
        menu.classList.add('scale-95', 'opacity-0');
        menu.classList.remove('scale-100', 'opacity-100');
        setTimeout(() => menu.classList.add('hidden'), 200);
    }
};

window.toggleOption = function(id, title) {
    const select = document.getElementById('realProjectSelect');
    const options = Array.from(select.options);
    const option = options.find(opt => opt.value == id);
    
    if (option) {
        option.selected = !option.selected;
        updateUI();
    }
};

window.updateUI = function() {
    const select = document.getElementById('realProjectSelect');
    const selectedTags = document.getElementById('selectedTags');
    const placeholder = document.getElementById('placeholderText');
    const options = Array.from(select.options);
    const selectedOptions = options.filter(opt => opt.selected);
    
    selectedTags.innerHTML = '';
    
    if (selectedOptions.length === 0) {
        selectedTags.appendChild(placeholder);
    } else {
        selectedOptions.forEach(opt => {
            const tag = document.createElement('div');
            tag.className = 'inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-xl text-xs font-bold bg-blue-100 text-blue-700 border border-blue-200 shadow-sm transition-all';
            tag.innerHTML = `
                <span>${opt.text}</span>
                <button type="button" onclick="event.stopPropagation(); toggleOption(${opt.value}, '${opt.text.replace(/'/g, "\\'")}')" class="flex-shrink-0 size-4 inline-flex items-center justify-center rounded-full text-blue-400 hover:bg-blue-200 hover:text-blue-600 focus:outline-none transition-colors">
                    <svg class="size-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            `;
            selectedTags.appendChild(tag);
        });
    }

    // Update check icons in dropdown
    const dropdownOptions = document.querySelectorAll('.project-option');
    dropdownOptions.forEach(el => {
        const id = el.getAttribute('data-id');
        const icon = el.querySelector('.check-icon');
        const isSelected = selectedOptions.some(opt => opt.value == id);
        if (isSelected) {
            icon.classList.remove('hidden');
            el.classList.add('bg-blue-50/50');
        } else {
            icon.classList.add('hidden');
            el.classList.remove('bg-blue-50/50');
        }
    });
};

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    const container = document.getElementById('multiSelectContainer');
    const menu = document.getElementById('dropdownMenu');
    if (container && !container.contains(e.target) && !menu.classList.contains('hidden')) {
        window.toggleDropdown();
    }
});

function updateFileName(input) {
    const display = document.getElementById('fileNameDisplay');
    if (input.files && input.files.length > 0) {
        display.innerHTML = `<span class="text-blue-600 font-semibold">${input.files[0].name}</span> sélectionné`;
    }
}
</script>