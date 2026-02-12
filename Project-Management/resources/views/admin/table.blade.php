<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Image</th>
            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Titre</th>
            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Projets</th>
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
                            <span class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $project->title }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                    <button type="button" @click="openEditModal({{ $task->id }})" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium" aria-label="Edit" title="Edit">
                        <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 7.125L16.862 4.487" />
                        </svg>
                    </button>
                    <button type="button" @click="deleteTask({{ $task->id }})" class="inline-flex items-center text-red-600 hover:text-red-700 font-medium ms-3" aria-label="Delete" title="Delete">
                        <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12m-1 0l-1 14H8L7 7m3-3h4a1 1 0 011 1v2H9V5a1 1 0 011-1z" />
                        </svg>
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-6 py-10 whitespace-nowrap text-center text-gray-500">Aucune tâche trouvée.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@if($tasks->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $tasks->links() }}
    </div>
@endif