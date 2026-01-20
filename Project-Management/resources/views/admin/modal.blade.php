<div id="adminTaskModal" class="fixed inset-0 z-[80] hidden overflow-y-auto bg-gray-900 bg-opacity-50">
  <div class="relative w-full max-w-lg p-4 mx-auto mt-7 bg-white border shadow-sm rounded-xl">

      <div class="flex justify-between items-center py-3 px-4 border-b">
        <h3 id="modalTitle" class="font-bold text-gray-800">Add Task</h3>
        <button type="button" onclick="closeTaskModal()" class="size-7 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none">
          <span class="sr-only">Close</span>
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
      </div>
      <form id="taskForm" onsubmit="handleTaskSubmit(event)" enctype="multipart/form-data">
        <input type="hidden" id="taskId" name="id">
        <div class="p-4 overflow-y-auto space-y-4">
          <div>
            <label class="block text-sm font-medium mb-2">Title</label>
            <input type="text" name="title" id="taskTitle" class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-yellow-500 focus:ring-yellow-500" required>
          </div>
          <div>
            <label class="block text-sm font-medium mb-2">Description</label>
            <textarea name="description" id="taskDescription" class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-yellow-500 focus:ring-yellow-500" rows="3"></textarea>
          </div>
          <div>
            <label class="block text-sm font-medium mb-2">Projects</label>
            <select name="project_id[]" id="taskProjects" class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-yellow-500 focus:ring-yellow-500" multiple>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                @endforeach
            </select>
            <p class="text-xs text-gray-500 mt-1">Hold Ctrl (Cmd) to select multiple.</p>
          </div>
          <div>
            <label class="block text-sm font-medium mb-2">Image</label>
            <input type="file" name="image" id="taskImage" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-yellow-500 focus:ring-yellow-500 file:bg-gray-50 file:border-0 file:me-4 file:py-2 file:px-4">
          </div>
        </div>
        <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
          <button type="button" onclick="closeTaskModal()" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">Close</button>
          <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-yellow-500 text-white hover:bg-yellow-600">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
