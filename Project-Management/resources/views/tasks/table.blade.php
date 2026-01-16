@foreach($tasks as $task)
<tr class="hover:bg-gray-100">
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black">{{ $task->title }}</td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $task->description }}</td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
        @foreach($task->projects as $project)
            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-200 text-black">{{ $project->title }}</span>
        @endforeach
    </td>
</tr>
@endforeach