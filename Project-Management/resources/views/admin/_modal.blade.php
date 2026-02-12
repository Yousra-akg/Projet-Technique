<div id="taskModal" class="hidden fixed inset-0 z-[80] overflow-x-hidden overflow-y-auto w-full h-full bg-gray-900/40 backdrop-blur-sm" style="display: none;">
    <div class="flex items-center justify-center min-h-screen p-4">
        <!-- Main Modal Content -->
        <div class="relative bg-white rounded-[2rem] shadow-2xl w-full max-w-3xl overflow-hidden transform transition-all border border-gray-100">
            <!-- Close Button Header -->
            <div class="absolute top-6 right-6 z-10">
                <button type="button" onclick="closeModal()" class="flex items-center justify-center size-10 rounded-xl bg-gray-50 text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-all border border-gray-100 shadow-sm">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-8 md:p-12">
                <h3 id="modalTitle" class="text-2xl font-bold text-gray-900 mb-8 px-1">
                    Ajouter une tâche
                </h3>
                
                @include('admin._form')
            </div>
        </div>
    </div>
</div>