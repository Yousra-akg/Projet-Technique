<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Image</th>
            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Title</th>
            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Projects</th>
            <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @forelse($tasks as $task)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($task->image)
                        <img class="size-10 rounded-lg object-cover" src="{{ asset('storage/' . $task->image) }}" alt="">
                    @else
                        <div class="size-10 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                            <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $task->title }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                    <div class="flex flex-wrap gap-1">
                        @foreach($task->projects as $project)
                            <span class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                {{ $project->title }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                    <button type="button" onclick="openEditTaskModal({{ $task->id }})" class="inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 hover:underline font-medium">Edit</button>
                    <button type="button" onclick="deleteTask({{ $task->id }})" class="inline-flex items-center gap-x-1.5 text-red-600 decoration-2 hover:underline font-medium ms-3">Delete</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-6 py-10 whitespace-nowrap text-center text-gray-500">No tasks found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@if($tasks->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $tasks->links() }}
    </div>
@endif