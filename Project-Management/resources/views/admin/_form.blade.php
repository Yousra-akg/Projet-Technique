<form id="taskForm" @submit.prevent="submitForm($event)" enctype="multipart/form-data" class="space-y-6">
    <input type="hidden" name="id" :value="taskId">
    
    <!-- Title -->
    <div class="space-y-2">
        <label class="block text-sm font-semibold text-gray-700 ml-1">{{ __('tasksattributes.title') }}</label>
        <input type="text" name="title" placeholder="Entrez le titre de la tâche" class="py-3 px-4 block w-full border-gray-200 rounded-xl text-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50/50 border transition-all placeholder:text-gray-400" required>
    </div>

    <!-- Image Upload Zone -->
    <div class="space-y-2">
        <label class="block text-sm font-semibold text-gray-700 ml-1">{{ __('tasksattributes.image') }}</label>
        <div class="relative group">
            <input type="file" name="image" id="imageInput" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" @change="updateFileName($event)">
            <div class="border-2 border-dashed border-gray-200 group-hover:border-blue-400 group-hover:bg-blue-50/30 rounded-2xl p-8 transition-all flex flex-col items-center justify-center space-y-3 bg-gray-50/30">
                <div class="size-12 rounded-full bg-white shadow-sm flex items-center justify-center text-gray-400 group-hover:text-blue-500 transition-colors border border-gray-100">
                    <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                </div>
                <div class="text-sm text-gray-500 text-center">
                    <template x-if="!fileName">
                        <span><span class="text-blue-600 font-semibold">Parcourir votre appareil</span> ou glisser-déposer</span>
                    </template>
                    <template x-if="fileName">
                        <span class="text-blue-600 font-semibold" x-text="fileName"></span>
                    </template>
                    <p class="text-xs text-gray-400 mt-1">Taille maximale du fichier : 5 Mo</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects (Multi-select Alpine) -->
    <div class="space-y-2 relative" @click.away="dropdownOpen = false">
        <label class="block text-sm font-semibold text-gray-700 ml-1">{{ __('tasksattributes.projects') }}</label>
        
        <!-- Multi-select Trigger / Selected Tags Area -->
        <div @click="dropdownOpen = !dropdownOpen" class="min-h-[52px] py-2 px-3 block w-full border-gray-200 rounded-xl text-sm focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500 bg-gray-50/50 border transition-all cursor-pointer flex flex-wrap gap-2 items-center">
            <div class="flex flex-wrap gap-2 items-center">
                <template x-if="selectedProjects.length === 0">
                    <span class="text-gray-400 italic py-1 px-1">Sélectionner des projets...</span>
                </template>
                <template x-for="projectId in selectedProjects" :key="projectId">
                    <div class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-xl text-xs font-bold bg-blue-100 text-blue-700 border border-blue-200 shadow-sm transition-all">
                        <span x-text="document.querySelector(`.project-option[data-id='${projectId}']`)?.getAttribute('data-title')"></span>
                        <button type="button" @click.stop="toggleProject(projectId)" class="flex-shrink-0 size-4 inline-flex items-center justify-center rounded-full text-blue-400 hover:bg-blue-200 hover:text-blue-600 focus:outline-none transition-colors">
                            <svg class="size-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </template>
            </div>
            <div class="ms-auto pr-1 text-gray-400">
                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
            </div>
        </div>

        <!-- Dropdown Menu -->
        <div x-show="dropdownOpen" 
             x-transition:enter="transition ease-out duration-100"
             x-transition:enter-start="transform opacity-0 scale-95"
             x-transition:enter-end="transform opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="transform opacity-100 scale-100"
             x-transition:leave-end="transform opacity-0 scale-95"
             class="absolute z-20 mt-1 w-full bg-white border border-gray-100 shadow-xl rounded-2xl overflow-hidden py-1 max-h-60 overflow-y-auto">
            @foreach($projects as $project)
                <div class="project-option py-2.5 px-4 text-sm text-gray-700 hover:bg-blue-50 cursor-pointer flex items-center justify-between transition-colors" 
                     :class="isProjectSelected({{ $project->id }}) ? 'bg-blue-50/50' : ''"
                     data-id="{{ $project->id }}" 
                     data-title="{{ $project->title }}"
                     @click="toggleProject({{ $project->id }})">
                    <span>{{ $project->title }}</span>
                    <svg class="size-4 text-blue-600 check-icon" :class="isProjectSelected({{ $project->id }}) ? '' : 'hidden'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                </div>
            @endforeach
        </div>

        <!-- Hidden Real Select for Form Submission -->
        <select name="project_id[]" multiple class="hidden">
            @foreach($projects as $project)
                <option value="{{ $project->id }}" :selected="isProjectSelected({{ $project->id }})"></option>
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
        <button type="button" @click="closeModal()" class="py-3 px-10 bg-white text-gray-700 text-sm font-bold rounded-xl border border-gray-200 hover:bg-gray-50 transition-all shadow-sm">
            Annuler
        </button>
    </div>
</form>