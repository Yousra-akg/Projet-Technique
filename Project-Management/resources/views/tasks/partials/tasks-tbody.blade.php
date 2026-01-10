@forelse($tasks as $task)
<tr class="hover:bg-slate-50 transition-colors duration-150 group">
    <!-- Task -->
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10">
                @if($task->image)
                    <img class="h-10 w-10 rounded-full object-cover ring-2 ring-white shadow-sm" src="{{ asset('storage/' . $task->image) }}" alt="">
                @else
                    <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-700 font-bold text-sm ring-2 ring-white shadow-sm">
                        {{ substr($task->title, 0, 1) }}
                    </div>
                @endif
            </div>
            <div class="ml-4">
                <div class="text-sm font-bold text-slate-800 group-hover:text-yellow-600 transition-colors">{{ $task->title }}</div>
            </div>
        </div>
    </td>

    <!-- Description -->
    <td class="px-6 py-4">
        <div class="text-sm text-slate-600 max-w-xs truncate">{{ $task->description }}</div>
    </td>
    
    <!-- Project -->
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex gap-2">
            @foreach($task->projects as $project)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                    {{ $project->title }}
                </span>
            @endforeach
        </div>
    </td>

    <!-- Actions -->
    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
            <button onclick="editTask({{ $task->id }})" class="p-1.5 text-slate-400 hover:text-slate-800 bg-white rounded-lg border border-slate-200 shadow-sm hover:bg-slate-50 transition-colors" title="Edit">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
            </button>
            <button onclick="confirmDeleteTask({{ $task->id }})" class="p-1.5 text-slate-400 hover:text-red-500 bg-white rounded-lg border border-slate-200 shadow-sm hover:bg-red-50 transition-colors" title="Delete">
                 <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
            </button>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="px-6 py-12 text-center">
        <div class="flex flex-col items-center justify-center">
            <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center mb-3">
                <svg class="w-6 h-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg>
            </div>
            <p class="text-slate-500 font-medium">No tasks found</p>
            <p class="text-slate-400 text-sm mt-1">Try adjusting your filters or search.</p>
        </div>
    </td>
</tr>
@endforelse
