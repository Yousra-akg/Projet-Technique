<div id="taskModal" class="hidden fixed inset-0 z-[80] overflow-x-hidden overflow-y-auto w-full h-full bg-gray-900/10 backdrop-blur-sm" style="display: none;">
    <div class="mt-7 opacity-100 duration-500 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
        <div class="flex flex-col bg-white border shadow-sm rounded-xl">
            <div class="flex justify-between items-center py-3 px-4 border-b">
                <h3 class="font-bold text-black border-2 border-transparent">
                    {{ __('messages.modal.title') }}
                </h3>
                <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" onclick="closeModal()">
                    <span class="sr-only">Close</span>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-4 overflow-y-auto">
                @include('tasks._form')
            </div>
        </div>
    </div>
</div>