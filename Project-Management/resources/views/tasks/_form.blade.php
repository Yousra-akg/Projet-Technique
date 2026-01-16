<form onsubmit="saveTask(event)">
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-bold mb-2 text-black">{{ __('tasksattributes.title') }}</label>
            <input type="text" name="title" class="py-3 px-4 block w-full border-2 border-black-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none bg-white text-black placeholder-gray-500 font-medium" required>
        </div>
        <div>
            <label class="block text-sm font-bold mb-2 text-black">{{ __('tasksattributes.description') }}</label>
            <textarea name="description" class="py-3 px-4 block w-full border-2 border-black-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none bg-white text-black placeholder-gray-500 font-medium" rows="3"></textarea>
        </div>
        <div>
            <label class="block text-sm font-bold mb-2 text-black">{{ __('tasksattributes.image') }}</label>
            <input type="file" name="image" class="block w-full border-2 border-black-400 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none bg-white text-black file:bg-gray-100 file:border-0 file:me-4 file:py-3 file:px-4 file:text-black hover:file:bg-gray-200 font-medium">
        </div>
        <div>
            <label class="block text-sm font-bold mb-2 text-black">{{ __('tasksattributes.projects') }}</label>
            <div class="grid space-y-2">
                @foreach($projects as $project)
                    <div class="flex items-center">
                        <input type="checkbox" name="project_id[]" value="{{ $project->id }}" class="shrink-0 mt-0.5 border-2 border-black-400 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none bg-white" id="project-{{ $project->id }}">
                        <label for="project-{{ $project->id }}" class="text-sm text-black ms-3 font-medium">{{ $project->title }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mt-5 flex justify-end gap-x-2">
        <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-black shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" onclick="closeModal()">{{ __('tasksview.modal_close') }}</button>
        <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">{{ __('tasksview.modal_save') }}</button>
    </div>
</form>